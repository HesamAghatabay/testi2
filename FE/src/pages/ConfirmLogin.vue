  <template>
  <q-page padding class="q-gutter-y-md text-center">
    <!-- content -->
    <h1>Welcome</h1>
    <q-input v-model="password" rounded label="Password" type="password" />
    <q-btn @click="login" label="Login" color="primary" class="full-width" rounded />
  </q-page>
</template>

<script setup>
import { Notify } from 'quasar'
import { api } from 'src/boot/axios'
import { ref } from 'vue'
import { useRoute, useRouter } from 'vue-router'
const route = useRoute()
const router = useRouter()
const mobile = route.params.number
const password = ref()

function login() {
  api
    .post('/oauth/token', {
      username: mobile,
      password: password.value,
      grant_type: 'password',
      client_id: 2,
      client_secret: '3zwKBU7c2pOck6waR6XWrVy6YUxp0lsXFHB5WO6y',
      scope: '*',
    })
    .then((r) => {
      if (r.data.access_token) {
        localStorage.setItem('access_token', r.data.access_token)
        api.defaults.headers = {
          Authorization: 'Bearer ' + localStorage.getItem('access_token'),
          'Content-Type': 'application/json',
          Accept: 'application/json;charset=UTF-8',
        }
        Notify.create({
          type: 'positive',
          message: 'User logged in successfully',
          icon: 'person_add',
        })
        router.push('/posts')
      } else {
        Notify.create({
          type: 'negative',
          message: 'User login failed',
          icon: 'person_add',
        })
      }
    })
    .catch((e) => {
      console.log(e)
      Notify.create({
        type: 'negative',
        message: 'User login failed',
        icon: 'person_add',
      })
    })
}
</script>
