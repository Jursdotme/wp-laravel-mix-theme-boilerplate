<template>
  <div class="relative">
    <!-- Item active: "text-gray-900", Item inactive: "text-gray-500" -->
    <button
      v-click-outside="onClickOutside"
      @click="isOpen = !isOpen"
      type="button"
      class="text-gray-500 group bg-white rounded-md inline-flex items-center text-base font-medium hover:text-gray-900 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500"
      aria-expanded="false"
    >
      <span>{{ item.title }}</span>
      <!--
            Heroicon name: solid/chevron-down

            Item active: "text-gray-600", Item inactive: "text-gray-400"
          -->
      <svg class="text-gray-400 ml-2 h-5 w-5 group-hover:text-gray-500" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
        <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd" />
      </svg>
    </button>

    <transition
      enter-active-class="transition ease-out duration-200"
      enter-from-class="opacity-0 translate-y-1"
      enter-to-class="opacity-100 translate-y-0"
      leave-active-class="transition ease-in duration-150"
      leave-from-class="opacity-100 translate-y-0"
      leave-to-class="opacity-0 translate-y-1"
    >
      <div v-show="isOpen" class="absolute z-10 -ml-4 mt-3 transform w-screen max-w-md lg:max-w-2xl lg:ml-0 lg:left-1/2 lg:-translate-x-1/2">
        <div class="rounded-lg shadow-lg ring-1 ring-black ring-opacity-5 overflow-hidden">
          <div class="relative grid gap-6 bg-white px-5 py-6 sm:gap-8 sm:p-8 lg:grid-cols-2">
            <a v-for="item in regular_items" :key="item.id" :href="item.url" class="-m-3 p-3 flex items-start rounded-lg hover:bg-gray-50">
              <template v-if="item.icon">
                <div class="flex-shrink-0 flex items-center justify-center h-10 w-10 rounded-md bg-indigo-500 text-white sm:h-12 sm:w-12">
                  <img :src="item.icon.sizes.thumbnail" class="text-white" />
                </div>
                <div class="ml-4">
                  <p class="text-base font-medium text-gray-900">{{ item.title }}</p>
                  <p class="mt-1 text-sm text-gray-500">{{ item.description }}</p>
                </div>
              </template>

              <template v-else>
                <div>
                  <p class="text-base font-medium text-gray-900">{{ item.title }}</p>
                  <p class="mt-1 text-sm text-gray-500">{{ item.description }}</p>
                </div>
              </template>
            </a>
          </div>

          <div class="p-5 bg-gray-50 sm:p-8">
            <a v-for="item in featured_items" :key="item.id" :href="item.url" class="-m-3 p-3 flow-root rounded-md hover:bg-gray-100">
              <div class="flex items-center">
                <div class="text-base font-medium text-gray-900">{{ item.title }}</div>
                <span class="ml-3 inline-flex items-center px-3 py-0.5 rounded-full text-xs font-medium leading-5 bg-indigo-100 text-indigo-800"> {{ item.pill_label }} </span>
              </div>
              <p class="mt-1 text-sm text-gray-500">{{ item.description }}</p>
            </a>
          </div>
        </div>
      </div>
    </transition>
  </div>
</template>

<script>
import vClickOutside from 'click-outside-vue3'

export default {
  data() {
    return {
      isOpen: false,
    }
  },
  props: {
    item: {
      type: Object,
      required: true,
      default: function () {
        return {}
      },
    },
  },
  computed: {
    regular_items() {
      return this.item.children.filter((children) => children.featured != true)
    },
    featured_items() {
      return this.item.children.filter((children) => children.featured == true)
    },
  },

  directives: {
    clickOutside: vClickOutside.directive,
  },
  methods: {
    onClickOutside(event) {
      this.isOpen = false
    },
  },
}
</script>
