<template>
  <q-page padding>
    <!-- content -->

      <q-page padding>
        <!-- content -->
        <h3>Create Post Page</h3>
        <q-input label="title" v-model="post.title" Rounded outlined />
        <q-input label="body" v-model="post.body" Rounded outlined />
        <q-input label="img" v-model="post.img" Rounded outlined />
        <q-btn color="orange-8" class="q-mt-sm" label="Create" @click="createpost" />
      </q-page>
 


  </q-page>
</template>

<script setup>
      import { Notify } from 'quasar'
      import { api } from 'src/boot/axios'
      import { reactive } from 'vue'
      import { useRouter } from 'vue-router'

      const router = useRouter()
      const post = reactive({
        title: null,
        body: null,
        img: null,
      })
      function createpost() {
        api
          .post('api/post', post)
          .then((r) => {
            if (r.data.status) {
              Notify.create({
                type: 'positive',
                message: 'Post created successfully',
              })
              router.push('/posts')
            } else {
              Notify.create({
                type: 'negative',
                message: 'Post creation failed',
                icon: 'person_add',
              })
            }
          })
          .catch((e) => {
            console.log(e)
            Notify.create({
              type: 'negative',
              message: 'Post creation failed',
              icon: 'person_add',
            })
          })
      }
</script>
