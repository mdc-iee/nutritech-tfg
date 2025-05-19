<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Login</title>
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha-0evHe/X+R7YkIZDRvuzKMRqM+OrBnVFBL6DOitfPri4tjfHxaWutUpFmBp4vmVor" crossorigin="anonymous">
        <link rel="shortcut icon" href="{{ asset('img/LogoTFG.png')}}">

        <style>
            body {
                margin: 0;
                padding: 0;
                height: 100vh;
                display: flex;
                justify-content: center;
                align-items: center;
                overflow: hidden;
                position: relative;
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
                border-radius: 50px;
                background-color: rgba(255, 255, 255, 0.9);
                box-shadow: 0 0 10px rgba(0, 0, 0, 0.2);
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
            <img src="{{asset('img/LogoTFG.png')}}" alt="Logo" height="150px" width="150px" style="border-radius: 50%;">
            <div class="container align-center p-5">
                <form method="POST" action="{{route('inicia-sesion')}}">
                    @csrf
                    <div class="mb-3">
                        <label for="emailInput" class="form-label">Email</label>
                        <input type="email" class="input-line" id="emailInput" name="email" value="{{old('email')}}">
                        @error('email')
                            <div class="text-danger mt-1">{{$message }}</div>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label for="passwordInput" class="form-label">Contraseña</label>
                        <input type="password" class="input-line" id="passwordInput" name="password">
                        @error('password')
                            <div class="text-danger mt-1">{{$message }}</div>
                        @enderror
                    </div>
                    <div class="mb-3 form-check">
                        <input type="checkbox" class="form-check-input" id="rememberCheck" name="remember">
                        <label class="form-check-label" for="rememberCheck">Mantener sesión iniciada</label>
                    </div>
                    <div>
                        <p>¿No tienes cuenta? <a href="{{route('registro')}}">Regístrate</a></p>
                    </div>
                    <button type="submit" class="boton">Acceder</button>
                </form>
            </div>
        </div>

        <div class="background">
            <img src="{{ asset('img/FondoLogin.jpeg')}}" alt="Fondo">
        </div>
    </body>
</html>
