export default async ({ store, req }) => {
  if (!store.getters['auth/check'] && store.getters['auth/token']) {
    await store.dispatch('auth/fetchUser')
  }
}
