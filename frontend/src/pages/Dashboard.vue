<script>
    import { useStore } from "vuex";
    import { computed, onMounted } from "vue";
    import { useRouter } from "vue-router";

    export default {
  setup() {
    const store = useStore();
    const router = useRouter();

    const currentUser = computed(() => {
      return store.state.auth.user;
    });
    function logout() {
      store.dispatch("auth/logout");
      router.push("/login");
    }
    const currentRouteName = computed(() => {
        return router.currentRoute.value.name;
      })
    onMounted(() => {
      if (!currentUser.value) {
        router.push("/login");
      }
    });

    return {
      currentUser,
      logout,
      currentRouteName
    };
  },
  // computed: {
  //   currentUser() {
  //     return this.$store.state.auth.user;
  //   },
  // },
};
</script>
<template>
    <p>{{ currentRouteName }}</p>
</template>
