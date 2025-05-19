<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Registro</title>
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" 
        integrity="sha-0evHe/X+R7YkIZDRvuzKMRqM+OrBnVFBL6DOitfPri4tjfHxaWutUpFmBp4vmVor" crossorigin="anonymous">
        <link rel="shortcut icon" href="{{ asset('img/LogoTFG.png')}}">
        <link href="https://fonts.googleapis.com/css2?family=Playfair+Display&display=swap" rel="stylesheet">

        <style>
            body {
                margin: 0;
                padding: 20px 0;
                min-height: 100vh;
                display: flex;
                justify-content: center;
                align-items: flex-start;
                overflow-y: auto;
            }

            h2 {
                font-family: 'Playfair Display', serif;
            }

            .background {
                position: fixed;
                top: 0;
                left: 0;
                height: 100%;
                width: 100%;
                z-index: -1;
            }

            .background img {
                height: 100%;
                width: 100%;
                object-fit: cover;
            }

            .login {
                display: flex;
                flex-direction: column;
                align-items: center;
                padding: 30px;
                border-radius: 150px;
                background-color: rgba(255, 255, 255, 0.9);
                box-shadow: 0 0 10px rgba(0, 0, 0, 0.2);
            }

            label.required::after {
                content: " *";
                color: red;
            }

            .input-line {
                width: 100%;
                border: none;
                border-bottom: 1px solid #ccc;
                padding: 10px 5px;
                font-size: 16px;
                outline: none;
                background: transparent;
            }

            .input-line:focus {
                border-bottom: 2px solid green;
            }

            .boton {
                background-color: green;
                color: white;
                border: none;
                padding: 10px 20px;
                border-radius: 12px;
                font-size: 16px;
                cursor: pointer;
                transition: 0.3s ease;
            }

            .boton:hover {
                background-color: greenyellow;
            }
        </style>
    </head>
    <body>
        <div class="login">
            <h2>DATOS DEL USUARIO</h2>
            <div class="container align-center p-5">
                @if ($errors->any())
                    <div class="alert alert-danger">
                        <ul class="mb-0">
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif
                <form method="POST" action="{{route('validar-registro')}}">
                    @csrf
                    <div class="row g-4">
                        <div class="col-md-6">
                            <label for="userInput" class="form-label required">Nombre</label>
                            <input type="text" class="input-line" id="userInput" name="name" value="{{old('name')}}">
                            @error('name')
                                <div class="text-danger mt-1">{{$message}}</div>
                            @enderror
                        </div>
                        <div class="col-md-6">
                            <label for="lastNameInput" class="form-label">Apellidos</label>
                            <input type="text" class="input-line" id="lastNameInput" name="last_names" value="{{old('last_names')}}">
                        </div>
                        <div class="col-md-6">
                            <label for="emailInput" class="form-label required">Email</label>
                            <input type="email" class="input-line" id="emailInput" name="email" value="{{old('email')}}">
                            @error('email')
                                <div class="text-danger mt-1">{{$message}}</div>
                            @enderror
                        </div>
                        <div class="col-md-6">
                            <label for="ageInput" class="form-label">Edad</label>
                            <input type="number" class="input-line" id="ageInput" name="age" min="0" max="120" step="1" value="{{old('age')}}">
                        </div>
                        <div class="col-md-6">
                            <label for="passwordInput" class="form-label required">Contraseña</label>
                            <input type="password" class="input-line" id="passwordInput" name="password">
                        </div>
                        <div class="col-md-6">
                            <label for="passwordConfirmInput" class="form-label required">Confirmar contraseña</label>
                            <input type="password" class="input-line" id="passwordConfirmInput" name="password_confirmation">
                        </div>
                        <div class="col-md-6">
                            <label for="heightInput" class="form-label">Altura</label>
                            <input type="number" class="input-line" id="heightInput" name="height" min="0" value="{{old('height')}}">
                        </div>
                        <div class="col-md-6">
                            <label for="weightInput" class="form-label">Peso</label>
                            <input type="number" class="input-line" id="weightInput" name="weight" min="0" value="{{old('weight')}}">
                        </div>
                        <div class="col-md-6">
                            <label for="dietInput" class="form-label required">¿Sigues alguna dieta?</label>
                            <select name="diet" id="dietInput" class="input-line">
                                <option selected disabled hidden>Seleccione una opción--</option>
                                <option value="1" {{ old('diet') === '1' ? 'selected' : '' }}>Sí</option>
                                <option value="0" {{ old('diet') === '0' ? 'selected' : '' }}>No</option>
                            </select>
                            @error('diet')
                                <div class="text-danger mt-1">{{$message}}</div>
                            @enderror
                        </div>
                        <div class="col-md-6 pt-4 text-center">
                            <button type="submit" class="boton">Registrarse</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>

        <div class="background">
            <img src="{{ asset('img/FondoLogin.jpeg')}}" alt="Fondo">
        </div>
    </body>
</html>
