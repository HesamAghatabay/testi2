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
import { Notify } from 'quasar'
import { api } from 'src/boot/axios'
import { useappData } from 'src/stores/appData'
import { onMounted, reactive } from 'vue'
import { useRoute } from 'vue-router'

const route = useRoute()
const appData = useappData()
const post = reactive({
  title: null,
  body: null,
  img: null,
})

onMounted(() => {
  if (appData.posts.length > 0) {
    post.title = appData.posts[appData.currentPostIndex].title
    post.title = appData.posts[appData.currentPostIndex].title
  } else {
    fetchpost()
  }
})
function fetchpost() {
  api
    .get('api/post/' + route.params.id)
    .then((r) => {
      console.log('data', r.data)
      post.title = r.data.title
      post.body = r.data.body
      post.img = r.data.img
    })
    .catch((e) => {
      console.log(e.status)
      if (e.status === 401) {
        localStorage.removeItem('access_token')
        window.location.href = '/'
      }
      if (e.status === 500) {
        Notify.create({
          type: 'negative',
          message: 'Server error',
          icon: 'error',
        })
      }
    })
}
</script>
