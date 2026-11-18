<template>
  <vue-form :title="$t('form.create_role')">
    <template #buttons>
      <router-link :to="{ name: 'dashboard.role' }" class="btn btn-sm btn-secondary">{{ $t('form.back') }}</router-link>
    </template>
    <template #content>
      <role-form></role-form>
    </template>
  </vue-form>
</template>

<script>
import RoleForm from './Form'

export default {
  components: { RoleForm },
}
</script>
