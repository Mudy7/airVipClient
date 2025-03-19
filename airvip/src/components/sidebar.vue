<template>
  <div
    class="fixed left-0 top-0 h-screen w-16 bg-white flex flex-col border-r border-gray-300 py-4"
  >
    <!-- Sidebar Menu with Logo included in spacing -->
    <nav class="flex flex-col items-center space-y-6">
      <!-- Logo (Now part of the menu items) -->
      <button
        @click="navigate('/')"
        class="p-3 rounded-lg hover:bg-gray-200 transition duration-300"
      >
        <img
          src="/assets/icons/logo.png"
          alt="Logo"
          class="w-5 h-5 transition duration-300"
        />
      </button>

      <!-- Menu Items -->
      <button
        v-for="item in menuItems"
        :key="item.name"
        @click="navigate(item.route)"
        class="p-3 rounded-lg hover:bg-gray-200 transition duration-300"
      >
        <img
          :src="isActive(item.route) ? item.iconFilled : item.icon"
          :alt="item.name"
          class="w-5 h-5 transition duration-300"
        />
      </button>
    </nav>

    <!-- Bottom Settings Icon (Pushed Down) -->
    <div class="mt-auto flex items-center justify-center pb-4">
      <button
        @click="navigate('/settings')"
        class="p-3 rounded-lg hover:bg-gray-200 transition duration-300"
      >
        <img
          :src="
            isActive('/settings')
              ? '/assets/icons/settingsFilled.svg'
              : '/assets/icons/settings.svg'
          "
          alt="Settings"
          class="w-5 h-5 transition duration-300"
        />
      </button>
    </div>
  </div>
</template>

<script>
export default {
  name: "Sidebar",
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
