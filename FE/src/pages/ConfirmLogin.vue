<template>
  <q-page padding>
    <div class="row q-ma-xl">
      <div class="col-6">
        <h1 class="text-h3">Login Page</h1>
        <q-btn @click="login" class="q-mt-lg" color="amber-9" label="Login" />
      </div>
      <div class="col-6">
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
import { useRoute, useRouter } from 'vue-router'

const route = useRoute()
const router = useRouter()
const mobile = route.params.number
const password = ref('')
const isPwd = ref(true)

function login() {
  api
    .post('/oauth/token', {
      password: password.value,
    })
    .then((r) => {
      if (r.data.status) {
        r.data
      }
      router.push('/profile')
    })
    .catch((e) => {
      console.log(e)
    })
}
</script>
