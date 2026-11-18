<template>
  <vue-form :title="$t('form.edit_tag')">
    <template #buttons>
      <router-link :to="{ name: 'dashboard.tag' }" class="btn btn-sm btn-secondary">{{ $t('form.back') }}</router-link>
    </template>
    <template #content>
      <tag-form :tag="tag"></tag-form>
    </template>
  </vue-form>
</template>

<script>
import TagForm from './Form'

export default {
  components: { TagForm },
  data() {
    return {
      tag: undefined
    }
  },
  created() {
    this.loadTag()
  },
  methods: {
    loadTag() {
      this.$http.get('tag/' + this.$route.params.id + '/edit')
        .then((response) => {
          this.tag = response.data.data
        })
    },
  }
}
</script>
