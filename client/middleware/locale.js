import axios from 'axios'
import { loadMessages } from '~/plugins/i18n'

export default async ({ store }) => {
  if (process.server) {
    const locale = store.getters['lang/locale']
    if (locale) {
      axios.defaults.headers.common['Accept-Language'] = locale
    }
  }

  await loadMessages(store.getters['lang/locale'])
}
