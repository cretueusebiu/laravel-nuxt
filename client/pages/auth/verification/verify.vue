<template>
  <div class="row">
    <div class="col-lg-8 m-auto">
      <card :title="$t('verify_email')">
        <template v-if="success">
          <div class="alert alert-success" role="alert">
            {{ status }}
          </div>

          <router-link :to="{ name: 'login' }" class="btn btn-primary">
            {{ $t('login') }}
          </router-link>
        </template>
        <template v-else>
          <div class="alert alert-danger" role="alert">
            {{ status || $t('failed_to_verify_email') }}
          </div>

          <router-link :to="{ name: 'verification.resend' }" class="small float-right">
            {{ $t('resend_verification_link') }}
          </router-link>
        </template>
      </card>
    </div>
  </div>
</template>

<script>
import axios from 'axios'

const qs = params => Object.keys(params).map(key => `${key}=${params[key]}`).join('&')

export default {
  middleware: 'guest',

  metaInfo () {
    return { title: this.$t('verify_email') }
  },

  async asyncData ({ params, query }) {
    try {
      const { data } = await axios.post(`/email/verify/${params.id}?${qs(query)}`)

      return { success: true, status: data.status }
    } catch (e) {
      return { success: false, status: e.response.data.status }
    }
  }
}
</script>
