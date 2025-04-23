<template>
    <main class="container p-5">
      <h1 class="mb-4">Bienvenido, {{ user?.name }}</h1>
      <p>¡Has accedido correctamente al Home!</p>
      <button class="btn btn-danger mt-3" @click="logout">Cerrar sesión</button>
    </main>
  </template>
  
  <script>
  import axios from 'axios'
  
  export default {
    name: 'Home',

    data() {
      return {
        user: null
      }
    },

    async created() {
      try {
        const res = await axios.get('/api/user')
        this.user = res.data
      } catch {
        this.$router.push('/login')
      }
    },
    
    methods: {
      async logout() {
        await axios.post('/logout')
        this.$router.push('/login')
      }
    }
  }
  </script>
  