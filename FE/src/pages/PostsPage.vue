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
        <q-btn-group>
          <q-btn
            label="Edit"
            @click="$router.push('edit-post/' + post.id)"
            size="sm"
            class="q-mx-xs"
            color="yellow-10"
          />
          <q-btn label="Delete" size="sm" class="q-mx-xs" color="red-8" />
        </q-btn-group>
      </div>
    </div>
  </q-page>
</template>

<script setup>
import { api } from 'src/boot/axios'
import { onMounted, ref } from 'vue'

const posts = ref(null)
const loading = ref(false)
onMounted(() => {
  loading.value = true
  api
    .get('api/post')
    .then((r) => {
      console.log('data', r.data)
      posts.value = r.data
    })
    .catch((e) => {
      console.log(e)
    })
    .finally(() => {
      loading.value = false
    })
})
</script>
