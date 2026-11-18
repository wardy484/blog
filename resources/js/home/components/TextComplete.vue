<template>
  <div class="complete-box">
    <textarea ref="textarea"
              :value="modelValue"
              @input="updateValue($event.target.value)"
              @keydown="keyEvent"
              :style="{ 'line-height': lineHeight + 'px' }"
              :class="areaClass"
              :placeholder="placeholder"
              :rows="rows"
              name="textcomplete"></textarea>

    <div class="autocomplete" ref="autocomplete" v-show="showList">
      <ul>
        <li v-for="value in list"
            :class="{ active: actived.value == value }"
            @click="selectList(value)"
            v-html="template(value)"></li>
      </ul>
    </div>
  </div>
</template>

<script>
// Ported from v-textcomplete 0.1.2 (MIT, jcc), which only supports Vue 2.
import getCaretCoordinates from 'textarea-caret'

export default {
  props: {
    modelValue: { type: String, default: '' },
    areaClass: { type: String, default: '' },
    lineHeight: { type: Number, default: 20 },
    strategies: { type: Array, default: () => [] },
    placeholder: { type: String, default: '' },
    rows: { type: Number, default: 2 },
  },
  emits: ['update:modelValue'],
  data() {
    return {
      showList: false,
      list: [],
      match: '',
      actived: { value: '', index: 0 },
      template: () => {},
      replace: () => {},
    }
  },
  watch: {
    modelValue() {
      this.change()
    }
  },
  methods: {
    updateValue(value) {
      this.$refs.textarea.value = value
      this.$emit('update:modelValue', value)
    },
    change() {
      const textarea = this.$refs.textarea
      const content = textarea.value.substring(0, textarea.selectionEnd)
      let matched = false

      this.strategies.forEach((item) => {
        const match = content.match(item.match)

        if (match == null) {
          return
        }

        matched = true

        const coordinates = getCaretCoordinates(textarea, textarea.selectionStart)
        this.$refs.autocomplete.style.top = coordinates.top + this.lineHeight - textarea.scrollTop + 'px'
        this.$refs.autocomplete.style.left = coordinates.left + textarea.offsetLeft + 'px'

        this.template = item.template
        this.match = item.match
        this.replace = item.replace

        if (item.list != undefined && item.list.length > 0 && match[2] == '') {
          this.list = item.list
        } else {
          item.search(match[2].trim(), (list) => { this.list = list })
        }
      })

      this.showList = matched && this.list.length > 0
      this.actived.index = 0
      this.actived.value = this.showList ? this.list[0] : ''
    },
    selectList(value) {
      const textarea = this.$refs.textarea
      const start = textarea.value.substring(0, textarea.selectionEnd)
      const end = textarea.value.slice(textarea.selectionEnd)

      this.close()

      if (!start.match(this.match)) {
        return
      }

      const replaced = start.replace(this.match, this.replace(value))

      this.updateValue(replaced + end)
      textarea.focus()
      setTimeout(() => textarea.setSelectionRange(replaced.length, replaced.length), 1)
    },
    keyEvent(e) {
      if (!this.showList) {
        return
      }

      if ((e.key === 'Enter' || e.key === 'Tab') && this.actived.value) {
        e.preventDefault()
        this.selectList(this.actived.value)
      } else if (e.key === 'ArrowUp' || e.key === 'ArrowDown') {
        e.preventDefault()
        this.move(e.key === 'ArrowUp' ? -1 : 1)
      }
    },
    move(step) {
      const length = this.list.length

      this.actived.index = (this.actived.index + step + length) % length
      this.actived.value = this.list[this.actived.index]
    },
    close() {
      this.showList = false
      this.actived.value = ''
      this.actived.index = 0
    },
  }
}
</script>

<style lang="scss" scoped>
.complete-box {
  position: relative;
  margin: 1em 0 1em;
}
textarea {
  overflow: auto;
}
.autocomplete {
  background-color: #fff;
  position: absolute;
  z-index: 1000;
}
.autocomplete ul {
  list-style: none;
  padding-left: 0;
  border: 1px #f3f5f7 solid;
  border-radius: 3px;
  margin: 0;

  li {
    padding-left: 5px;
    padding-right: 5px;
    border-bottom: 1px solid #f3f5f7;
    text-align: center;
    cursor: pointer;

    &:hover {
      background-color: #f3f5f7;
    }
    span small {
      padding-left: 10px;
    }
  }
  .active {
    background-color: #f3f5f7;
  }
}
</style>
