import { loadMessages } from '~/plugins/i18n'

export default async ({ store }) => {
  await loadMessages(store.getters['lang/locale'])
}
