<template>
  <q-page padding>
    <h1 class="text-h3">Profile Page</h1>
    <!-- <q-inner-loading v-if="!userprofile" color="red-8" size="65px" /> -->
    <div class="row">
      <!-- <div class="col-3" v-if="userprofile"> -->
        <p>{{ profile?.full_name || ' کاربر وجود ندارد ' }}</p>
        <!-- <p>{{ profile?.name || ' کاربر وجود ندارد ' }}</p> -->
        <!-- <p>{{ profile.city }}</p> -->
      <!-- </div> -->
    </div>
  </q-page>
</template>

<script setup>
import { api } from 'src/boot/axios'
import { onMounted, ref } from 'vue'

// const userprofile = ref(false)
const profile = ref(null)
onMounted(() => {
  // userprofile.value = true
  api
    .get('api/profile')
    .then((r) => {
      profile.value = r.data
      console.log(r.data)
    })
    .catch((e) => {
      console.error(e)
    })
    // .finally(() => {
      // userprofile.value = false
    // })
})
</script>
