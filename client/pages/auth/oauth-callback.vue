<template>
  <div class="row">
    <div class="col-lg-8 m-auto">
      <card :title="$t('login')">

      </card>
    </div>
  </div>
</template>

<script>
export default {
  middleware: 'guest',

  async created () {
    this.$store.dispatch('auth/oauthCallback', {
      driver: this.$route.params.driver,
      params: this.$route.query
    })
  }
}
</script>
