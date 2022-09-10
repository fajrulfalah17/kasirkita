<template>
  <Head>
    <title>Tambah Kategori Baru - Kasir Kita</title>
  </Head>

  <main class="c-main">
    <div class="container-fluid">
      <div class="fade-in">
        <div class="row">
          <div class="col-md-12">
            <div class="card boirder-0 rounded-2 shadow border-top-purple">
              <div class="card-header">
                <span class="font-weight-bold"
                  ><i class="fa fa-folder"></i> Kategori</span
                >
              </div>
              <div class="card-body">
                <form @submit.prevent="submit">
                  <div class="mb-3">
                    <label class="fw-bold">Nama Kategori</label>
                    <input
                      class="form-control"
                      v-model="form.name"
                      :class="{ 'is-invalid': errors.name }"
                      type="text"
                      placeholder="Nama Kategori"
                    />
                  </div>
                  <div v-if="errors.name" class="alert alert-danger">
                    {{ errors.name }}
                  </div>

                  <div class="mb-3">
                    <label class="fw-bold">Deskripsi</label>
                    <textarea rows="4" placeholder="Deskripsi Kategori" v-model="form.description" :class="{ 'is-invalid': errors.description }" class="form-control"></textarea>
                  </div>
                  <div v-if="errors.description" class="alert alert-danger">
                    {{ errors.description }}
                  </div>

                  <div class="row">
                    <div class="col-12">
                      <button class="btn btn-primary shadow-sm rounded-sm">
                        <i class="fa fa-paper-plane" aria-hidden="true"></i>
                        Save
                      </button>
                      <button class="btn btn-warning shadow-sm rounded-sm ms-3">
                        <i class="fa fa-ban" aria-hidden="true"></i> Reset
                      </button>
                    </div>
                  </div>
                </form>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </main>
</template>

<script>
import LayoutApp from "../../../Layouts/App.vue";

import { Head, Link } from "@inertiajs/inertia-vue3";

import { reactive } from "vue";

import { Inertia } from "@inertiajs/inertia";

import Swal from "sweetalert2";

export default {
  layout: LayoutApp,

  components: {
    Head,
    Link,
  },

  props: {
    errors: Object,
  },

  setup() {
    // define form with reactive
    const form = reactive({
      name: "",
      description: "",
    });

    // method submit
    const submit = () => {
      Inertia.post(
        "/apps/categories",
        {
          // data
          name: form.name,
          description: form.description,
        },
        {
          onSuccess: () => {
            Swal.fire({
              title: "Success!",
              text: "Kategori sukses terbuat.",
              icon: "success",
              showConfirmButton: false,
              timer: 2000,
            });
          },
        }
      );
    };

    return {
      form,
      submit,
    };
  },
};
</script>