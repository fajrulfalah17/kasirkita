<template>
  <Head>
    <title>Tambah Customer Baru - Kasir Kita</title>
  </Head>

  <main class="c-main">
    <div class="container-fluid">
      <div class="fade-in">
        <div class="row">
          <div class="col-md-12">
            <div class="card boirder-0 rounded-2 shadow border-top-purple">
              <div class="card-header">
                <span class="font-weight-bold"
                  ><i class="fa fa-user"></i> Customer</span
                >
              </div>
              <div class="card-body">
                <form @submit.prevent="submit">
                  <div class="row">
                    <div class="col-md-6">
                      <div class="mb-3">
                        <label class="fw-bold">Nama Customer</label>
                        <input
                          class="form-control"
                          v-model="form.name"
                          :class="{ 'is-invalid': errors.name }"
                          type="text"
                          placeholder="Nama Customer"
                        />
                      </div>
                      <div v-if="errors.name" class="alert alert-danger">
                        {{ errors.name }}
                      </div>
                    </div>
                    <div class="col-md-6">
                      <div class="mb-3">
                        <label class="fw-bold">No Telepon</label>
                        <input
                          class="form-control"
                          v-model="form.no_telp"
                          :class="{ 'is-invalid': errors.no_telp }"
                          type="text"
                          placeholder="No Telepon"
                        />
                      </div>
                      <div v-if="errors.no_telp" class="alert alert-danger">
                        {{ errors.no_telp }}
                      </div>
                    </div>
                  </div>

                  <div class="mb-3">
                    <label class="fw-bold">Alamat</label>
                    <textarea
                      rows="4"
                      placeholder="Alamat"
                      v-model="form.address"
                      :class="{ 'is-invalid': errors.address }"
                      class="form-control"
                    ></textarea>
                  </div>
                  <div v-if="errors.address" class="alert alert-danger">
                    {{ errors.address }}
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
      no_telp: "",
      address: "",
    });

    // method submit
    const submit = () => {
      Inertia.post(
        "/apps/customers",
        {
          // data
          name: form.name,
          no_telp: form.no_telp,
          address: form.address,
        },
        {
          onSuccess: () => {
            Swal.fire({
              title: "Success!",
              text: "Customer sukses terbuat.",
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