import Vue from 'vue'
import axios from 'axios'
import VueI18n from 'vue-i18n'

Vue.use(VueI18n)

export default ({ app, store }) => {
  app.i18n = new VueI18n({
    locale: process.env.appLocale,
    messages: {
      en: require('~/lang/en.json')
    }
  })
}

/**
 * @param {String} locale
 */
export async function setLocale (locale) {
  await loadTranslations(locale)

  if (i18n.locale !== locale) {
    i18n.locale = locale
    store.dispatch('lang/setLocale', { locale })
    document.querySelector('html').setAttribute('lang', locale)
  }
}

/**
 * @param {String} locale
 */
async function loadTranslations (locale) {
  if (Object.keys(i18n.getLocaleMessage(locale)).length === 0) {
    const { data } = await axios.get(`/translations/${locale}`)

    i18n.setLocaleMessage(locale, data)
  }
}
