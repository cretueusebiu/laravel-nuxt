<template>
  <card :title="$t('your_info')">
    <form @submit.prevent="update" @keydown="form.onKeydown($event)">
      <alert-success :form="form" :message="$t('info_updated')" />

      <!-- Name -->
      <div class="form-group row">
        <label class="col-md-3 col-form-label text-md-right">{{ $t('name') }}</label>
        <div class="col-md-7">
          <input v-model="form.name" :class="{ 'is-invalid': form.errors.has('name') }" type="text" name="name" class="form-control">
          <has-error :form="form" field="name" />
        </div>
      </div>

      <!-- Email -->
      <div class="form-group row">
        <label class="col-md-3 col-form-label text-md-right">{{ $t('email') }}</label>
        <div class="col-md-7">
          <input v-model="form.email" :class="{ 'is-invalid': form.errors.has('email') }" type="email" name="email" class="form-control">
          <has-error :form="form" field="email" />
        </div>
      </div>

      <!-- Submit Button -->
      <div class="form-group row">
        <div class="col-md-9 ml-md-auto">
          <v-button :loading="form.busy" type="success">
            {{ $t('update') }}
          </v-button>
        </div>
      </div>
    </form>
  </card>
</template>

<script>
import Form from 'vform'
import { mapGetters } from 'vuex'

export default {
  scrollToTop: false,

  data: () => ({
    form: new Form({
      name: '',
      email: ''
    })
  }),

  head () {
    return { title: this.$t('settings') }
  },

  computed: mapGetters({
    user: 'auth/user'
  }),

  created () {
    // Fill the form with user data.
    this.form.keys().forEach((key) => {
      this.form[key] = this.user[key]
    })
  },

  methods: {
    update () {
      this.form.patch('/settings/profile').then(({ data: user }) => {
        this.$store.dispatch('auth/updateUser', { user })
      })
    }
  }
}
</script>
