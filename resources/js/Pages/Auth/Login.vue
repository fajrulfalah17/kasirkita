<template>
  <Head>
    <title>Login Akun - Kasir</title>
  </Head>
  <div class="col-md-4">
    <div class="fade-in">
      <div class="text-center mb-4">
        <a href="#" class="text-dark text-decoration-none">
          <img src="/images/icon_user.png" alt="" width="250" />
          <h3 class="mt-2 font-weight-bold">KASIR KITA</h3>
        </a>
      </div>
      <div class="card-group">
        <div class="card border-top-purple border-0 shadow-sm rounded-3">
          <div class="card-body">
            <div class="text-start">
              <h5>LOGIN</h5>
              <p class="text-muted">Masuk ke akun anda</p>
            </div>
            <hr />
            <div v-if="session.status" class="alert alert-success mt-5">
              {{ session.status }}
            </div>
            <form @submit.prevent="submit">
              <div class="input-group mb-3">
                <div class="input-group-prepend">
                  <span class="input-group-text">
                    <i class="fa fa-envelope"></i>
                  </span>
                </div>
                <input
                  type="name"
                  class="form-control"
                  v-model="form.name"
                  :class="{ 'is-invalid': errors.name }"
                  placeholder="Masukkan Nama"
                />
              </div>
              <div class="alert alert-danger" v-if="errors.name">
                {{ errors.name }}
              </div>
              <div class="input-group mb-3">
                <div class="input-group-prepend">
                  <span class="input-group-text">
                    <i class="fa fa-lock"></i>
                  </span>
                </div>
                <input
                  type="password"
                  class="form-control"
                  v-model="form.password"
                  :class="{ 'is-invalid': errors.password }"
                  placeholder="Masukkan Password"
                />
              </div>
              <div class="alert alert-danger" v-if="errors.password">
                {{ errors.password }}
              </div>

              <div class="row">
                <div class="col-12">
                  <button
                    type="submit"
                    class="btn btn-primary shadow-sm rounded-sm px-4 w-100"
                  >
                    Login
                  </button>
                </div>
              </div>
            </form>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>
  
  <script>
import LayoutApp from "../../Layouts/Auth.vue";

import { reactive } from "vue";
import { Inertia } from "@inertiajs/inertia";
import { Head, Link } from "@inertiajs/inertia-vue3";

export default {
  layout: LayoutApp,

  // registter Component
  components: {
    Head,
    Link,
  },
  props: {
    errors: Object,
    session: Object,
  },

  setup() {
    const form = reactive({
      name: "",
      password: "",
    });

    const submit = () => {
      Inertia.post("/login", {
        name: form.name,
        password: form.password,
      });
    };

    return {
      form,
      submit,
    };
  },
};
</script>