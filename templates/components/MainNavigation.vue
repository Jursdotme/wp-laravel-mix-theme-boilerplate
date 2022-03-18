<template>
  <nav class="hidden md:flex space-x-10">
    <template v-for="(item, index) in menuItems" :key="index">
      <component v-bind:is="itemType(item)" :item="item"></component>
    </template>
    <!-- <large-dropdown />
    <a href="#" class="text-base font-medium text-gray-500 hover:text-gray-900"> Pricing </a>
    <a href="#" class="text-base font-medium text-gray-500 hover:text-gray-900"> Docs </a>
    <small-dropdown /> -->
  </nav>
</template>

<script>
import axios from 'axios'
import LargeDropdown from './MainMenu/LargeDropdown.vue'
import SmallDropdown from './MainMenu/SmallDropdown.vue'
import SimpleLink from './MainMenu/SimpleLink.vue'
export default {
  components: { LargeDropdown, SmallDropdown, SimpleLink },

  data() {
    return {
      menuItems: [],
    }
  },

  methods: {
    itemType: function (item) {
      if (item.children === undefined || item.children.length == 0) {
        return 'SimpleLink'
      } else {
        return 'SmallDropdown'
      }
    },
  },

  created() {
    // when the Vue app is booted up, this is run automatically.
    axios
      .get('http://localhost:8888/wp-json/wp/v2/primary_desktop_menu')
      .then((response) => {
        let input = response.data

        let output = []

        for (const menuItem of input) {
          let parentId = menuItem['menu_item_parent']
          if (parentId == 0) {
            output.push(menuItem)
          } else {
            parent = output.find((item) => {
              if (item.ID == parentId) {
                return true
              } else {
                return false
              }
            })

            if ('children' in parent) {
              parent.children.push(menuItem)
            } else {
              parent.children = [menuItem]
            }
          }
        }

        this.menuItems = output
      })
      .catch((error) => {
        console.log(error)
      })
  },
}
</script>

<style lang="scss" scoped></style>
