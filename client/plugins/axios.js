import axios from 'axios'
import swal from 'sweetalert2'

process.env.NODE_TLS_REJECT_UNAUTHORIZED = '0'

export default ({ app, store }) => {
  // Request interceptor
  axios.interceptors.request.use(request => {
    request.baseURL = process.env.apiUrl

    const token = store.getters['auth/token']
    if (token) {
      request.headers.common['Authorization'] = `Bearer ${token}`
    }

    const locale = store.getters['lang/locale']
    if (locale) {
      axios.defaults.headers.common['Accept-Language'] = locale
    }

    // request.headers['X-Socket-Id'] = Echo.socketId()

    return request
  })

  // Response interceptor
  // axios.interceptors.response.use(response => response, error => {
    // const { status } = error.response

    // if (status >= 500) {
    //   swal({
    //     type: 'error',
    //     title: app.i18n.t('error_alert_title'),
    //     text: app.i18n.t('error_alert_text'),
    //     reverseButtons: true,
    //     confirmButtonText: app.i18n.t('ok'),
    //     cancelButtonText: app.i18n.t('cancel')
    //   })
    // }

    // if (status === 401 && store.getters['auth/check']) {
    //   swal({
    //     type: 'warning',
    //     title: app.i18n.t('token_expired_alert_title'),
    //     text: app.i18n.t('token_expired_alert_text'),
    //     reverseButtons: true,
    //     confirmButtonText: app.i18n.t('ok'),
    //     cancelButtonText: app.i18n.t('cancel')
    //   })
    //   .then(async () => {
    //     await store.dispatch('auth/logout')

    //     router.push({ name: 'login' })
    //   })
    // }

    // return Promise.reject(error)
  // })
}
