<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Perfil</title>
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" 
        integrity="sha-0evHe/X+R7YkIZDRvuzKMRqM+OrBnVFBL6DOitfPri4tjfHxaWutUpFmBp4vmVor" crossorigin="anonymous">
        <link href="https://fonts.googleapis.com/css2?family=Playfair+Display&display=swap" rel="stylesheet">
        <!-- Icons -->
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
        <link rel="shortcut icon" href="{{ asset('img/LogoTFG.png')}}">

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
            background: inherit; /* Usa la misma imagen de fondo */
            filter: blur(6px); /* Aplica desenfoque */
            z-index: -1; /* Coloca detrás de todo el contenido */
            }

            /* Encabezado y menú de navegación */
            header {
            background-color: rgba(46, 204, 113, 0.9); /* Verde azulado con transparencia */
            width: 100%;
            padding: 10px 0;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
            position: fixed;
            top: 0;
            left: 0;
            z-index: 1000;
            }

            header nav ul.menu {
                list-style: none;
                padding: 0;
                margin: 0;
                display: flex;
                justify-content: center;
                gap: 30px;
                font-family: 'Playfair Display', serif;
            }

            header nav ul.menu li {
                display: flex;
                align-items: center;
            }

            header nav ul.menu li img {
                height: 75px;
                width: 75px;
                border-radius: 50%;
                border: 3px solid white;
                box-shadow: 0 0 8px rgba(0, 0, 0, 0.2);
            }

            header nav ul.menu li a {
                text-decoration: none;
                color: white;
                font-weight: bold;
                display: flex;
                align-items: center;
                gap: 6px;
                font-size: 16px;
                transition: color 0.3s;
            }

            header nav ul.menu li a:hover {
                color: #16a085; /* Verde más oscuro */
            }

            .dropdown {
                position: relative;
            }

            .dropdown-menu {
                position: absolute;
                top: 100%;
                right: 0;
                background-color: white;
                color: black;
                border-radius: 8px;
                box-shadow: 0 4px 8px rgba(0,0,0,0.1);
                display: none;
                min-width: 150px;
                z-index: 2000;
                padding: 10px 0;
            }

            .dropdown-menu li {
                padding: 8px 16px;
                cursor: pointer;
            }

            .dropdown-menu li a {
                color: black;
                text-decoration: none;
            }

            .dropdown-menu li:hover {
                background-color: #f0f0f0;
            }

            .dropdown:hover .dropdown-menu {
                display: block;
            }

            .form-switch .form-check-input {
                width: 50px;
                height: 25px;
                background-color: #ccc;
                border-radius: 25px;
                transition: all 0.3s ease-in-out;
                cursor: pointer;
            }

            .form-switch .form-check-input:checked {
                background-color: #2ecc71;
            }

            .form-switch .form-check-input:before {
                content: "";
                position: absolute;
                top: 2px;
                left: 2px;
                width: 21px;
                height: 21px;
                background: white;
                border-radius: 50%;
                transition: 0.3s;
            }

            .form-switch .form-check-input:checked:before {
                transform: translateX(25px);
            }

            /* Footer */
            footer {
            margin-top: 30px;
            background-color: #2ecc71;
            color: white;
            text-align: center;
            padding: 10px 0;
            width: 100%;
            position: relative;
            bottom: 0;
            }
        </style>
    </head>
    <body>
        <header>
            <nav>
                <ul class="menu">
                    <li><a href="{{route('home')}}"><i class="fas fa-utensils"></i> Recomendaciones</a></li>
                    <li><a href="#"><i class="fas fa-plus-circle"></i> Crear receta</a></li>
                    <li><img src="{{ asset('img/LogoTFG.png')}}" alt="Logo"></li>
                    <li><a href="#"><i class="fas fa-dumbbell"></i> Tabla de ejercicios</a></li>
                    <li><a href="{{route('profile')}}"><i class="fas fa-user"></i>Perfil</a></li>
                    <li class="dropdown">
                        <a href="#" id="userDropdown">
                            {{Auth::user()->name}}
                            @if(Auth::user()->profile_image)
                                <img src="{{asset('storage/' . Auth::user()->profile_image)}}" 
                                    alt="Foto de perfil" 
                                    style="height: 40px; width: 40px; border-radius: 50%; object-fit: cover;">
                            @else
                                <i class="fas fa-user-circle" style="font-size: 24px;"></i>
                            @endif
                        </a>

                        <ul class="dropdown-menu">
                            <li>
                                <a href="{{route('logout')}}"
                                onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                                Cerrar sesión
                                </a>
                            </li>
                        </ul>
                    </li>
                </ul>
            </nav>
        </header>
        <div class="container mt-5 mb-5">
            <div class="card shadow-lg p-4 bg-white rounded-3" style="max-width: 700px; margin: 0 auto;">
                <h2 class="text-center text-success mb-4">Editar usuario</h2>

                <form id="profile-form" action="{{route('perfil-update')}}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    
                    <!-- Photo from the user -->
                    <div class="row mb-4 text-center">
                        <div class="col-12">
                            @if(Auth::user()->profile_image)
                            <img src="{{asset('storage/' . Auth::user()->profile_image) }}" alt="Foto de perfil" 
                            class="rounded-circle shadow" style="width: 100px; height: 100px; object-fit: cover;">
                            @endif
                            <div>
                                <label for="profile_image" class="form-label fw-bold">Cambiar foto de perfil:</label>
                                <input type="file" class="form-control" name="profile_image" accept="image/*">
                            </div>
                        </div>
                    </div>

                    <div class="row g-3">
                        <!-- Name -->
                        <div class="col-md-6">
                            <label for="name" class="form-label fw-bold">Nombre:</label>
                            <input type="text" class="form-control" name="name" value="{{$user->name}}">
                        </div>
                        
                        <!-- Last_names -->
                        <div class="col-md-6">
                            <label for="last_names" class="form-label fw-bold">Apellidos:</label>
                            <input type="text" class="form-control" name="last_names" value="{{$user->last_names}}">
                        </div>
                        
                        <!-- Email -->
                        <div class="col-md-6">
                            <label for="email" class="form-label fw-bold">Email:</label>
                            <input type="email" class="form-control" name="email" value="{{$user->email}}">
                        </div>
                        
                        <!-- Age -->
                        <div class="col-md-6">
                            <label for="age" class="form-label fw-bold">Edad:</label>
                            <input type="number" class="form-control" name="age" value="{{$user->age}}">
                        </div>
                        
                        <!-- Height -->
                        <div class="col-md-6">
                            <label for="height" class="form-label fw-bold">Altura (cm):</label>
                            <input type="number" class="form-control" name="height" value="{{$user->height}}">
                        </div>
                        
                        <!-- Weight -->
                        <div class="col-md-6">
                            <label for="weight" class="form-label fw-bold">Peso:</label>
                            <input type="number" class="form-control" name="weight" value="{{$user->weight}}">
                        </div>
                        
                        <!-- Diet -->
                        <div class="col-md-6 d-flex align-items-center">
                            <label for="diet" class="form-label fw-bold me-3 mb-0">¿Tienes dieta?</label>
                            <div class="form-check form-switch">
                                <input class="form-check-input" type="checkbox" name="diet" id="diet" value="1" 
                                {{old('diet', $user->diet) ? 'checked' : ''}}>
                            </div>
                        </div>
                    </div>
                    
                    <div class="text-center mt-4">
                        <button type="submit" class="btn btn-success px-4">Guardar cambios</button>
                    </div>
                    @if ($errors->any())
                        <div class="position-fixed bottom-0 end-0 p-3" style="z-index: 2">
                            @foreach ($errors->all() as $error)
                                <div class="toast align-items-center text-white bg-danger border-0 mb-2" role="alert">
                                    <div class="d-flex">
                                        <div class="toast-body">
                                            {{ $error }}
                                        </div>
                                        <button type="button" class="btn-close btn-close-white me-2 m-auto" data-bs-dismiss="toast"></button>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    @endif
                </form>
                <div id="toast-container" class="position-fixed bottom-0 end-0 p-3" style="z-index: 2;"></div>
            </div>
        </div>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/js/bootstrap.bundle.min.js"></script>
        <script>
            document.addEventListener('DOMContentLoaded', () => {
                const toastElList = [].slice.call(document.querySelectorAll('.toast'));
                toastElList.forEach((toastEl) => {
                    new bootstrap.Toast(toastEl).show();
                });
            });

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
                container.insertAdjacentHTML('beforeend', toastHTML);
                const toastEl = container.lastElementChild;
                new bootstrap.Toast(toastEl).show();
            }
        </script>
    </body>
    <footer>
        <p>&copy; 2025 NutriTech - Todos los derechos reservados.</p>
    </footer>
</html>