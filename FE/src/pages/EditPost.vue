<template>
  <q-page padding>
    <!-- content -->
    <h3>Edit Posts Page</h3>
    <q-inner-loading :showing="loading" size="60px" color="red-9" />
    <q-input v-model="post.title" placeholder="Post title" />
    <q-input v-model="post.body" placeholder="Post body" type="textarea" />
    <q-btn @click="savePost" label="save Post" color="primary" class="full-width q-mt-sm" rounded />
  </q-page>
</template>

<script setup>
import { Notify } from 'quasar'
import { api } from 'src/boot/axios'
import { useappData } from 'src/stores/appData'
import { onMounted, reactive } from 'vue'
import { useRoute, useRouter } from 'vue-router'

const route = useRoute()
const router = useRouter()
const appData = useappData()
const post = reactive({
  title: null,
  body: null,
  img: null,
})

onMounted(() => {
  if (appData.posts.length > 0) {
    post.id = appData.posts[appData.currentPostIndex].id
    post.title = appData.posts[appData.currentPostIndex].title
    post.body = appData.posts[appData.currentPostIndex].body
    post.img = appData.posts[appData.currentPostIndex].img
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
function savePost() {
  api
    .put('api/post/' + route.params.id, post)
    .then((r) => {
      if (r.data.status) {
        Notify.create({
          type: 'positive',
          message: 'Post created successfully',
        })
        router.push('/posts')
      } else {
        Notify.create({ type: 'negative', message: 'Post creation failed' })
      }
    })
    .catch((e) => {
      console.log(e)
      Notify.create({
        type: 'negative',
        message: 'Post creation failed',
      })
    })
}
</script>
