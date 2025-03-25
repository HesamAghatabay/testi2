<template>
  <q-page padding>
    <!-- content -->
    <h3>Create Post Page</h3>
    <q-input label="title" v-model="post.title" Rounded outlined />
    <q-input label="body" v-model="post.body" Rounded outlined />
    <q-input label="img" v-model="post.img" Rounded outlined />
    <q-btn color="orange-8" class="q-mt-sm" label="Create" @click="createpost"/>
  </q-page>
</template>

<script setup>
import { api } from 'src/boot/axios';
import { reactive } from 'vue'

const post = reactive({
  title: null,
  body: null,
  post: null,
})
function createpost(){
  api.post('post')
}
</script>
