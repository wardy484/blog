<template>
  <vue-form :title="$t('form.edit_category')">
    <template #buttons>
      <router-link :to="{ name: 'dashboard.category' }" class="btn btn-sm btn-secondary">{{ $t('form.back') }}</router-link>
    </template>
    <template #content>
      <category-form :category="category"></category-form>
    </template>
  </vue-form>
</template>

<script>
import CategoryForm from './Form'

export default {
  components: { CategoryForm },
  data() {
    return {
      category: undefined
    }
  },
  created() {
    this.loadCategory()
  },
  methods: {
    loadCategory() {
      this.$http.get('category/' + this.$route.params.id + '/edit')
        .then((response) => {
          this.category = response.data.data
        })
    },
  }
}
</script>
