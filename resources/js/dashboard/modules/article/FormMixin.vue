<script>
export default {
  data() {
    return {
      selected: null,
      options: [],
      tags: null,
      allTag: [],
      startTime: {
        time: ''
      }
    }
  },
  created() {
    this.loadCategories()
    this.loadTags()
  },
  methods: {
    loadCategories() {
      this.$http.get('categories')
        .then((response) => {
          this.options = response.data.data
        })
    },
    loadTags() {
      this.$http.get('tags')
        .then((response) => {
          this.allTag = response.data.data
        })
    },
  },
}
</script>
