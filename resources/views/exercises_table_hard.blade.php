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
       <div class="contenedor">
    <h1>Rutina - Nivel Avanzado</h1>
    <div class="ejercicio">
      <strong>Brazos:</strong> 20 flexiones diamante
      <br>
      <img src="{{ asset('img/img1_avanzado.png') }}" alt="Flexiones diamante">
    </div>
    <div class="ejercicio">
      <strong>Piernas:</strong> 25 sentadillas con salto
      <br>
      <img src="{{ asset('img/img2_avanzado.png') }}" alt="Sentadillas con salto">
    </div>
    <div class="ejercicio">
      <strong>Abdomen:</strong> Plancha 1 minuto
      <br>
      <img src="{{ asset('img/img3_medio.png') }}" alt="Plancha 1 minuto">
    </div>
    <div class="ejercicio">
      <strong>Cardio:</strong> 10 burpees
      <br>
      <img src="{{ asset('img/img4_avanzado.png') }}" alt="Burpees">
    </div>
    <a href="{{route('exercises')}}" class="btn btn-primary mt-3">Volver</a>
</div>
    </body>
</html>