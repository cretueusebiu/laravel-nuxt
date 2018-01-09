import Vue from 'vue'

const requireContext = require.context('./', false, /.*\.(vue)$/)

requireContext.keys().forEach(file => {
  const Component = requireContext(file).default

  if (Component.name) {
    Vue.component(Component.name, Component)
  }
})
