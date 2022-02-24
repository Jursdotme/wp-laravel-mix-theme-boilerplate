
<!-- This example requires Tailwind CSS v2.0+ -->
<div class="flex justify-end md:relative" id="mainNav">
  <!-- Item active: "text-gray-900", Item inactive: "text-gray-500" -->
  <button @click="isOpen = !isOpen" type="button" class="inline-flex items-center p-0 text-base font-medium text-gray-500 bg-white rounded-md group hover:text-gray-900 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-red-700 focus:bg-transparent hover:bg-transparent" aria-expanded="false">
    <span class="sr-only">Hovedmenu</span>
    <svg class="w-12 h-12 text-gray-400 group-hover:text-gray-500" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M3 5a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1zM3 10a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1zM3 15a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1z" clip-rule="evenodd"></path></svg>
  </button>

  <!--
    Flyout menu, show/hide based on flyout menu state.

    Entering: "transition ease-out duration-200"
      From: "opacity-0 translate-y-1"
      To: "opacity-100 translate-y-0"
    Leaving: "transition ease-in duration-150"
      From: "opacity-100 translate-y-0"
      To: "opacity-0 translate-y-1"
  -->
  <transition name="fade" mode="out-in">
    <div v-if="isOpen" class="absolute right-0 z-10 w-screen max-w-md mt-3 transform top-20 md:px-2 md:top-12 sm:px-0">
      <div class="overflow-hidden bg-white rounded-lg shadow-lg ring-1 ring-black ring-opacity-5 ">


        <transition name="fade" mode="out-in">
          <div>
            <div v-for="(menu, menuID) in menuREST" v-if="menuID == currentItem" class="relative grid gap-6 px-5 py-6 sm:gap-8 sm:p-8">
              <button v-if="menuID != 0" class="flex items-center p-3 -m-3 transition duration-150 ease-in-out bg-transparent rounded-lg hover:bg-gray-50 focus:bg-gray-50 hover:bg-transparent" @click="currentItem = previousItem; previousItem = '0'">
              <svg class="flex-shrink-0 w-8 h-8 text-dg-red" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M12.707 5.293a1 1 0 010 1.414L9.414 10l3.293 3.293a1 1 0 01-1.414 1.414l-4-4a1 1 0 010-1.414l4-4a1 1 0 011.414 0z" clip-rule="evenodd"></path></svg>
              <p class="mb-0 text-base font-medium text-gray-900">Tilbage</p>
            </button>

              <div v-for="item in menu"  class="flex items-stretch gap-3">
                <a :href="item.url" class="flex flex-col justify-center flex-1 p-3 -m-3 transition duration-150 ease-in-out rounded-lg hover:bg-gray-50 focus:bg-gray-50">
                  <p class="mb-0 text-base font-medium text-gray-900">
                    {{item.title}}
                  </p>
                  <p v-if="item.description" class="mt-1 text-sm text-gray-500">
                    {{item.description}}
                  </p>
                </a>
                <button v-if="hasChildren(item)" class="flex-shrink-0 p-3 -m-3 transition duration-150 ease-in-out bg-transparent rounded-lg hover:bg-gray-50 focus:bg-gray-50" @click="traverse(item.ID)">
                  <svg class="flex-shrink-0 w-8 h-8 text-dg-red" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z" clip-rule="evenodd"></path></svg>
                </button>
              </div>
          </div>
          </div>
        </transition>

        <!-- Quicklinks -->
        <div v-if="quickmenu.length != 0" class="px-5 py-5 bg-gray-50 sm:px-8 sm:py-8">
          <div>
            <h3 class="text-sm font-medium tracking-wide text-gray-500 uppercase">
              Quicklinks
            </h3>
            <ul  role="list" class="mx-0 mt-4 mb-0 space-y-4">
              <li class="text-base truncate" v-for="item in quickmenu">
                <a :href="item.url" class="font-medium text-gray-900 transition duration-150 ease-in-out hover:text-gray-700">
                  {{item.title}}
                </a>
              </li>
            </ul>
          </div>

        </div>
      </div>
    </div>
</transition>
</div>
