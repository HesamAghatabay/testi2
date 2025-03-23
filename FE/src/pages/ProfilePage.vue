<template>
  <q-page padding>
    <h1 class="text-h3">Profile Page</h1>
    <q-inner-loading :showing="loading" color="red-8" size="65px" />
    <div class="row q-ma-md">
      <div class="col-4">
        <p>{{ user?.profile.full_name || ' کاربر وجود ندارد ' }}</p>
        <p>{{ user?.profile.address || 'آدرس وارد نشده' }}</p>
        <p>{{ user?.profile.city || 'شهر ثبت نشده' }}</p>
      </div>
      <div class="col-4">
        <q-btn color="purple-8" label="Edit Profile" @click="GoToEditProfile(user.id)" />
        <q-btn
          color="purple-8"
          class="q-mx-sm"
          label="Delete Profile"
          @click="DeleteProfile(user.id)"
        />
      </div>
    </div>
  </q-page>
</template>

<script setup>
import { Notify } from 'quasar'
import { api } from 'src/boot/axios'
import { onMounted, ref } from 'vue'
import { useRouter } from 'vue-router'

const loading = ref(false)
const user = ref(null)
const router = useRouter()
onMounted(() => {
  loading.value = true
  api
    .get('api/profile')
    .then((r) => {
      user.value = r.data
      console.log(r.data)
    })
    .catch((e) => {
      console.error(e)
    })
    .finally(() => {
      loading.value = false
    })
})
function GoToEditProfile(userId) {
  router.push(`edit-profile/${userId}`)
}
function DeleteProfile(userId) {
  api
    .delete(`api/profile/${userId}`)
    .then((r) => {
      Notify.create({
        type: 'positive',
        message: 'profile deleted ' + r.data.message,
      })
      router.push('/profile')
    })
    .catch((e) => {
      console.log(e)
    })
}
</script>
