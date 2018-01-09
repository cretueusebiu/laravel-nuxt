<template>
  <a v-if="githubAuth" :href="url" class="btn btn-dark ml-auto">
    {{ $t('login_with') }}
    <fa :icon="['fab', 'github']"/>
  </a>
</template>

<script>
export default {
  name: 'LoginWithGithub',

  computed: {
    githubAuth: () => process.env.githubAuth,
    url: () => `${process.env.apiUrl}/oauth/github`
  }
}
</script>
