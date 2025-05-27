<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Home</title>
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" 
        integrity="sha-0evHe/X+R7YkIZDRvuzKMRqM+OrBnVFBL6DOitfPri4tjfHxaWutUpFmBp4vmVor" crossorigin="anonymous">
        <link href="https://fonts.googleapis.com/css2?family=Playfair+Display&display=swap" rel="stylesheet">
        <link rel="stylesheet" href="{{asset('css/nav.css')}}">
        <script src="{{asset('js/nav.js')}}"></script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/js/bootstrap.bundle.min.js"></script>
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

            /* Contenido principal */
            h1 {
                margin-top: 20px;
                font-size: 28px;
                color: #27ae60; /* Verde azulado oscuro */
                text-align: center;
            }

            form#formAlimentos {
                background-color: #ffffff;
                padding: 20px;
                border-radius: 10px;
                box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
                text-align: center;
                margin-top: 20px;
                display: grid;
                grid-template-columns: repeat(2, auto); /* Dos columnas */
                gap: 10px; /* Espaciado entre elementos */
                justify-content: center; /* Centrar el contenido */
            }

            form#formAlimentos label {
                font-size: 16px;
                color: #34495e; /* Gris oscuro */
                display: flex;
                align-items: center; /* Alinear verticalmente */
                gap: 10px; /* Espaciado entre el checkbox y el texto */
            }

            form#formAlimentos input[type="checkbox"] {
                accent-color: #2ecc71; /* Color del checkbox */
            }

            form#formAlimentos button {
                background-color: #2ecc71;
                color: white;
                border: none;
                padding: 10px 20px;
                font-size: 16px;
                border-radius: 5px;
                cursor: pointer;
                transition: background-color 0.3s;
            }

            form#formAlimentos button:hover {
                background-color: #27ae60; /* Verde más oscuro */
            }

            /* Resultado */
            #resultado {
                margin-top: 20px;
                padding: 15px;
                background-color: #ecf0f1; /* Fondo gris claro */
                border-radius: 10px;
                text-align: center;
                font-size: 18px;
                color: #2c3e50;
            }

            /* Recomendaciones */
            section.recomendaciones {
                margin-top: 30px;
                text-align: center;
            }

            section.recomendaciones h2 {
                font-size: 24px;
                color: #27ae60;
            }

            section.recomendaciones ul {
                list-style: none;
                padding: 0;
            }

            section.recomendaciones ul li {
                margin: 10px 0;
            }

            section.recomendaciones ul li a {
                text-decoration: none;
                color: #2ecc71;
                font-size: 16px;
                transition: color 0.3s;
            }

            section.recomendaciones ul li a:hover {
                color: #16a085;
            }
        </style>
    </head>
    <body>
        <!-- Menú de navegación -->
        <header style="background-color: rgba(46, 204, 113, 0.9); box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1); position: fixed; top: 0; width: 100%; z-index: 1000; ">
            <nav>
                <div class="menu-container">
                    <div class="logo">
                        <img src="{{ asset('img/LogoTFG.png')}}" alt="Logo">

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

        <!-- Contenido principal -->
        <h1>Selecciona tus alimentos</h1>
        <form id="formAlimentos">
            <label><input type="checkbox" value="lechuga"> Lechuga</label><br>
            <label><input type="checkbox" value="tomate"> Tomate</label><br>
            <label><input type="checkbox" value="atún"> Atún</label><br>
            <label><input type="checkbox" value="pollo"> Pollo</label><br>
            <label><input type="checkbox" value="arroz"> Arroz</label><br>
            <label><input type="checkbox" value="huevo"> Huevo</label><br>
            <label><input type="checkbox" value="pan"> Pan</label><br>
            <label><input type="checkbox" value="queso"> Queso</label><br><br>
            <button type="submit">Generar Receta</button>
        </form>

        <div id="resultado" class="receta"></div>
            <section class="recomendaciones">
            <h2>Recomendaciones de recetas</h2>
            <ul>
                <li><a href="#">Ensalada de aguacate y salmón</a></li>
                <li><a href="#">Arroz integral con pollo y brócoli</a></li>
                <li><a href="#">Smoothie verde detox</a></li>
                <li><a href="#">Tortilla fitness con vegetales</a></li>
            </ul>
            </section>
        </div>
        <script>
            const recetas = [
                {
                    nombre: "Ensalada Mixta",
                    ingredientes: ["lechuga", "tomate", "atún"],
                    instrucciones: "Mezcla la lechuga con el tomate y el atún. Sirve fría."
                },
                {
                    nombre: "Arroz con Pollo",
                    ingredientes: ["pollo", "arroz"],
                    instrucciones: "Cocina el arroz y el pollo por separado, luego mezcla y sazona."
                },
                {
                    nombre: "Sandwich de Huevo y Queso",
                    ingredientes: ["pan", "huevo", "queso"],
                    instrucciones: "Cocina el huevo, colócalo entre el pan con el queso y caliéntalo."
                }
            ];

            document.getElementById('formAlimentos').addEventListener('submit', function (e) {
                e.preventDefault();

                const seleccionados = Array.from(document.querySelectorAll('input[type=checkbox]:checked')).map(el => el.value);
                const recetaEncontrada = recetas.find(receta =>
                    receta.ingredientes.every(ing => seleccionados.includes(ing))
                );

                const resultado = document.getElementById('resultado');

                if (recetaEncontrada) {
                    resultado.innerHTML = `
                        <h2>${recetaEncontrada.nombre}</h2>
                        <p><strong>Instrucciones:</strong> ${recetaEncontrada.instrucciones}</p>
                    `;
                } else {
                    resultado.innerHTML = `<p>No se encontró ninguna receta con esos ingredientes.</p>`;
                }
            });
        </script>
        <footer>
            <p>&copy; 2025 NutriTech - Todos los derechos reservados.</p>
        </footer>
    </body>
</html>