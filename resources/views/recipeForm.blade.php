<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Crear receta</title>
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" 
        integrity="sha-0evHe/X+R7YkIZDRvuzKMRqM+OrBnVFBL6DOitfPri4tjfHxaWutUpFmBp4vmVor" crossorigin="anonymous">
        <link href="https://fonts.googleapis.com/css2?family=Playfair+Display&display=swap" rel="stylesheet">
        <link rel="stylesheet" href="{{asset('css/nav.css')}}">
        <script src="{{asset('js/nav.js')}}"></script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/js/bootstrap.bundle.min.js"></script>
        <link rel="stylesheet" href="{{asset('css/tomselect.css')}}">

        <link href="https://cdn.jsdelivr.net/npm/tom-select@2.3.1/dist/css/tom-select.css" rel="stylesheet">
        <!-- Icons -->
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
        <link rel="shortcut icon" href="{{asset('img/LogoTFG.png')}}">

        <style>
            /* General */
            body {
                font-family: 'Arial', sans-serif;
                background: url('../img/FondoInicio.webp') no-repeat center center fixed; /* Imagen de fondo */
                background-size: cover; /* Ajusta la imagen para cubrir toda la pantalla */
                color: #2c3e50; /* Texto oscuro */
                margin: 0;
                padding: 0;
                display: flex;
                flex-direction: column;
                align-items: center;
                padding-top: 60px; /* Espacio para la barra de navegación fija */
                position: relative;
                overflow-x: hidden;
            }

            /* Capa de desenfoque */
            body::before {
                content: '';
                position: absolute;
                top: 0;
                left: 0;
                width: 100%;
                height: 100%;
                background: inherit;
                filter: blur(6px);
                z-index: -1;
            }

            label.required::after {
                content: " *";
                color: red;
            }

            form {
                background-color: rgba(255, 255, 255, 0.88);
                padding: 30px;
                border-radius: 20px;
                max-width: 600px;
                width: 90%;
                box-shadow: 0 8px 20px rgba(0, 0, 0, 0.2);
                margin-top: 60px; /* Espacio para el nav fijo */
            }

            form .form-label {
                font-weight: bold;
                color: #2c3e50;
            }

            form .form-control {
                border-radius: 12px;
                padding: 10px;
            }

            button[type="submit"] {
                width: 100%;
                padding: 12px;
                font-weight: bold;
                font-size: 16px;
                border-radius: 12px;
                border: none;
                background-color: #27ae60;
                color: white;
                transition: background-color 0.3s ease;
            }

            button[type="submit"]:hover {
                background-color: #219653;
            }

            footer {
                background-color: #2ecc71;
                padding: 10px 0;
                text-align: center;
                margin-top: 50px;
                width: 100%;
                font-weight: bold;
                color: #fff;
                box-shadow: 0 -2px 5px rgba(0, 0, 0, 0.1);
            }

            /* Responsive navbar space handling */
            @media (max-width: 768px) {
                body {
                    padding-top: 130px;
                }

                form {
                    margin-top: 30px;
                }
            }
        </style>
    </head>
    <body>
        <header style="background-color: rgba(46, 204, 113, 0.9); box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1); position: fixed; top: 0; width: 100%; z-index: 1000; ">
            <nav>
                <div class="menu-container">
                    <div class="logo">
                        <img src="{{asset('img/LogoTFG.png')}}" alt="Logo">

                        <div class="burger" onclick="toggleMenu()">☰</div>
                    </div>

                    <ul class="menu left">
                        <li><a href="{{route('home')}}"><i class="fas fa-utensils"></i> Recomendaciones</a></li>
                        <li><a href="{{route('recipeForm')}}"><i class="fas fa-plus-circle"></i> Crear receta</a></li>
                        <li><a href="#"><i class="fas fa-dumbbell"></i> Tabla de ejercicios</a></li>
                        <li><a href="{{route('profile')}}"><i class="fas fa-user"></i> Perfil</a></li>
                    </ul>

                    <ul class="menu right">
                        <li class="dropdown">
                            <a href="" id="userDropdown">
                            {{Auth::user()->name}}
                            @if(Auth::user()->profile_image)
                                <img src="{{asset('storage/' . Auth::user()->profile_image)}}" alt="Foto de perfil" 
                                    style="height: 40px; width: 40px; border-radius: 50%; object-fit: cover;">
                            @else
                                <i class="fas fa-user-circle" style="font-size: 24px;"></i>
                            @endif
                            </a>

                            <ul class="dropdown-menu">
                                <li>
                                    <a href="{{route('logout')}}">
                                    Cerrar sesión
                                    </a>
                                </li>
                            </ul>
                        </li>
                    </ul>
                </div>
            </nav>
        </header>
        
        <form action="{{route('recipes-store')}}" method="POST">
            @csrf

            <div class="mb-3">
                <label for="name" class="form-label required">Nombre de la receta</label>
                <input type="text" class="form-control" name="name">
            </div>

            <div class="mb-3">
                <label for="description" class="form-label required">Descripción</label>
                <textarea class="form-control" name="description"></textarea>
            </div>

            <div class="mb-3">
                <label for="instructions" class="form-label required">Instrucciones</label>
                <textarea class="form-control" name="instructions"></textarea>
            </div>

            <!-- Multi-select with the ingredients from the database -->
            <div class="mb-3">
                <label for="ingredients_existing" class="form-label required">Selecciona ingredientes:</label>
                <select class="form-control" name="ingredients_existing[]" multiple>
                    @foreach($ingredients as $ingredient)
                        <option value="{{$ingredient->id}}">{{$ingredient->name}}</option>
                    @endforeach
                </select>
            </div>

            <button type="submit" class="btn btn-success">Crear receta</button>
        </form>
        <script src="https://cdn.jsdelivr.net/npm/tom-select@2.3.1/dist/js/tom-select.complete.min.js"></script>

        <script>
            document.addEventListener('DOMContentLoaded', function () {
                new TomSelect('select[name="ingredients_existing[]"]', {
                    plugins: ['remove_button'],
                    persist: false,
                    maxItems: null,
                    placeholder: "Seleccione los ingredientes",
                    create: function(input) {
                        const normalized = input.trim().toLowerCase();
                        const exists = Object.values(this.options).some(opt =>
                            opt.text.trim().toLowerCase() === normalized
                        );
                        return exists ? false : { value: input, text: input };
                    }
                });
            });
        </script>
        <footer>
            <p>&copy; 2025 NutriTech - Todos los derechos reservados.</p>
        </footer>
    </body>
</html>