<template>
  <q-page padding>
    <!-- content -->
    <h3>Posts Page</h3>
    <q-inner-loading :showing="loading" size="60px" color="red-9" />
    <q-btn label="Create Post" class="q-mx-sm" to="/create-post" color="orange-8" />

    <div class="row text-center q-gutter-md q-my-lg">
      <div class="col-2" v-for="(post, index) in posts" :key="'post' + index">
        <q-card>
          <q-card-section>
            <h3>{{ post.title }}</h3>
          </q-card-section>

          <q-card-section>
            <p>{{ post.body }}</p>
          </q-card-section>

          <q-card-actions align="around">
            <q-btn
              flat
              @click="
                appData.currentPostIndex = index;
                $router.push('edit-post/' + post.id)
              "
              color="green-7"
              >Edit</q-btn
            >
            <q-btn flat @click="deletepost(post.id)" color="red-8">Delete</q-btn>
          </q-card-actions>
        </q-card>
      </div>
    </div>
  </q-page>
</template>

<script setup>
import { Notify } from 'quasar'
import { api } from 'src/boot/axios'
import router from 'src/router'
import { useappData } from 'src/stores/appData'
import { onMounted, ref } from 'vue'

const posts = ref(null)
const loading = ref(false)
const appData = useappData()
onMounted(() => {
  loading.value = true
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
    .finally(() => {
      loading.value = false
    })
})
function deletepost(id) {
  api
    .delete('api/post/' + id)
    .then((r) => {
      if (r.data.status) {
        Notify.create({
          type: 'positive',
          message: 'Post deleteed successfully',
        })
        router.push('posts')
      } else
        Notify.create({
          type: 'negative',
          message: 'Server error',
          icon: 'error',
        })
    })
    .catch((e) => {
      console.log(e)
    })
}
</script>
