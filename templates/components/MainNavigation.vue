<template>
  <nav class="hidden md:flex space-x-10">
    <large-dropdown />
    <a href="#" class="text-base font-medium text-gray-500 hover:text-gray-900"> Pricing </a>
    <a href="#" class="text-base font-medium text-gray-500 hover:text-gray-900"> Docs </a>
    <small-dropdown />
  </nav>
</template>

<script>
import axios from 'axios'
import LargeDropdown from './MainMenu/LargeDropdown.vue'
import SmallDropdown from './MainMenu/SmallDropdown.vue'
export default {
  components: { LargeDropdown, SmallDropdown },

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
