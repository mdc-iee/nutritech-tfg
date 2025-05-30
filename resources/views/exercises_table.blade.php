<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Ejercicios</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet"
    integrity="sha-0evHe/X+R7YkIZDRvuzKMRqM+OrBnVFBL6DOitfPri4tjfHxaWutUpFmBp4vmVor" crossorigin="anonymous">
    <link href="https://fonts.googleapis.com/css2?family=Playfair+Display&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('css/tabla_ejercicios.css') }}">
    <!-- Nav -->
    <link rel="stylesheet" href="{{ asset('css/nav.css') }}">
    <script src="{{ asset('js/nav.js') }}"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/js/bootstrap.bundle.min.js"></script>
    <!-- Icons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
    <link rel="shortcut icon" href="{{ asset('img/LogoTFG.png') }}">
</head>
<body>
    <!-- Menú de navegación -->
    <header>
        <nav>
            <div class="menu-container">
                <div class="logo">
                    <img src="{{ asset('img/LogoTFG.png') }}" alt="Logo">
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
                        <a href="#" id="userDropdown">
                            {{ Auth::user()->name }}
                            @if(Auth::user()->profile_image)
                                <img src="{{ Str::startsWith(Auth::user()->profile_image, 'img/') 
                                    ? asset(Auth::user()->profile_image) 
                                    : asset('storage/' . Auth::user()->profile_image) }}" 
                                    alt="Foto de perfil" style="height: 40px; width: 40px; border-radius: 50%; object-fit: cover;">
                            @else
                                <i class="fas fa-user-circle" style="font-size: 24px;"></i>
                            @endif
                        </a>

                        <ul class="dropdown-menu">
                            <li>
                                <a href="{{route('logout')}}">Cerrar sesión</a>
                            </li>
                        </ul>
                    </li>
                </ul>
            </div>
        </nav>
    </header>

    <!-- Contenido insertado desde HTML -->
    <!-- <div class="contenedor"> -->
        <div class="card-ejercicios">
            <h1 class="titulo-ejercicios">Tabla de Ejercicios</h1>
            <div class="botones">
                <a href="{{route('exercises_easy')}}" class="btn"><i class="fa-solid fa-seedling"></i> Nivel Fácil</a>
                <a href="{{route('exercises_medium')}}" class="btn"><i class="fa-solid fa-dumbbell"></i> Nivel Medio</a>
                <a href="{{route('exercises_hard')}}" class="btn"><i class="fa-solid fa-bolt"></i> Nivel Avanzado</a>

            </div>
        </div>
    <!-- </div> -->

    <footer>
        <p>&copy; 2025 NutriTech - Todos los derechos reservados.</p>
    </footer>
</body>
</html>
