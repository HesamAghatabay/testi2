<template>
  <q-page padding>
    <div class="row q-ma-xl">
      <div class="col-6">
        <h1 class="text-h3">Login Page</h1>
        <q-btn @click="login" class="q-mt-lg" color="amber-9" label="Login" />
      </div>
      <div class="col-6">
        <div class="col-10">
          <q-input suffix="@gmail.com" v-model="email" Rounded outlined label="email" />
        </div>
        <div class="col-10">
          <q-input
            v-model="password"
            Rounded
            outlined
            label="password"
            :type="isPwd ? 'password' : 'text'"
            ><template v-slot:append>
              <q-icon
                :name="isPwd ? 'visibility_off' : 'visibility'"
                class="cursor-pointer"
                @click="isPwd = !isPwd"
              /> </template
          ></q-input>
        </div>
      </div>
    </div>
  </q-page>
</template>

<script setup>
import { Notify } from 'quasar'
import { api } from 'src/boot/axios'
import { ref } from 'vue'
import { useRouter } from 'vue-router'

const router = useRouter()
const email = ref('')
const password = ref('')
const isPwd = ref(true)

function login() {
  api
    .post('/oauth/token', {
      grant_type: 'password',
      client_id: 2,
      client_secret: '3zwKBU7c2pOck6waR6XWrVy6YUxp0lsXFHB5WO6y',
      username: email.value,
      password: password.value,
      scope: '*',
    })
    .then((r) => {
      if (r.data.access_token) {
        localStorage.setItem('access_token', r.data.access_token)
        api.defaults.headers = {
          Authorization: 'Bearer ' + localStorage.getItem('access_token'),
          'Content-Type': 'application/json',
          Accept: 'application/json;charset=UTF-8',
        }
      }
      Notify.create({
        type: 'positive',
        position: 'top',
        message: 'Login successfull ' + r.data.message,
      })
      router.push('/profile')
    })
    .catch((e) => {
      console.log(e)
    })
}
</script>
