const webpack = require('webpack')

require('dotenv').config()

module.exports = {
  srcDir: __dirname,

  env: {
    apiUrl: process.env.APP_URL || 'https://api.laravel-nuxt.test',
    clientUrl: process.env.clientUrl || 'http://localhost:3000',
    appName: process.env.APP_NAME || 'Laravel-Nuxt',
    appLocale: process.env.APP_LOCALE || 'en',
    githubAuth: !!process.env.GITHUB_CLIENT_ID
  },

  head: {
    title: process.env.APP_NAME,
    titleTemplate: '%s - ' + process.env.APP_NAME,
    meta: [
      { charset: 'utf-8' },
      { name: 'viewport', content: 'width=device-width, initial-scale=1' },
      { hid: 'description', name: 'description', content: 'Nuxt.js project' }
    ],
    link: [
      { rel: 'icon', type: 'image/x-icon', href: '/favicon.ico' }
    ]
  },

  loading: { color: '#007bff' },

  router: {
    middleware: ['locale', 'check-auth']
  },

  css: [
    { src: '~assets/sass/app.scss', lang: 'lesscss' }
  ],

  plugins: [
    '~components/global',
    '~plugins/i18n',
    '~plugins/vform',
    '~plugins/axios',
    { src: '~plugins/bootstrap', ssr: false },
    '~plugins/fontawesome'
  ],

  modules: [
    '@nuxtjs/router'
  ],

  build: {
    extractCSS: true,

    vendor: [
      'vform', 'axios', 'jquery', 'bootstrap',
      'js-cookie', 'popper.js', 'sweetalert2', 'vue-i18n'
    ],

    plugins: [
      new webpack.ProvidePlugin({
        $: 'jquery',
        jQuery: 'jquery',
        'window.jQuery': 'jquery',
        Popper: ['popper.js', 'default']
      })
    ]
  }
}
