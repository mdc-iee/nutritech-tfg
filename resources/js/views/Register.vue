<template>
  <main class="container align-center p-5">
    <div v-if="errors.length" class="alert alert-danger">
      <ul class="mb-0">
        <li v-for="(error, index) in errors" :key="index">{{ error }}</li>
      </ul>
    </div>

    <form @submit="register">
      <div class="mb-3">
        <label for="nameInput" class="form-label">Nombre</label>
        <input type="text" class="form-control" id="nameInput" v-model="form.name" required>
      </div>

      <div class="mb-3">
        <label for="lastNameInput" class="form-label">Apellidos</label>
        <input type="text" class="form-control" id="lastNameInput" v-model="form.last_names">
      </div>

      <div class="mb-3">
        <label for="emailInput" class="form-label">Email</label>
        <input type="email" class="form-control" id="emailInput" v-model="form.email" required>
      </div>

      <div class="mb-3">
        <label for="passwordInput" class="form-label">Contraseña</label>
        <input type="password" class="form-control" id="passwordInput" v-model="form.password" required>
      </div>

      <div class="mb-3">
        <label for="passwordConfirmInput" class="form-label">Confirmar contraseña</label>
        <input type="password" class="form-control" id="passwordConfirmInput" v-model="form.password_confirmation"
          required>
      </div>

      <div class="mb-3">
        <label for="ageInput" class="form-label">Edad</label>
        <input type="number" class="form-control" id="ageInput" v-model="form.age" min="0" max="120">
      </div>

      <div class="mb-3">
        <label for="heightInput" class="form-label">Altura</label>
        <input type="number" class="form-control" id="heightInput" v-model="form.height" min="0" max="300">
      </div>

      <div class="mb-3">
        <label for="weightInput" class="form-label">Peso</label>
        <input type="number" class="form-control" id="weightInput" v-model="form.weight" min="0" max="200">
      </div>

      <div class="mb-3">
        <label for="dietInput" class="form-label">¿Sigues alguna dieta?</label>
        <select v-model="form.diet" class="form-select" required>
          <option disabled value="">Seleccione una opción--</option>
          <option :value="1">Sí</option>
          <option :value="0">No</option>
        </select>
      </div>

      <button type="submit" class="btn btn-primary">Registrarse</button>
    </form>
  </main>
</template>

<script>
import axios from 'axios'

export default {

  name: 'Register',

  data() {
    return {
      form: {
        name: '',
        last_names: '',
        email: '',
        password: '',
        password_confirmation: '',
        age: '',
        height: '',
        weight: '',
        diet: '',
      },
      errors: [],
    }
  },

  methods: {
    async register() {
      this.errors = []
      try {
        await axios.get('/sanctum/csrf-cookie')
        await axios.post('/validar-registro', this.form)
        this.$router.push('/home')
      } catch (error) {
        if (error.response && error.response.data.errors) {
          this.errors = Object.values(error.response.data.errors).flat()
        } else {
          this.errors.push('Error inesperado. Intenta de nuevo.')
        }
      }
    }
  }
}
</script>
