<template>
  <q-page padding>
    <!-- content -->
    <h3>Posts Page</h3>
    <q-inner-loading :showing="loading" size="60px" color="red-9" />
    <div class="row" v-for="(post, index) in posts" :key="'post' + index">
      <div class="col-4">
        <p>{{ post.title }}</p>
      </div>
      <div class="col-4">
        <p>{{ post.body }}</p>
      </div>
      <div class="col-4">
        <q-btn label="Save" @click="save" color="green-7" />
      </div>
    </div>
  </q-page>
</template>

<script setup>
import { api } from 'src/boot/axios'
import { useappData } from 'src/stores/appData'
import { ref } from 'vue'

const posts = ref(null)
const appData = useappData()
api
  .get('api/post')
  .then((r) => {
    console.log('data', r.data)
    posts.value = r.data
    appData.posts = r.data
  })
  .catch((e) => {
    console.log(e)
  })
</script>
