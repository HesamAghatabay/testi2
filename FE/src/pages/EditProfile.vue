<template>
  <q-page padding>
    <div class="row">
      <div class="col-4">
        <h1 class="h3">Edit Profile Page</h1>
        <q-btn color="green" Label="Update" @click="update"/>
      </div>
      <div class="col-6">
        <q-input label="" v-model="full_name" Rounded outlined/>
        <q-input label="" v-model="address" Rounded outlined/>
        <q-input label="" v-model="city" Rounded outlined/>
        <q-input label="" v-model="status" Rounded outlined/>
      </div>
    </div>
  </q-page>
</template>

<script setup>

</script>
