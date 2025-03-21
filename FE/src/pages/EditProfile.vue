<template>
  <q-page padding>
    <div class="row q-mt-xl">
      <div class="col-5">
        <h1 class="text-h3">Edit Profile Page</h1>
        <q-btn color="green" label="Update" />
      </div>
      <div class="col-7">
        <q-input label="" v-model="full_name" Rounded outlined />
        <q-input label="" v-model="address" Rounded outlined />
        <q-input label="" v-model="city" Rounded outlined />
        <q-input label="" v-model="status" Rounded outlined />
      </div>
    </div>
  </q-page>
</template>

<script setup>
import { api } from 'src/boot/axios'
import { onMounted, ref } from 'vue'
import { useRoute } from 'vue-router'

// const router = useRouter()
const route = useRoute()
const full_name = ref('')
const address = ref('')
const city = ref('')
const status = ref('')

onMounted(() => {
  const userId = route.params.id
  api
    .get(`api/profile/${userId}`)
    .then((r) => {
      console.log('ss', r.data)
      const profile = r.data
      full_name.value = profile.full_name
      address.value = profile.address
      city.value = profile.city
      status.value = profile.status
    })
    .catch((e) => {
      console.log(e)
    })
})
</script>
