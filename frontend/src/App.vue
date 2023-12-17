
<template>
  <div class="wrapper">
    <template v-if="currentRouteName !== 'login'">
      <Headers />
      <Sidebar />
    </template>
    <router-view />
  </div>
</template>

<script>
  import Headers from './components/Headers.vue';
  import Sidebar from './components/Sidebar.vue';
  import { useStore } from "vuex";
  import { computed, onMounted, defineComponent } from "vue";
  import { useRouter } from "vue-router";
  
  
  
  export default defineComponent({
    components: {
      Headers,
      Sidebar
    },
    setup() {
      const store = useStore();
      const router = useRouter();
      const sitebody = document.body;

      onMounted(() =>{
        setTimeout(() => {
          if(router.currentRoute.value.name == 'login'){
            sitebody.classList.add("login-page");
          }
          
        }, 1000);
      })
  
      const currentRouteName = computed(() => {
        return router.currentRoute.value.name;
      })
  
      return{
        currentRouteName
      }
    }
  })
</script>