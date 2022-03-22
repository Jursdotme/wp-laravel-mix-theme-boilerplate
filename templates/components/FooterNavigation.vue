<template>
  <div class="grid grid-cols-2 gap-8 mt-12 xl:mt-0 xl:col-span-2">
    <div class="md:grid md:grid-cols-2 md:gap-8">
      <div v-for="item in firstSection">
        <h3 class="text-sm font-semibold tracking-wider text-gray-400 uppercase">{{ item.title }}</h3>
        <ul role="list" class="mt-4 space-y-4">
          <li v-for="child in item.children" :key="child.id">
            <a :href="child.url" class="text-base text-gray-500 hover:text-gray-900"> {{ child.title }} </a>
          </li>
        </ul>
      </div>
      <div v-for="item in secondSection" class="mt-12 md:mt-0">
        <h3 class="text-sm font-semibold tracking-wider text-gray-400 uppercase">{{ item.title }}</h3>
        <ul role="list" class="mt-4 space-y-4">
          <li v-for="child in item.children" :key="child.id">
            <a :href="child.url" class="text-base text-gray-500 hover:text-gray-900"> {{ child.title }} </a>
          </li>
        </ul>
      </div>
    </div>
    <div v-for="item in thirdSection" class="md:grid md:grid-cols-2 md:gap-8">
      <div>
        <h3 class="text-sm font-semibold tracking-wider text-gray-400 uppercase">{{ item.title }}</h3>
        <ul role="list" class="mt-4 space-y-4">
          <li v-for="child in item.children" :key="child.id">
            <a :href="child.url" class="text-base text-gray-500 hover:text-gray-900"> {{ child.title }} </a>
          </li>
        </ul>
      </div>
      <div v-for="item in forthSection" class="mt-12 md:mt-0">
        <h3 class="text-sm font-semibold tracking-wider text-gray-400 uppercase">{{ item.title }}</h3>
        <ul role="list" class="mt-4 space-y-4">
          <li v-for="child in item.children" :key="child.id">
            <a :href="child.url" class="text-base text-gray-500 hover:text-gray-900"> {{ child.title }} </a>
          </li>
        </ul>
      </div>
    </div>
  </div>
</template>

<script>
import axios from 'axios'
export default {
  data() {
    return {
      menuItems: [],
    }
  },

  computed: {
    firstSection() {
      return this.menuItems.slice(0, 1)
    },
    secondSection() {
      return this.menuItems.slice(1, 2)
    },
    thirdSection() {
      return this.menuItems.slice(2, 3)
    },
    forthSection() {
      return this.menuItems.slice(3, 4)
    },
  },
  created() {
    // when the Vue app is booted up, this is run automatically.
    axios
      .get('http://localhost:8888/wp-json/wp/v2/footer_menu')
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
