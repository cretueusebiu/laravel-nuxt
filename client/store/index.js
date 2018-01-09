import { cookieFromRequest } from '~/utils'

export const actions = {
  nuxtServerInit ({ commit }, { req }) {
    const token = cookieFromRequest(req, 'token')

    if (token) {
      commit('auth/SET_TOKEN', token)
    }
  }
}
