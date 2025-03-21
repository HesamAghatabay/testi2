<template>
  <q-page padding>
    <h1 class="text-h3">Profile Page</h1>
    <q-inner-loading :showing="userprofile" color="red-8" size="65px" />
    <div class="row q-ma-md">
      <div class="col-4">
        <p>{{ user?.profile.full_name || ' کاربر وجود ندارد ' }}</p>
        <p>{{ user?.profile.address || 'آدرس وارد نشده' }}</p>
        <p>{{ user?.profile.city || 'شهر ثبت نشده' }}</p>
      </div>
      <div class="col-4">
        <q-btn color="purple-8" label="Edit Profile" @click="GoToEditProfile(user.id)"/>
      </div>
    </div>
  </q-page>
</template>

<script setup>
import { api } from 'src/boot/axios'
import { onMounted, ref } from 'vue'
import { useRouter } from 'vue-router'

const userprofile = ref(false)
const user = ref(null)
const router = useRouter()
onMounted(() => {
  userprofile.value = true
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
      userprofile.value = false
    })
})
function GoToEditProfile(userId){
router.push(`edit-profile/${userId}`)
}
</script>
