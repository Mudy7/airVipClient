<template>
  <transition
    enter-active-class="transition duration-200 ease-out"
    enter-from-class="translate-y-1 opacity-0"
    enter-to-class="translate-y-0 opacity-100"
    leave-active-class="transition duration-150 ease-in"
    leave-from-class="translate-y-0 opacity-100"
    leave-to-class="translate-y-1 opacity-0"
  >
    <div
      v-if="showDropdown"
      class="absolute mt-2 w-40 bg-white shadow-xl rounded-md overflow-hidden z-20"
    >
      <ul class="p-2">
        <li
          v-for="(option, index) in options"
          :key="index"
          @click="selectOption(option)"
          class="px-2 py-2 cursor-pointer rounded-lg hover:bg-gray-300"
        >
          {{ option }}
        </li>
      </ul>
    </div>
  </transition>
</template>

<script>
export default {
  name: "DropdownMenu",
  props: {
    options: {
      type: Array,
      required: true,
    },
    showDropdown: {
      type: Boolean,
      required: true,
    },
  },
  emits: ["select"],
  methods: {
    selectOption(option) {
      this.$emit("select", option); // Emit the selected option to the parent
    },
  },
};
</script>

<style scoped>
/* Optional styles for better visuals */
</style>
