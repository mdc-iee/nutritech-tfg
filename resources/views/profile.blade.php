<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Perfil</title>
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" 
        integrity="sha-0evHe/X+R7YkIZDRvuzKMRqM+OrBnVFBL6DOitfPri4tjfHxaWutUpFmBp4vmVor" crossorigin="anonymous">
        <link href="https://fonts.googleapis.com/css2?family=Playfair+Display&display=swap" rel="stylesheet">
        <link rel="stylesheet" href="{{asset('css/nav.css')}}">
        <script src="{{asset('js/nav.js')}}"></script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/js/bootstrap.bundle.min.js"></script>
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
            background: inherit; /* Usa la misma imagen de fondo */
            filter: blur(6px); /* Aplica desenfoque */
            z-index: -1; /* Coloca detrás de todo el contenido */
            }

            label.required::after {
                content: " *";
                color: red;
            }

            .modal-open {
                overflow: auto !important;
                padding-right: 0 !important;
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
        <div class="container mt-5 mb-5">
            <div class="card shadow-lg p-4 bg-white rounded-3" style="max-width: 700px; margin: 0 auto; margin-top: 80px">
                <h2 class="text-center text-success mb-4">Editar datos personales</h2>

                <form id="profile-form" action="{{route('perfil-update')}}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    
                    <!-- Photo from the user -->
                    <div class="row mb-4 text-center">
                        <div class="col-12">
                            @if(Auth::user()->profile_image)
                                <img id="profile_image_preview" alt="Foto de perfil"
                                src="{{Str::startsWith(Auth::user()->profile_image, 'img/') 
                                ? asset(Auth::user()->profile_image) 
                                : asset('storage/' . Auth::user()->profile_image)}}" 
                                class="rounded-circle shadow" style="width: 100px; height: 100px; object-fit: cover;">
                            @endif
                            <div>
                                <label for="profile_image_input" class="form-label fw-bold">Cambiar foto de perfil:</label>
                                <label for="profile_image_input" class="btn btn-outline-success w-100">
                                    <i class="fa fa-upload me-2"></i> Seleccionar imagen
                                </label>
                                <input type="file" class="form-control d-none" name="profile_image" id="profile_image_input" accept="image/*">
                            </div>
                        </div>
                    </div>

                    <div class="row g-3">
                        <!-- Name -->
                        <div class="col-md-6">
                            <label for="name" class="form-label fw-bold required">Nombre:</label>
                            <input type="text" class="form-control" name="name" value="{{$user->name}}">
                        </div>
                        
                        <!-- Last_names -->
                        <div class="col-md-6">
                            <label for="last_names" class="form-label fw-bold">Apellidos:</label>
                            <input type="text" class="form-control" name="last_names" value="{{$user->last_names}}">
                        </div>
                        
                        <!-- Email -->
                        <div class="col-md-6">
                            <label for="email" class="form-label fw-bold required">Email:</label>
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
            </div>

            <div class="card shadow-lg p-4 bg-white rounded-3" style="max-width: 700px; margin: 0 auto; margin-top: 80px">
                <h2 class="text-center text-success mb-4">Mis recetas</h2>

                @foreach ($recipes as $recipe)
                    <div class="card mb-4 shadow-sm border-0">
                        <div class="row g-0 border border-success border-3 rounded-4">
                            <div class="col-md-4 d-flex align-items-center justify-content-center" style="min-height: 200px;">
                                <button type="button" class="btn btn-outline-success" data-bs-toggle="modal" data-bs-target="#imageModal-{{$recipe->id}}">
                                    <i class="fas fa-search-plus me-2"></i> Ver imagen
                                </button>
                            </div>
                            <div class="col-md-8 p-4 d-flex flex-column justify-content-between">
                                <div>
                                    <h5 class="card-title text-success">{{$recipe->name}}</h5>
                                    <p class="card-text text-muted mb-2">{{$recipe->description}}</p>
                                    <p class="card-text"><small>{{$recipe->instructions}}</small></p>
                                </div>
                                <div class="mt-3">
                                    <button class="btn btn-outline-success btn-sm me-2"
                                    data-bs-toggle="modal" data-bs-target="#editModal-{{$recipe->id}}">
                                        Editar
                                    </button>
                                    <button class="btn btn-outline-danger btn-sm"
                                    data-bs-toggle="modal" data-bs-target="#deleteModal-{{$recipe->id}}">
                                        Eliminar
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>

                    @include('components.modals.edit-recipe', ['recipe' => $recipe])
                    @include('components.modals.delete-recipe', ['recipe' => $recipe])
                    @include('components.modals.see-recipe', ['recipe' => $recipe])
                @endforeach
            </div>
        </div>
        <script>
            document.addEventListener('DOMContentLoaded', function () {
                // Show image selected
                const input = document.getElementById('profile_image_input');
                const preview = document.getElementById('profile_image_preview');

                if (input && preview) {
                    input.addEventListener('change', function(e) {
                        const file = e.target.files[0];

                        if (file) {
                            const reader = new FileReader();
                            reader.onload = function(e) {
                                preview.src = e.target.result;
                                preview.style.visibility = 'visible';
                            };
                            reader.readAsDataURL(file);
                        }
                    });
                }

                // Show validations if an error ocurred
                const toastElList = [].slice.call(document.querySelectorAll('.toast'));
                toastElList.forEach((toastEl) => {
                    new bootstrap.Toast(toastEl).show();
                });
            });

            document.querySelectorAll('.modal').forEach(modal => {
                modal.addEventListener('hide.bs.modal', () => {
                    if (modal.contains(document.activeElement)) {
                    document.activeElement.blur();
                    }
                    document.body.style.overflow = 'auto';
                });

                modal.addEventListener('hidden.bs.modal', () => {
                    const anchor = document.getElementById('focus-anchor');
                    if (anchor) anchor.focus({ preventScroll: true });
                    document.body.style.overflow = 'auto';
                });
                });

                document.addEventListener('show.bs.modal', () => {
                // Quitar clase que bloquea scroll trasero
                document.body.classList.remove('modal-open');
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
        <footer>
            <p>&copy; 2025 NutriTech - Todos los derechos reservados.</p>
        </footer>
        <div id="focus-anchor" tabindex="-1" style="position:absolute; left:-9999px;"></div>
    </body>
</html>