<template>
  <div
    class="md:hidden fixed bottom-0 left-0 w-full bg-white border-t border-gray-300 flex justify-around py-3 shadow-lg"
  >
    <button
      v-for="item in menuItems"
      :key="item.name"
      @click="navigate(item.route)"
      class="flex flex-col items-center p-2 hover:bg-gray-200 rounded-lg transition duration-300"
    >
      <img
        :src="isActive(item.route) ? item.iconFilled : item.icon"
        :alt="item.name"
        class="w-6 h-6 transition duration-300"
      />
      <span class="text-xs text-gray-600">{{ item.name }}</span>
    </button>
  </div>
</template>

<script>
export default {
  name: "BottomNav",
  data() {
    return {
      menuItems: [
        {
          name: "Home",
          icon: "/assets/icons/home.svg",
          iconFilled: "/assets/icons/homeFilled.svg",
          route: "/",
        },
        {
          name: "Explore",
          icon: "/assets/icons/explore.svg",
          iconFilled: "/assets/icons/exploreFilled.svg",
          route: "/explore",
        },
        {
          name: "Notifications",
          icon: "/assets/icons/notifications.svg",
          iconFilled: "/assets/icons/notificationsFilled.svg",
          route: "/notifications",
        },
      ],
    };
  },
  methods: {
    navigate(route) {
      this.$router.push(route);
    },
    isActive(route) {
      return this.$route.path === route;
    },
  },
};
</script>
