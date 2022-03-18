<template>
  <a :href="item.url" :target="item.target" class="text-base font-medium text-gray-500 hover:text-gray-900"> {{ item.title }} </a>
</template>

<script>
export default {
  props: {
    item: {
      type: Object,
      required: true,
      default: function () {
        return {}
      },
    },
  },
}
</script>

<style lang="scss" scoped></style>
