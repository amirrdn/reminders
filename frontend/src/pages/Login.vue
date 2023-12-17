<template>
    <div class="login-box">
        <div class="login-logo">
            <a href=""><b>Admin</b>LTE</a>
        </div>
        <div class="card">
            <div class="card-body login-card-body">
                <p class="login-box-msg">Sign in to start your session</p>

                <form @submit.prevent="handleLogin">
                    <div class="input-group mb-3">
                    <input type="email" class="form-control" placeholder="Email" v-model="email">
                    <div class="input-group-append">
                        <div class="input-group-text">
                        <span class="fas fa-envelope"></span>
                        </div>
                    </div>
                    </div>
                    <div class="input-group mb-3">
                    <input type="password" class="form-control" placeholder="Password" v-model="password">
                    <div class="input-group-append">
                        <div class="input-group-text">
                        <span class="fas fa-lock"></span>
                        </div>
                    </div>
                    </div>
                    <div class="row">
                    <div class="col-8">
                        <div class="icheck-primary">
                        <input type="checkbox" id="remember">
                        <label for="remember">
                            Remember Me
                        </label>
                        </div>
                    </div>
                    <!-- /.col -->
                    <div class="col-4">
                        <button type="submit" class="btn btn-primary btn-block">Sign In</button>
                    </div>
                    <!-- /.col -->
                    </div>
                </form>
            </div>
        </div>
    </div>
</template>

<script>
import { computed, ref } from "vue";
import { useStore } from "vuex";
import { useRouter } from "vue-router";

export default {
  // eslint-disable-next-line vue/multi-word-component-names
  name: "Login",
  setup() {
    const loading = ref(false);
    const message = ref("");
    const router = useRouter();
    const email = ref("");
    const password = ref("");
    const sitebody = document.body;

    const store = useStore();

    const loggedIn = computed(() => {
      return store.state.auth.status.loggedIn;
    });

    const usersv = computed(() => {
      return store.state.auth;
    });
    

    const handleLogin = async () => {
      // eslint-disable-next-line no-const-assign
      const user = {
        email: email.value,
        password: password.value,
      };
      loading.value = true;
      await store.dispatch("auth/login", user).then(
        () => {
          sitebody.classList.remove("login-page");
          router.push("/");
        },
        (error) => {
          loading.value = false;
          message.value =
            (error.response && error.response.data && error.response.data.message) ||
            error.message ||
            error.toString();
        }
      );
    }
    return {
      loading,
      message: "",
      loggedIn,
      handleLogin,
      email,
      password,
      usersv
    };
  },
};
</script>