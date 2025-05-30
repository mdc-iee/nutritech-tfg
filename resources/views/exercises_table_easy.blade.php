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
        <!-- Icons -->
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
        <link rel="shortcut icon" href="{{asset('img/LogoTFG.png')}}">
    </head>
    <body>
        
    <div class="contenedor text-center">
    <h1>Rutina - Nivel Fácil</h1>

    <div class="ejercicio my-3">
        <strong>Brazos:</strong> 10 flexiones contra la pared
        <br>
        <img src="{{ asset('img/img1_facil.png') }}" alt="Flexiones contra la pared" class="img-fluid">
    </div>

    <div class="ejercicio my-3">
        <strong>Piernas:</strong> 15 sentadillas asistidas
        <br>
        <img src="{{ asset('img/img2_facil.webp') }}" alt="Sentadillas asistidas" class="img-fluid">
    </div>

    <div class="ejercicio my-3">
        <strong>Abdomen:</strong> 10 abdominales básicas
        <br>
        <img src="{{ asset('img/img3_facil.png') }}" alt="Abdominales básicas" class="img-fluid">
    </div>

    <div class="ejercicio my-3">
        <strong>Cardio:</strong> 5 minutos de caminata en sitio
        <br>
        <img src="{{ asset('img/img4_facil.png') }}" alt="Caminata en el sitio" class="img-fluid">
    </div>

    <a href="{{route('exercises')}}" class="btn btn-primary mt-3">Volver</a>
</div>
    </body>
</html>