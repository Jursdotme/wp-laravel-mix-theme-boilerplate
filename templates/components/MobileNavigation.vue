<template>
  <!-- This example requires Tailwind CSS v2.0+ -->
  <div class="flex justify-end md:relative flex md:hidden" id="mainNav">
    <!-- Item active: "text-gray-900", Item inactive: "text-gray-500" -->
    <button
      @click="isOpen = !isOpen"
      type="button"
      class="inline-flex items-center p-0 text-base font-medium text-gray-500 bg-white rounded-md group hover:text-gray-900 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-red-700 focus:bg-transparent hover:bg-transparent"
      aria-expanded="false"
    >
      <span class="sr-only">Hovedmenu</span>
      <svg class="w-12 h-12 text-gray-400 group-hover:text-gray-500" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
        <path fill-rule="evenodd" d="M3 5a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1zM3 10a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1zM3 15a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1z" clip-rule="evenodd"></path>
      </svg>
    </button>

    <transition
      name="fade"
      mode="out-in"
      enter-active-class="transition duration-200 ease-out"
      enter-from-class="translate-y-1 opacity-0"
      enter-to-class="translate-y-0 opacity-100"
      leave-active-class="transition duration-150 ease-in"
      leave-from-class="translate-y-0 opacity-100"
      leave-to-class="translate-y-1 opacity-0"
    >
      <div v-if="isOpen" class="absolute right-0 z-10 w-screen max-w-md mt-3 transform top-20 md:px-2 md:top-12 sm:px-0">
        <div class="overflow-hidden bg-white rounded-lg shadow-lg ring-1 ring-black ring-opacity-5">
          <transition name="fade" mode="out-in">
            <div>
              <template v-for="(menu, index) in primaryItems">
                <div v-if="index == currentItem" class="relative grid gap-6 px-5 py-6 sm:gap-8 sm:p-8">
                  <button v-if="index != 0" class="flex items-center p-3 -m-3 transition duration-150 ease-in-out bg-transparent rounded-lg hover:bg-gray-50 focus:bg-gray-50 hover:bg-transparent" @click=";(currentItem = previousItem), (previousItem = '0')">
                    <svg class="flex-shrink-0 w-8 h-8 text-dg-red" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                      <path fill-rule="evenodd" d="M12.707 5.293a1 1 0 010 1.414L9.414 10l3.293 3.293a1 1 0 01-1.414 1.414l-4-4a1 1 0 010-1.414l4-4a1 1 0 011.414 0z" clip-rule="evenodd"></path>
                    </svg>
                    <p class="mb-0 text-base font-medium text-gray-900">Tilbage</p>
                  </button>

                  <div v-for="item in menu" class="flex items-stretch gap-3">
                    <a :href="item.url" class="flex flex-col justify-center flex-1 p-3 -m-3 transition duration-150 ease-in-out rounded-lg hover:bg-gray-50 focus:bg-gray-50">
                      <p class="mb-0 text-base font-medium text-gray-900">
                        {{ item.title }}
                      </p>
                      <p v-if="item.description" class="mt-1 text-sm text-gray-500">
                        {{ item.description }}
                      </p>
                    </a>
                    <button v-if="hasChildren(item)" class="flex-shrink-0 p-3 -m-3 transition duration-150 ease-in-out bg-transparent rounded-lg hover:bg-gray-50 focus:bg-gray-50" @click="traverse(item.ID)">
                      <svg class="flex-shrink-0 w-8 h-8 text-dg-red" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                        <path fill-rule="evenodd" d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z" clip-rule="evenodd"></path>
                      </svg>
                    </button>
                  </div>
                </div>
              </template>
            </div>
          </transition>

          <!-- Quicklinks -->
          <div v-if="secondaryItems.length != 0" class="px-5 py-5 bg-gray-50 sm:px-8 sm:py-8">
            <div>
              <h3 class="text-sm font-medium tracking-wide text-gray-500 uppercase">Quicklinks</h3>
              <ul role="list" class="mx-0 mt-4 mb-0 space-y-4">
                <li class="text-base truncate" v-for="item in secondaryItems">
                  <a :href="item.url" class="font-medium text-gray-900 transition duration-150 ease-in-out hover:text-gray-700">
                    {{ item.title }}
                  </a>
                </li>
              </ul>
            </div>
          </div>
        </div>
      </div>
    </transition>
  </div>
</template>

<script>
import axios from 'axios'
export default {
  data() {
    return {
      isOpen: false,
      previousItem: 0,
      currentItem: 0,
      primaryItems: [],
      secondaryItems: [],
    }
  },
  methods: {
    traverse(link) {
      this.previousItem = this.currentItem
      this.currentItem = link
    },
    hasChildren(item) {
      return this.primaryItems.hasOwnProperty(item.ID)
    },
  },
  computed: {
    getChildrenNavItems() {
      let children = []
      let grandChildren = []

      for (item of this.menuItems) {
        if (item.children) {
          let items = {
            parent: item.label,
            items: item.children,
          }
          children.push(items)
        }
      }

      for (item of children) {
        for (item of item.items) {
          if (item.children) {
            let items = {
              parent: item.label,
              items: item.children,
            }
            grandChildren.push(items)
          }
        }
      }

      return [...children, ...grandChildren]
    },
  },

  created() {
    // when the Vue app is booted up, this is run automatically.
    axios
      .get('http://localhost:8888/wp-json/wp/v2/primary_mobile_menu')
      .then((response) => {
        this.primaryItems = response.data

        let input = response.data
        const groupBy = (array, key) => {
          // Return the end result
          return array.reduce((result, currentValue) => {
            // If an array already present for key, push it to the array. Else create an array and push the object
            ;(result[currentValue[key]] = result[currentValue[key]] || []).push(currentValue)

            // Return the current iteration `result` value, this will be taken as next iteration `result` value and accumulate
            return result
          }, {}) // empty object is the initial value for result object
        }
        this.primaryItems = groupBy(input, 'menu_item_parent')
      })
      .catch((error) => {
        console.log(error)
      })

    axios
      .get('http://localhost:8888/wp-json/wp/v2/secondary_mobile_menu')
      .then((response) => {
        this.secondaryItems = response.data
      })
      .catch((error) => {
        console.log(error)
      })
  },
}
</script>

<style lang="scss" scoped></style>
