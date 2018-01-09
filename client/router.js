import Vue from 'vue'
import Router from 'vue-router'

Vue.use(Router)

const routes = [
  { path: '/', name: 'welcome', component: require('~/pages/welcome') },

  { path: '/home', name: 'home', component: require('~/pages/home') },

  { path: '/settings', component: require('~/pages/settings/index'), children: [
    { path: '', redirect: { name: 'settings.profile' }},
    { path: 'profile', name: 'settings.profile', component: require('~/pages/settings/profile') },
    { path: 'password', name: 'settings.password', component: require('~/pages/settings/password') }
  ]},

  { path: '/login', name: 'login', component: require('~/pages/auth/login') },
  { path: '/register', name: 'register', component: require('~/pages/auth/register') },
  { path: '/password/reset', name: 'password.request', component: require('~/pages/auth/password/email') },
  { path: '/password/reset/:token', name: 'password.reset', component: require('~/pages/auth/password/reset') }
]

const scrollBehavior = (to, from, savedPosition) => {
  if (savedPosition) {
    return savedPosition
  }

  let position = {}

  if (to.matched.length < 2) {
    position = { x: 0, y: 0 }
  } else if (to.matched.some(r => r.components.default.options.scrollToTop)) {
    position = { x: 0, y: 0 }
  } if (to.hash) {
    position = { selector: to.hash }
  }

  return position
}

export function createRouter() {
  routes.forEach(r => {
    if (r.component.default) {
      r.component = r.component.default
    }
  })

  return new Router({
    routes,
    scrollBehavior,
    mode: 'history'
  })
}
