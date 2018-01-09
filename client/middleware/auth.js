export default ({ store, redirect }) => {
  if (!store.getters['auth/check']) {
    return redirect('/login')
  }
}
