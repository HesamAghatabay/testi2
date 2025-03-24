<template>
  <q-page class="flex-center">
    <h1 class="text-h3">Index Page</h1>

    <q-btn label="Register" color="amber-9" to="/register" />
    <q-btn label="Login" class="q-mx-sm" color="blue-8" to="/login" />
    <q-btn label="Logout" class="q-mx-sm" color="red-8" @click="logout" />
    <q-btn label="Profile" class="q-mx-sm" color="green-7" to="/profile" />
    <q-btn label="Send Verify Page" color="purple-7" to="/sendVerify" />
  </q-page>
</template>

<script setup>
import { Notify } from 'quasar'
import { api } from 'src/boot/axios'
import { useRouter } from 'vue-router'

const router = useRouter()

function logout() {
  api
    .post('api/logout', {
      headers: {
        Authorization: `Bearer ${localStorage.getItem('access_token')}`,
      },
    })
    .then((r) => {
      localStorage.removeItem('access_token')
      Notify.create({
        type: 'positive',
        position: 'top',
        message: 'user logout ' + r.data.message,
      })
      router.push('/login')
    })
    .catch((e) => {
      console.log(e)
    })
}
</script>
