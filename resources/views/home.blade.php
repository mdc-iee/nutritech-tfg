<!DOCTYPE html>
<html>
    <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Home</title>
    <link href="https://fonts.googleapis.com/css2?family=Playfair+Display&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
    <link rel="stylesheet" href="{{asset('css/nav.css')}}">
    <link rel="stylesheet" href="{{asset('css/inicio.css')}}">
    <script src="{{asset('js/nav.js')}}"></script>
    <!-- Icons -->
    <link rel="shortcut icon" href="{{ asset('img/LogoTFG.png')}}">
</head>
    <body>
        <!-- Menú de navegación -->
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

       <!-- Contenido principal -->

  <!-- Botón para mostrar el formulario -->
<button id="mostrarForm" class="btn-verde">Selecciona tus alimentos</button>

<!-- Formulario oculto al inicio -->
<div id="formWrapper" style="display:none;">
  <form id="formAlimentos">
    <!-- Checkboxes personalizados -->
    <label class="custom-checkbox">
      <input type="checkbox" name="alimentos[]" value="lechuga"><span class="checkmark"></span>Lechuga
    </label>
    <label class="custom-checkbox">
      <input type="checkbox" name="alimentos[]" value="tomate"><span class="checkmark"></span>Tomate
    </label>
    <label class="custom-checkbox">
      <input type="checkbox" name="alimentos[]" value="atún"><span class="checkmark"></span>Atún
    </label>
    <label class="custom-checkbox">
      <input type="checkbox" name="alimentos[]" value="pollo"><span class="checkmark"></span>Pollo
    </label>
    <label class="custom-checkbox">
      <input type="checkbox" name="alimentos[]" value="arroz"><span class="checkmark"></span>Arroz
    </label>
    <label class="custom-checkbox">
      <input type="checkbox" name="alimentos[]" value="huevo"><span class="checkmark"></span>Huevo
    </label>
    <label class="custom-checkbox">
      <input type="checkbox" name="alimentos[]" value="pan"><span class="checkmark"></span>Pan
    </label>
    <label class="custom-checkbox">
      <input type="checkbox" name="alimentos[]" value="queso"><span class="checkmark"></span>Queso
    </label>
    <label class="custom-checkbox">
      <input type="checkbox" name="alimentos[]" value="manzana"><span class="checkmark"></span>Manzana
    </label>
    <label class="custom-checkbox">
      <input type="checkbox" name="alimentos[]" value="plátano"><span class="checkmark"></span>Plátano
    </label>
    <label class="custom-checkbox">
      <input type="checkbox" name="alimentos[]" value="yogur"><span class="checkmark"></span>Yogur
    </label>
    <label class="custom-checkbox">
      <input type="checkbox" name="alimentos[]" value="espinacas"><span class="checkmark"></span>Espinacas
    </label>
    <label class="custom-checkbox">
      <input type="checkbox" name="alimentos[]" value="zanahoria"><span class="checkmark"></span>Zanahoria
    </label>
    <label class="custom-checkbox">
      <input type="checkbox" name="alimentos[]" value="pepino"><span class="checkmark"></span>Pepino
    </label>
    <label class="custom-checkbox">
      <input type="checkbox" name="alimentos[]" value="pavo"><span class="checkmark"></span>Pavo
    </label>
    <label class="custom-checkbox">
      <input type="checkbox" name="alimentos[]" value="almendras"><span class="checkmark"></span>Almendras
    </label>
    <label class="custom-checkbox">
      <input type="checkbox" name="alimentos[]" value="avena"><span class="checkmark"></span>Avena
    </label>
    <label class="custom-checkbox">
      <input type="checkbox" name="alimentos[]" value="miel"><span class="checkmark"></span>Miel
    </label>
    <label class="custom-checkbox">
      <input type="checkbox" name="alimentos[]" value="chocolate"><span class="checkmark"></span>Chocolate
    </label>
    <label class="custom-checkbox">
      <input type="checkbox" name="alimentos[]" value="brócoli"><span class="checkmark"></span>Brócoli
    </label>
    <button type="submit">Generar Receta</button>
  </form>
  <div id="resultado" class="receta"></div>
</div>

  <!-- Platos principales -->
<h2 class="seccion-titulo">Platos principales</h2>
<div class="carousel-container">
  <div class="carousel">
    <!-- 1. Lasaña de carne -->
    <div class="carousel-item"
      data-name="Lasaña de carne"
      data-img="{{ asset('img/img1_carrusel1.png') }}"
      data-ingredientes="12 láminas de lasaña, 500 g de carne picada (ternera o mixta), 1 cebolla, 2 dientes de ajo, 500 ml de tomate triturado, 50 g de mantequilla, 50 g de harina, 500 ml de leche, Queso rallado, Aceite, sal, pimienta, orégano"
      data-instructions="Cuece las láminas de lasaña si no son precocidas. Sofríe la cebolla y el ajo picados. Añade la carne y cocina hasta dorar. Agrega el tomate, sal, pimienta y orégano. Cocina 15 min. Para la bechamel, derrite la mantequilla, añade la harina y remueve. Incorpora la leche poco a poco hasta espesar. En una fuente, coloca una capa de bechamel, otra de pasta, carne, y repite. Cubre con bechamel y queso. Hornea a 180°C por 30 minutos.">
      <img src="{{ asset('img/img1_carrusel1.png') }}" alt="Lasaña de carne">
    </div>
    <!-- 2. Pollo al horno con patatas -->
    <div class="carousel-item"
      data-name="Pollo al horno con patatas"
      data-img="{{ asset('img/img2_carrusel1.png') }}"
      data-ingredientes="4 muslos de pollo, 4 patatas medianas, 1 cebolla, 4 dientes de ajo, Limón, romero, aceite, sal, pimienta"
      data-instructions="Precalienta el horno a 200°C. Pela y corta las patatas y la cebolla en rodajas. Colócalas en una bandeja. Añade los muslos de pollo encima. Machaca los ajos y mézclalos con zumo de limón, aceite, sal, pimienta y romero. Unta el pollo con esta mezcla. Hornea 45 min, volteando a mitad del tiempo.">
      <img src="{{ asset('img/img2_carrusel1.png') }}" alt="Pollo al horno con patatas">
    </div>
    <!-- 3. Paella mixta -->
    <div class="carousel-item"
      data-name="Paella mixta"
      data-img="{{ asset('img/img3_carrusel1.png') }}"
      data-ingredientes="300 g de arroz, 150 g de pollo, 150 g de calamares, 100 g de gambas, 1 pimiento rojo, 1 tomate, 1 ajo, 750 ml de caldo, Azafrán, sal, aceite"
      data-instructions="Sofríe el ajo y el pimiento troceado. Añade el pollo en cubos y los calamares en anillas. Incorpora el tomate rallado y cocina 5 min. Añade el arroz y rehoga. Vierte el caldo caliente y el azafrán. Cocina 10 min a fuego fuerte y 10 a fuego lento. Agrega las gambas en los últimos 5 minutos.">
      <img src="{{ asset('img/img3_carrusel1.png') }}" alt="Paella mixta">
    </div>
    <!-- 4. Salmón al papillote -->
    <div class="carousel-item"
      data-name="Salmón al papillote"
      data-img="{{ asset('img/img4_carrusel1.png') }}"
      data-ingredientes="2 lomos de salmón, 1 calabacín, 1 zanahoria, ½ cebolla, Limón, aceite, sal, eneldo"
      data-instructions="Corta las verduras en tiras finas. En papel de horno, coloca las verduras y encima el salmón. Añade sal, eneldo, unas gotas de limón y un chorrito de aceite. Cierra el paquete y hornea 20 min a 180°C.">
      <img src="{{ asset('img/img4_carrusel1.png') }}" alt="Salmón al papillote">
    </div>
    <!-- 5. Spaghetti carbonara (sin nata) -->
    <div class="carousel-item"
      data-name="Spaghetti carbonara (sin nata)"
      data-img="{{ asset('img/img5_carrusel1.png') }}"
      data-ingredientes="400 g de spaghetti, 150 g de panceta, 2 yemas de huevo, 50 g de queso parmesano, Sal, pimienta"
      data-instructions="Cocina la pasta al dente. Sofríe la panceta hasta dorar. Bate las yemas con queso y pimienta. Mezcla la pasta caliente con la panceta y luego con la mezcla de yemas, fuera del fuego.">
      <img src="{{ asset('img/img5_carrusel1.png') }}" alt="Spaghetti carbonara">
    </div>
    <!-- 6. Tacos de pollo -->
    <div class="carousel-item"
      data-name="Tacos de pollo"
      data-img="{{ asset('img/img6_carrusel1.png') }}"
      data-ingredientes="400 g de pechuga de pollo, 1 pimiento, 1 cebolla, Tortillas de maíz, Especias (comino, pimentón, ajo en polvo), Limón, sal, aceite"
      data-instructions="Corta el pollo en tiras y adoba con especias, sal y limón. Saltea con el pimiento y la cebolla en tiras. Calienta las tortillas y rellénalas con el salteado.">
      <img src="{{ asset('img/img6_carrusel1.png') }}" alt="Tacos de pollo">
    </div>
    <!-- 7. Albóndigas en salsa -->
    <div class="carousel-item"
      data-name="Albóndigas en salsa"
      data-img="{{ asset('img/img7_carrusel1.png') }}"
      data-ingredientes="500 g de carne picada, 1 huevo, 1 diente de ajo, Perejil, pan rallado, 1 cebolla, 200 ml de tomate triturado, Caldo, harina, sal, aceite"
      data-instructions="Mezcla la carne con ajo, perejil, huevo y pan rallado. Forma bolitas. Enharina y fríe las albóndigas. Reserva. Sofríe la cebolla, añade el tomate y un poco de caldo. Incorpora las albóndigas y cocina 15 min.">
      <img src="{{ asset('img/img7_carrusel1.png') }}" alt="Albóndigas en salsa">
    </div>
    <!-- 8. Risotto de champiñones -->
    <div class="carousel-item"
      data-name="Risotto de champiñones"
      data-img="{{ asset('img/img8_carrusel1.png') }}"
      data-ingredientes="300 g de arroz arborio, 200 g de champiñones, 1 cebolla, 1 litro de caldo, 50 g de parmesano, 30 g de mantequilla, Vino blanco, sal"
      data-instructions="Sofríe la cebolla y los champiñones picados. Añade el arroz y un chorrito de vino blanco. Agrega caldo poco a poco, removiendo constantemente. Cuando esté cremoso, añade queso y mantequilla.">
      <img src="{{ asset('img/img8_carrusel1.png') }}" alt="Risotto de champiñones">
    </div>
    <!-- 9. Pechuga de pollo rellena de espinacas y queso -->
    <div class="carousel-item"
      data-name="Pechuga de pollo rellena de espinacas y queso"
      data-img="{{ asset('img/img9_carrusel1.png') }}"
      data-ingredientes="2 pechugas abiertas en forma de libro, 100 g de espinacas, 100 g de queso (mozzarella o feta), Sal, pimienta, aceite"
      data-instructions="Saltea las espinacas y mézclalas con el queso. Rellena las pechugas con esta mezcla y ciérralas con palillos. Sella en una sartén y termina en horno 10 min a 180°C.">
      <img src="{{ asset('img/img9_carrusel1.png') }}" alt="Pechuga de pollo rellena de espinacas y queso">
    </div>
    <!-- 10. Curry de garbanzos -->
    <div class="carousel-item"
      data-name="Curry de garbanzos"
      data-img="{{ asset('img/img10_carrusel1.png') }}"
      data-ingredientes="400 g de garbanzos cocidos, 1 cebolla, 2 dientes de ajo, 1 trozo de jengibre, 200 ml de leche de coco, 200 ml de tomate triturado, Curry, cúrcuma, sal, aceite"
      data-instructions="Sofríe cebolla, ajo y jengibre. Añade curry y cúrcuma. Cocina 1 minuto. Incorpora el tomate, garbanzos y leche de coco. Cocina a fuego lento 20 minutos.">
      <img src="{{ asset('img/img10_carrusel1.png') }}" alt="Curry de garbanzos">
    </div>
  </div>
</div>

<!-- Segundos platos -->
<h2 class="seccion-titulo">Segundos platos</h2>
<div class="carousel-container">
  <div class="carousel">
    <!-- 1. Tortilla de espinacas y queso -->
    <div class="carousel-item"
      data-name="Tortilla de espinacas y queso"
      data-img="{{ asset('img/img1_carrusel2.png') }}"
      data-ingredientes="4 huevos, 150 g de espinacas frescas, 50 g de queso rallado (emmental o feta), 1 diente de ajo, Aceite, sal, pimienta"
      data-instructions="Lava las espinacas y saltéalas con un poco de aceite y el ajo picado. Bate los huevos, añade sal, pimienta y el queso. Incorpora las espinacas y vierte todo en una sartén antiadherente. Cocina a fuego medio por ambos lados hasta que cuaje.">
      <img src="{{ asset('img/img1_carrusel2.png') }}" alt="Tortilla de espinacas y queso">
    </div>
    <!-- 2. Merluza en salsa verde -->
    <div class="carousel-item"
      data-name="Merluza en salsa verde"
      data-img="{{ asset('img/img2_carrusel2.png') }}"
      data-ingredientes="4 lomos de merluza, 2 dientes de ajo, Perejil fresco, 200 ml de caldo de pescado, 1 cucharadita de harina, Aceite, sal"
      data-instructions="Sofríe los ajos picados. Añade la harina y mezcla bien. Incorpora el caldo y el perejil picado. Añade la merluza, sala al gusto y cocina 5-7 minutos por cada lado.">
      <img src="{{ asset('img/img2_carrusel2.png') }}" alt="Merluza en salsa verde">
    </div>
    <!-- 3. Revuelto de setas y jamón -->
    <div class="carousel-item"
      data-name="Revuelto de setas y jamón"
      data-img="{{ asset('img/img3_carrusel2.png') }}"
      data-ingredientes="200 g de setas variadas, 2 huevos, 50 g de jamón serrano en tiras, 1 diente de ajo, Aceite, sal"
      data-instructions="Sofríe el ajo y las setas en aceite hasta que estén tiernas. Añade el jamón y cocina 2 minutos más. Bate los huevos, vierte sobre las setas y remueve suavemente hasta que cuajen.">
      <img src="{{ asset('img/img3_carrusel2.png') }}" alt="Revuelto de setas y jamón">
    </div>
    <!-- 4. Brochetas de verduras y tofu (vegano) -->
    <div class="carousel-item"
      data-name="Brochetas de verduras y tofu (vegano)"
      data-img="{{ asset('img/img4_carrusel2.png') }}"
      data-ingredientes="200 g de tofu, 1 pimiento rojo, 1 calabacín, 1 cebolla morada, Salsa de soja, aceite de oliva, orégano"
      data-instructions="Corta todo en trozos medianos. Marina el tofu en salsa de soja 20 min. Monta las brochetas intercalando los ingredientes. Asa en plancha o sartén con un poco de aceite, girando para dorar todos los lados.">
      <img src="{{ asset('img/img4_carrusel2.png') }}" alt="Brochetas de verduras y tofu">
    </div>
    <!-- 5. Huevos al plato con tomate y chorizo -->
    <div class="carousel-item"
      data-name="Huevos al plato con tomate y chorizo"
      data-img="{{ asset('img/img5_carrusel2.png') }}"
      data-ingredientes="2 huevos, 150 g de tomate triturado, 50 g de chorizo en rodajas, 1/4 de cebolla, Sal, aceite, pimentón"
      data-instructions="Sofríe la cebolla picada con el chorizo. Añade el tomate, sal y pimentón. Cocina 10 minutos. Vierte en cazuelitas, añade los huevos y hornea a 180°C unos 10 min, hasta que cuajen.">
      <img src="{{ asset('img/img5_carrusel2.png') }}" alt="Huevos al plato con tomate y chorizo">
    </div>
    <!-- 6. Croquetas de pollo caseras -->
    <div class="carousel-item"
      data-name="Croquetas de pollo caseras"
      data-img="{{ asset('img/img6_carrusel2.png') }}"
      data-ingredientes="200 g de pollo cocido y desmenuzado, 500 ml de leche, 50 g de harina, 50 g de mantequilla, Nuez moscada, sal, pan rallado, huevo"
      data-instructions="Derrite la mantequilla, añade la harina y remueve. Incorpora la leche poco a poco hasta hacer una bechamel. Agrega el pollo y nuez moscada. Cocina hasta espesar. Deja enfriar, forma croquetas, pásalas por huevo y pan rallado y fríe.">
      <img src="{{ asset('img/img6_carrusel2.png') }}" alt="Croquetas de pollo caseras">
    </div>
    <!-- 7. Filetes de ternera con cebolla caramelizada -->
    <div class="carousel-item"
      data-name="Filetes de ternera con cebolla caramelizada"
      data-img="{{ asset('img/img7_carrusel2.png') }}"
      data-ingredientes="2 filetes de ternera, 2 cebollas, 1 cucharada de azúcar moreno, 1 chorrito de vinagre balsámico, Aceite, sal, pimienta"
      data-instructions="Corta la cebolla en juliana y cocínala a fuego lento con aceite. Añade el azúcar y el vinagre y deja caramelizar. Salpimienta los filetes y hazlos a la plancha al gusto. Sirve con la cebolla encima.">
      <img src="{{ asset('img/img7_carrusel2.png') }}" alt="Filetes de ternera con cebolla caramelizada">
    </div>
    <!-- 8. Coliflor gratinada -->
    <div class="carousel-item"
      data-name="Coliflor gratinada"
      data-img="{{ asset('img/img8_carrusel2.png') }}"
      data-ingredientes="1 coliflor, 50 g de queso rallado, 30 g de mantequilla, 30 g de harina, 400 ml de leche, Nuez moscada, sal"
      data-instructions="Cuece la coliflor en ramilletes hasta que esté tierna. Haz una bechamel con mantequilla, harina y leche. Añade nuez moscada y sal. Coloca la coliflor en una fuente, cubre con bechamel y queso. Gratina en el horno 10-15 min.">
      <img src="{{ asset('img/img8_carrusel2.png') }}" alt="Coliflor gratinada">
    </div>
    <!-- 9. Hamburguesa vegetal casera -->
    <div class="carousel-item"
      data-name="Hamburguesa vegetal casera"
      data-img="{{ asset('img/img9_carrusel2.png') }}"
      data-ingredientes="1 taza de lentejas cocidas, 1 zanahoria rallada, 1/2 cebolla, 2 cucharadas de avena, 1 cucharadita de comino, Sal, aceite, pan de hamburguesa"
      data-instructions="Tritura ligeramente las lentejas. Mezcla con el resto de ingredientes. Forma hamburguesas y cocínalas en sartén con un poco de aceite. Sirve en pan con lechuga, tomate y tu salsa favorita.">
      <img src="{{ asset('img/img9_carrusel2.png') }}" alt="Hamburguesa vegetal casera">
    </div>
    <!-- 10. Empanadillas de atún al horno -->
    <div class="carousel-item"
      data-name="Empanadillas de atún al horno"
      data-img="{{ asset('img/img10_carrusel2.png') }}"
      data-ingredientes="Obleas de empanadilla, 2 latas de atún escurrido, 1 huevo cocido, 4 cucharadas de tomate frito, 1 huevo para pintar"
      data-instructions="Mezcla el atún, huevo cocido picado y tomate. Rellena las obleas, ciérralas con un tenedor. Pinta con huevo batido y hornea 15 min a 180°C.">
      <img src="{{ asset('img/img10_carrusel2.png') }}" alt="Empanadillas de atún al horno">
    </div>
  </div>
</div>

<!-- Postres -->
<h2 class="seccion-titulo">Postres</h2>
<div class="carousel-container">
  <div class="carousel">
    <!-- 1. Flan de huevo casero -->
    <div class="carousel-item"
      data-name="Flan de huevo casero"
      data-img="{{ asset('img/img1_carrusel3.png') }}"
      data-ingredientes="4 huevos, 500 ml de leche, 100 g de azúcar, 1 cucharadita de esencia de vainilla, 100 g de azúcar (para el caramelo)"
      data-instructions="Para el caramelo: derrite los 100 g de azúcar a fuego medio hasta que tome color dorado. Vierte en moldes. Bate los huevos con los 100 g de azúcar, añade la leche y la vainilla. Llena los moldes con esta mezcla. Hornea al baño María a 180 °C durante 45 min. Deja enfriar y desmolda.">
      <img src="{{ asset('img/img1_carrusel3.png') }}" alt="Flan de huevo casero">
    </div>
    <!-- 2. Mousse de chocolate -->
    <div class="carousel-item"
      data-name="Mousse de chocolate"
      data-img="{{ asset('img/img2_carrusel3.png') }}"
      data-ingredientes="200 g de chocolate negro, 4 huevos, 50 g de azúcar, 1 pizca de sal"
      data-instructions="Derrite el chocolate al baño María. Separa las claras de las yemas. Añade las yemas al chocolate templado. Monta las claras a punto de nieve con sal y azúcar. Incorpora suavemente al chocolate en movimientos envolventes. Refrigera 4 horas antes de servir.">
      <img src="{{ asset('img/img2_carrusel3.png') }}" alt="Mousse de chocolate">
    </div>
    <!-- 3. Arroz con leche -->
    <div class="carousel-item"
      data-name="Arroz con leche"
      data-img="{{ asset('img/img3_carrusel3.png') }}"
      data-ingredientes="1 litro de leche entera, 150 g de arroz redondo, 150 g de azúcar, 1 rama de canela, Cáscara de limón, Canela en polvo (para decorar)"
      data-instructions="Hierve la leche con la canela y la cáscara de limón. Añade el arroz y cocina a fuego lento 45 min, removiendo. Incorpora el azúcar, remueve 5 minutos más. Deja enfriar y espolvorea canela antes de servir.">
      <img src="{{ asset('img/img3_carrusel3.png') }}" alt="Arroz con leche">
    </div>
    <!-- 4. Tarta de queso sin horno -->
    <div class="carousel-item"
      data-name="Tarta de queso sin horno"
      data-img="{{ asset('img/img4_carrusel3.png') }}"
      data-ingredientes="200 g de galletas, 100 g de mantequilla, 500 g de queso crema, 200 ml de nata, 100 g de azúcar, 6 hojas de gelatina, Mermelada de frutos rojos"
      data-instructions="Tritura las galletas y mezcla con mantequilla derretida. Forra un molde. Hidrata la gelatina. Bate el queso con azúcar y nata. Disuelve la gelatina en un poco de nata caliente y añade a la mezcla. Vierte sobre la base y enfría 6 horas. Cubre con mermelada antes de servir.">
      <img src="{{ asset('img/img4_carrusel3.png') }}" alt="Tarta de queso sin horno">
    </div>
    <!-- 5. Natillas caseras -->
    <div class="carousel-item"
      data-name="Natillas caseras"
      data-img="{{ asset('img/img5_carrusel3.png') }}"
      data-ingredientes="500 ml de leche, 4 yemas de huevo, 100 g de azúcar, 1 cucharada de maicena, 1 rama de canela, Cáscara de limón"
      data-instructions="Hierve la leche con la canela y la cáscara de limón. Retira y cuela. Bate las yemas con azúcar y maicena. Añade la leche caliente poco a poco. Cocina a fuego bajo removiendo hasta espesar. Refrigera. Puedes decorar con galleta o canela.">
      <img src="{{ asset('img/img5_carrusel3.png') }}" alt="Natillas caseras">
    </div>
    <!-- 6. Bizcocho de yogur (1-2-3) -->
    <div class="carousel-item"
      data-name="Bizcocho de yogur (1-2-3)"
      data-img="{{ asset('img/img6_carrusel3.png') }}"
      data-ingredientes="1 yogur natural (el vaso sirve de medida), 1 vaso de aceite, 2 vasos de azúcar, 3 vasos de harina, 3 huevos, 1 sobre de levadura en polvo, Ralladura de limón"
      data-instructions="Mezcla huevos y azúcar. Añade yogur, aceite, ralladura. Incorpora harina con levadura. Vierte en un molde engrasado y hornea 35 min a 180 °C.">
      <img src="{{ asset('img/img6_carrusel3.png') }}" alt="Bizcocho de yogur">
    </div>
    <!-- 7. Brownie de chocolate -->
    <div class="carousel-item"
      data-name="Brownie de chocolate"
      data-img="{{ asset('img/img7_carrusel3.png') }}"
      data-ingredientes="200 g de chocolate, 100 g de mantequilla, 150 g de azúcar, 3 huevos, 100 g de harina, Nueces (opcional)"
      data-instructions="Derrite el chocolate con mantequilla. Bate los huevos con azúcar. Añade el chocolate y la harina. Incorpora nueces si deseas. Vierte en un molde y hornea 20-25 min a 180 °C.">
      <img src="{{ asset('img/img7_carrusel3.png') }}" alt="Brownie de chocolate">
    </div>
    <!-- 8. Peras al vino tinto -->
    <div class="carousel-item"
      data-name="Peras al vino tinto"
      data-img="{{ asset('img/img8_carrusel3.png') }}"
      data-ingredientes="4 peras, 500 ml de vino tinto, 150 g de azúcar, 1 rama de canela, Cáscara de limón"
      data-instructions="Pela las peras y colócalas en una olla. Añade el vino, azúcar, canela y limón. Cocina a fuego lento 30-40 min. Deja enfriar en su jugo.">
      <img src="{{ asset('img/img8_carrusel3.png') }}" alt="Peras al vino tinto">
    </div>
    <!-- 9. Crepes dulces -->
    <div class="carousel-item"
      data-name="Crepes dulces"
      data-img="{{ asset('img/img9_carrusel3.png') }}"
      data-ingredientes="250 ml de leche, 2 huevos, 125 g de harina, 1 cucharadita de azúcar, 1 cucharadita de mantequilla derretida"
      data-instructions="Mezcla todos los ingredientes hasta obtener una masa líquida. Cocina en una sartén antiadherente con un poco de mantequilla, por ambos lados. Rellena con Nutella, mermelada, plátano, etc.">
      <img src="{{ asset('img/img9_carrusel3.png') }}" alt="Crepes dulces">
    </div>
    <!-- 10. Helado casero de plátano (sin heladera, vegano) -->
    <div class="carousel-item"
      data-name="Helado casero de plátano (sin heladera, vegano)"
      data-img="{{ asset('img/img10_carrusel3.png') }}"
      data-ingredientes="3 plátanos maduros, 1 cucharadita de esencia de vainilla, 1 cucharada de mantequilla de cacahuete (opcional)"
      data-instructions="Corta y congela los plátanos durante al menos 4 horas. Tritúralos en un procesador hasta tener una textura cremosa. Añade vainilla y mantequilla de cacahuete si quieres. Sirve al momento o guarda en el congelador.">
      <img src="{{ asset('img/img10_carrusel3.png') }}" alt="Helado casero de plátano">
    </div>
  </div>
</div>


  <!-- Popup para mostrar la receta del carrusel -->
  <div class="popup" id="popup">
    <div class="popup-content" style="position:relative;">
      <span class="close-btn" id="closePopup">&times;</span>
      <h2 id="recipeTitle"></h2>
      <img id="recipeImage" src="" alt="" />
      <p id="recipeIngredientes"></p>
      <p id="recipeInstructions"></p>
    </div>
  </div>

  <script src="{{ asset('js/script.js') }}"></script>
        
        <footer>
            <p>&copy; 2025 NutriTech - Todos los derechos reservados.</p>
        </footer>
    </body>
</html>