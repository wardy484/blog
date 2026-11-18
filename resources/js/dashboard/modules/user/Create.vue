<template>
  <vue-form :title="$t('form.create_user')">
    <template #buttons>
      <router-link :to="{ name: 'dashboard.user' }" class="btn btn-sm btn-secondary">{{ $t('form.back') }}</router-link>
    </template>
    <template #content>
      <user-form></user-form>
    </template>
  </vue-form>
</template>

<script>
import UserForm from './Form'

export default {
  components: { UserForm },
}
</script>
