<template>
  <q-page padding>
    <div class="row q-ma-xl">
      <div class="col-10">
        <q-input v-model="mobile" Rounded outlined label="mobile" />
      </div>
    </div>
    <q-btn label="sendverify" class="q-ma-lg" color="purple-9" @click="login"/>
  </q-page>
</template>

<script setup>
import { Notify } from 'quasar'
import { api } from 'src/boot/axios'
import { ref } from 'vue'
import { useRouter } from 'vue-router'

const router = useRouter()
const mobile = ref('')


function login() {
  api
    .post('api/sendVerify', {
      username: mobile.value,
    })
    .then((r) => {
     if(r.data.status){
       router.push('/confirmLogin/' + mobile.value)
     }
    })
    .catch((e) => {
      Notify.create({
        type: 'negative',
        position: 'top',
        message: 'Send Verify in catch '+e.message,
      })
      console.error(e)
    })
}
</script>
