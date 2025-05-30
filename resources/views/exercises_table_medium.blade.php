<!DOCTYPE html> 
<html>
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Home</title>
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" 
        integrity="sha-0evHe/X+R7YkIZDRvuzKMRqM+OrBnVFBL6DOitfPri4tjfHxaWutUpFmBp4vmVor" crossorigin="anonymous">
        <link href="https://fonts.googleapis.com/css2?family=Playfair+Display&display=swap" rel="stylesheet">
        <link rel="stylesheet" href="{{ asset('css/facil.css') }}">
        <!-- Nav -->
        <link rel="stylesheet" href="{{ asset('css/nav.css') }}">
        <script src="{{ asset('js/nav.js') }}"></script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/js/bootstrap.bundle.min.js"></script>
        <!-- Icons -->
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
        <link rel="shortcut icon" href="{{ asset('img/LogoTFG.png') }}">
        <link rel="stylesheet" href="{{ asset('css/inicio.css') }}"> <!-- si tienes estilos -->
    </head>
    <body>

        <div class="contenedor">
            <h1>Rutina - Nivel Medio</h1>
            <div class="ejercicio">
                <strong>Brazos:</strong> 15 flexiones regulares
                <br>
                <img src="{{ asset('img/img1_medio.png') }}" alt="Flexiones regulares">
            </div>
            <div class="ejercicio">
                <strong>Piernas:</strong> 20 sentadillas completas
                <br>
                <img src="{{ asset('img/img2_medio.png') }}" alt="Sentadillas completas">
            </div>
            <div class="ejercicio">
                <strong>Abdomen:</strong> Plancha 20 segundos
                <br>
                <img src="{{ asset('img/img3_medio.png') }}" alt="Plancha 20 segundos">
            </div>
            <div class="ejercicio">
                <strong>Cardio:</strong> 1 minuto de saltos con cuerda
                <br>
                <img src="{{ asset('img/img4_medio.png') }}" alt="Saltos con cuerda">
            </div>
            <a href="{{ url('exercises_table') }}" class="btn btn-primary mt-3">Volver</a>
        </div>
    </body>
</html>
