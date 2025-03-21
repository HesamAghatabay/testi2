<template>
  <q-page padding>
    <div class="row q-mt-xl">
      <q-inner-loading size="65px" color="red-8" :showing="loading" />
      <div class="col-5">
        <h1 class="text-h3">Edit Profile Page</h1>
        <q-btn color="green" label="Update" @click="updateProfile" />
      </div>
      <div class="col-7">
        <q-input label="" v-model="fullName" Rounded outlined />
        <q-input label="" v-model="address" Rounded outlined />
        <q-input label="" v-model="city" Rounded outlined />
        <q-input label="" v-model="status" Rounded outlined />
      </div>
    </div>
  </q-page>
</template>

<script setup>
import { Notify } from 'quasar'
import { api } from 'src/boot/axios'
import { onMounted, ref } from 'vue'
import { useRoute, useRouter } from 'vue-router'

const router = useRouter()
const route = useRoute()
const fullName = ref('')
const address = ref('')
const city = ref('')
const status = ref('')
const loading = ref(false)
onMounted(() => {
  loading.value = true
  const userId = route.params.id
  api
    .get(`api/profile/${userId}`)
    .then((r) => {
      const profile = r.data.profile
      fullName.value = profile.full_name
      address.value = profile.address
      city.value = profile.city
      status.value = profile.status
    })
    .catch((e) => {
      console.log(e)
    })
    .finally(() => {
      loading.value = false
    })
})
function updateProfile() {
  const userId = route.params.id
  api
    .put(`api/profile/${userId}`, {
      full_name: fullName.value,
      address: address.value,
      city: city.value,
      status: status.value,
    })
    .then((r) => {
      Notify.create({
        type: 'positive',
        message: 'user profile updated ' + r.data.message,
      })
      router.push('/profile')
    })
    .catch((e) => {
      console.log(e)
    })
}
</script>
