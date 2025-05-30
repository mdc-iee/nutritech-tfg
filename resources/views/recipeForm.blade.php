<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Crear receta</title>
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" 
        integrity="sha-0evHe/X+R7YkIZDRvuzKMRqM+OrBnVFBL6DOitfPri4tjfHxaWutUpFmBp4vmVor" crossorigin="anonymous">
        <link href="https://fonts.googleapis.com/css2?family=Playfair+Display&display=swap" rel="stylesheet">
        <!-- Nav -->
        <link rel="stylesheet" href="{{asset('css/nav.css')}}">
        <script src="{{asset('js/nav.js')}}"></script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/js/bootstrap.bundle.min.js"></script>
        <!-- Multiselect -->
        <link rel="stylesheet" href="{{asset('css/tomselect.css')}}">
        <link href="https://cdn.jsdelivr.net/npm/tom-select@2.3.1/dist/css/tom-select.css" rel="stylesheet">
        <script src="https://cdn.jsdelivr.net/npm/tom-select@2.3.1/dist/js/tom-select.complete.min.js"></script>
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
                margin-top: 110px;
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
        <header>
            <nav>
                <div class="menu-container">
                    <div class="logo">
                        <img src="{{asset('img/LogoTFG.png')}}" alt="Logo">

                        <div class="burger" onclick="toggleMenu()">☰</div>
                    </div>

                    <ul class="menu left">
                        <li><a href="{{route('home')}}"><i class="fas fa-utensils"></i> Recomendaciones</a></li>
                        <li><a href="{{route('recipeForm')}}"><i class="fas fa-plus-circle"></i> Crear receta</a></li>
                        <li><a href="{{route('exercises')}}"><i class="fas fa-dumbbell"></i> Tabla de ejercicios</a></li>
                        <li><a href="{{route('profile')}}"><i class="fas fa-user"></i> Perfil</a></li>
                    </ul>

                    <ul class="menu right">
                        <li class="dropdown">
                            <a href="" id="userDropdown">
                            {{Auth::user()->name}}
                            @if(Auth::user()->profile_image)
                                <img src="{{Str::startsWith(Auth::user()->profile_image, 'img/') 
                                ? asset(Auth::user()->profile_image) 
                                : asset('storage/' . Auth::user()->profile_image)}}" 
                                alt="Foto de perfil" style="height: 40px; width: 40px; border-radius: 50%; object-fit: cover;">
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
        
        <form action="{{route('recipes-store')}}" method="POST" enctype="multipart/form-data">
            @csrf

            <div class="mb-3">
                <label for="name" class="form-label required">Nombre de la receta</label>
                <input type="text" class="form-control" name="name">
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

            <div class="mb-3">
                <label for="description" class="form-label required">Descripción</label>
                <textarea class="form-control" name="description"></textarea>
            </div>

            <div class="mb-3">
                <label for="instructions" class="form-label required">Instrucciones</label>
                <textarea class="form-control" name="instructions"></textarea>
            </div>

            <div class="mb-3">
                <label for="recipe_image" class="form-label required">Imagen de la receta:</label>
                <label for="recipe_image" class="btn btn-outline-success w-100">
                    <i class="fa fa-upload me-2"></i> Seleccionar imagen
                </label>
                <input type="file" name="recipe_image" id="recipe_image" accept="image/*" style="display:none;">
            </div>

            <!-- Preview of the image -->
            <div class="mb-3">
                <img id="preview" style="display: none; max-width: 300px; max-height: 200px; object-fit: cover; border-radius: 10px;"/>
            </div>
            @foreach(Auth::user()->recipes as $recipe)
                @if($recipe->image)
                    <img src="{{asset('storage/' . $recipe->image)}}" class="card-img-top" alt="Imagen de la receta">
                @endif
            @endforeach
           <hr> 
            <button type="submit" class="btn btn-success">Crear receta</button>
            @if ($errors->any())
                <div class="position-fixed bottom-0 end-0 p-3" style="z-index: 2">
                    @foreach ($errors->all() as $error)
                        <div class="toast align-items-center text-white bg-danger border-0 mb-2" role="alert">
                            <div class="d-flex">
                                <div class="toast-body">
                                    {{$error}}
                                </div>
                                <button type="button" class="btn-close btn-close-white me-2 m-auto" data-bs-dismiss="toast"></button>
                            </div>
                        </div>
                    @endforeach
                </div>
            @endif
        </form>
        <div id="toast-container" class="position-fixed top-0 end-0 p-3" style="z-index: 2;"></div>

        <script>
            document.addEventListener('DOMContentLoaded', () => {
                initTomSelect();
                initImagePreview();
                showToastsOnLoad();
            });

            function initTomSelect() {
                const select = document.querySelector('select[name="ingredients_existing[]"]');
                if (!select) return;

                new TomSelect(select, {
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
            }

            function initImagePreview() {
                const input = document.getElementById('recipe_image');
                const preview = document.getElementById('preview');
                const fileNameText = document.getElementById('file-name');

                if (!input) return;

                input.addEventListener('change', (e) => {
                    const file = e.target.files[0];
                    if (!file) {
                        if (fileNameText) fileNameText.textContent = "Ningún archivo seleccionado";
                        return;
                    }

                    const reader = new FileReader();
                    reader.onload = (e) => {
                        if (preview) {
                            preview.src = e.target.result;
                            preview.style.display = 'block';
                        }
                    };
                    reader.readAsDataURL(file);

                    if (fileNameText) fileNameText.textContent = file.name;
                });
            }

            function showToastsOnLoad() {
                const toastElList = Array.from(document.querySelectorAll('.toast'));
                toastElList.forEach(toastEl => {
                    new bootstrap.Toast(toastEl).show();
                });
            }

            function showToast(message, type = 'success') {
                const toastHTML = `
                    <div class="toast align-items-center text-white bg-${type} border-0 mb-2" role="alert">
                        <div class="d-flex">
                            <div class="toast-body">${message}</div>
                            <button type="button" class="btn-close btn-close-white me-2 m-auto" data-bs-dismiss="toast"></button>
                        </div>
                    </div>
                `;
                const container = document.getElementById('toast-container');
                if (!container) return;
                container.insertAdjacentHTML('beforeend', toastHTML);
                const toastEl = container.lastElementChild;
                new bootstrap.Toast(toastEl).show();
            }
        </script>
        <footer>
            <p>&copy; 2025 NutriTech - Todos los derechos reservados.</p>
        </footer>
    </body>
</html>