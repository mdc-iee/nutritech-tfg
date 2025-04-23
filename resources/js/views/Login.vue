<template>
  <main class="container align-center p-5">
    <div v-if="errors.length" class="alert alert-danger">
      <ul class="mb-0">
        <li v-for="(error, index) in errors" :key="index">{{ error }}</li>
      </ul>
    </div>

    <form @submit="login">
      <div class="mb-3">
        <label for="emailInput" class="form-label">Email</label>
        <input type="email" class="form-control" id="emailInput" v-model="form.email" required />
      </div>

      <div class="mb-3">
        <label for="passwordInput" class="form-label">Contraseña</label>
        <input type="password" class="form-control" id="passwordInput" v-model="form.password" required />
      </div>

      <div class="mb-3 form-check">
        <input type="checkbox" class="form-check-input" id="rememberCheck" v-model="form.remember" />
        <label class="form-check-label" for="rememberCheck">Mantener sesión iniciada</label>
      </div>

      <p>¿No tienes cuenta? <router-link to="/register">Regístrate</router-link></p>

      <button type="submit" class="btn btn-primary">Acceder</button>
    </form>
  </main>
</template>

<script>
import axios from 'axios'

export default {

  name: 'Login',

  data() {
    return {
      form: {
        email: '',
        password: '',
        remember: false
      },
      errors: []
    }
  },

  methods: {
    async login() {
      this.errors = []
      try {
        await axios.get('/sanctum/csrf-cookie');  // Obtener cookie CSRF
        const response = await axios.post('/login', this.form);  // Intentar login
        this.$router.push('/home');  // Redirigir al home si login es exitoso
      } catch (error) {
          // Si hay errores en la respuesta de la API
          if (error.response?.data?.errors) {
              // Mostrar los errores específicos
              this.errors = Object.values(error.response.data.errors).flat();
          } else if (error.response?.data?.message) {
              // Mostrar el mensaje genérico de error
              this.errors = [error.response.data.message];
          } else {
              // Mostrar un mensaje genérico si no se pudo identificar el error
              this.errors = ['Error al iniciar sesión.'];
          }
      }
    }
  }
}
</script>
