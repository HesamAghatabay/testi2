<template>
  <q-page padding>
    <div class="row q-ma-xl">
      <div class="col-6">
        <h1 class="text-h3">Register Page</h1>
        <q-btn @click="register" class="q-mt-lg" color="amber-9" label="Register" />
      </div>
      <div class="col-6">
        <div class="col-10">
          <q-input v-model="name" Rounded outlined label="name" />
        </div>
        <div class="col-10">
          <q-input suffix="@gmail.com" v-model="email" Rounded outlined label="email" />
        </div>
        <div class="col-10">
          <q-input v-model="mobile" Rounded outlined label="mobile" />
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
const name = ref('')
const email = ref('')
const mobile = ref('')
const password = ref('')
const isPwd = ref(true)

function register() {
  api
    .post('api/register', {
      name: name.value,
      email: email.value,
      mobile: mobile.value,
      password: password.value,
    })
    .then((r) => {
      Notify.create({
        type: 'pos',
        message: r.data.message,
      })
      router.push('/login')
    })
    .catch((e) => {
      Notify.create({
        type: 'ne',
        message: 'register in catch',
      })
      console.log(e)
    })
}
</script>
