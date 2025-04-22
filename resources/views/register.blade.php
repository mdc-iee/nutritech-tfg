<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Registro</title>
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" 
        integrity="sha-0evHe/X+R7YkIZDRvuzKMRqM+OrBnVFBL6DOitfPri4tjfHxaWutUpFmBp4vmVor" crossorigin="anonymous">
    </head>
    <body>
        <main class="container align-center p-5">
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
                <div class="mb-3">
                    <label for="userInput" class="form-label">Nombre</label>
                    <input type="text" class="form-control" id="userInput" name="name" value="{{old('name')}}" required>
                    @error('name')
                        <div class="text-danger mt-1">{{ $message }}</div>
                    @enderror
                </div>
                <div class="mb-3">
                    <label for="lastNameInput" class="form-label">Apellidos</label>
                    <input type="text" class="form-control" id="lastNameInput" name="last_names" value="{{old('last_names')}}">
                </div>
                <div class="mb-3">
                    <label for="emailInput" class="form-label">Email</label>
                    <input type="email" class="form-control" id="emailInput" name="email" required value="{{old('email')}}">
                    @error('email')
                        <div class="text-danger mt-1">{{ $message }}</div>
                    @enderror
                </div>
                <div class="mb-3">
                    <label for="passwordInput" class="form-label">Contraseña</label>
                    <input type="password" class="form-control" id="passwordInput" name="password" required>
                </div>
                <div class="mb-3">
                    <label for="passwordConfirmInput" class="form-label">Confirmar contraseña</label>
                    <input type="password" class="form-control" id="passwordConfirmInput" name="password_confirmation" required>
                </div>
                <div class="mb-3">
                    <label for="ageInput" class="form-label">Edad</label>
                    <input type="number" class="form-control" id="ageInput" name="age" min="0" max="120" step="1" value="{{old('age')}}">
                </div>
                <div class="mb-3">
                    <label for="heightInput" class="form-label">Altura</label>
                    <input type="number" class="form-control" id="heightInput" name="height" min="0" value="{{old('height')}}">
                </div>
                <div class="mb-3">
                    <label for="weightInput" class="form-label">Peso</label>
                    <input type="number" class="form-control" id="weightInput" name="weight" min="0" value="{{old('weight')}}">
                </div>
                <div class="mb-3">
                    <label for="dietInput" class="form-label">¿Sigues alguna dieta?</label>
                    <select name="diet" id="dietInput" class="form-select" required>
                        <option selected disabled hidden>Seleccione una opción--</option>
                        <option value="1" {{ old('diet') === '1' ? 'selected' : '' }}>Sí</option>
                        <option value="0" {{ old('diet') === '0' ? 'selected' : '' }}>No</option>
                    </select>
                    @error('diet')
                        <div class="text-danger mt-1">{{ $message }}</div>
                    @enderror
                </div>
                <button type="submit" class="btn btn-primary">Registrarse</button>
            </form>
        </main>
    </body>
</html>
