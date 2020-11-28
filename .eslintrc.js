module.exports = {
  root: true,
  parserOptions: {
    parser: '@babel/eslint-parser',
    sourceType: 'module',
    requireConfigFile: false
  },
  extends: [
    '@nuxtjs'
  ],
  rules: {
    'vue/max-attributes-per-line': 'off'
  }
}
