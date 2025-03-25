import { defineStore, acceptHMRUpdate } from 'pinia'

export const useappData = defineStore('appData', {
  state: () => ({
    posts: [],
    currentPostIndex: null,
    user: null,
  }),
  getters: {},
  actions: {},
})

if (import.meta.hot) {
  import.meta.hot.accept(acceptHMRUpdate(useappData, import.meta.hot))
}
