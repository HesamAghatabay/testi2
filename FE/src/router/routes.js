const routes = [
  {
    path: '/',
    component: () => import('layouts/MyLayout.vue'),
    children: [
      { path: '', component: () => import('pages/IndexPage.vue') },
      { path: 'register', component: () => import('pages/RegisterPage.vue') },
      { path: 'login', component: () => import('pages/LoginPage.vue') },
      { path: 'profile', component: () => import('pages/ProfilePage.vue') },
      { path: 'edit-profile/:id', component: () => import('pages/EditProfile.vue') },
      { path: 'sendVerify', component: () => import('pages/SendVerify.vue') },
      { path: 'confirmLogin/:number', component: () => import('pages/ConfirmLogin.vue') },
      { path: 'discover', component: () => import('pages/DiscoverPage.vue') },
      { path: 'create-post', component: () => import('pages/EditPost.vue') },
    ],
  },

  // Always leave this as last one,
  // but you can also remove it
  {
    path: '/:catchAll(.*)*',
    component: () => import('pages/ErrorNotFound.vue'),
  },
]

export default routes
