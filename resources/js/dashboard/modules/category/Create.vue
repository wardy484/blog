<template>
  <vue-form :title="$t('form.create_category')">
    <template #buttons>
      <router-link :to="{ name: 'dashboard.category' }" class="btn btn-sm btn-secondary">{{ $t('form.back') }}</router-link>
    </template>
    <template #content>
      <category-form></category-form>
    </template>
  </vue-form>
</template>

<script>
import CategoryForm from './Form'

export default {
  components: { CategoryForm },
}
</script>
