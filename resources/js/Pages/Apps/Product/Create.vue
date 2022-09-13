<template>
  <Head>
    <title>Tambah Produk Baru - Kasir Kita</title>
  </Head>

  <main class="c-main">
    <div class="container-fluid">
      <div class="fade-in">
        <div class="row">
          <div class="col-md-12">
            <div class="card boirder-0 rounded-2 shadow border-top-purple">
              <div class="card-header">
                <span class="font-weight-bold"
                  ><i class="fa fa-shopping-bag"></i> Produk</span
                >
              </div>
              <div class="card-body">
                <form @submit.prevent="submit">
                  <div class="row">
                    <div class="col-md-6">
                      <div class="mb-3">
                        <label class="fw-bold">Barcode Produk</label>
                        <input
                          class="form-control"
                          v-model="form.barcode"
                          :class="{ 'is-invalid': errors.barcode }"
                          type="text"
                          placeholder="Barcode Produk"
                        />
                      </div>
                      <div v-if="errors.barcode" class="alert alert-danger">
                        {{ errors.barcode }}
                      </div>
                    </div>
                    <div class="col-md-6">
                      <div class="mb-3">
                        <label class="fw-bold">Kategori Produk</label>
                        <select
                          v-model="form.category_id"
                          :class="{ 'is-invalid': errors.category_id }"
                          class="form-select"
                        >
                          <option
                            v-for="(category, index) in categories"
                            :key="index"
                            :value="category.id"
                          >
                            {{ category.name }}
                          </option>
                        </select>
                      </div>
                      <div v-if="errors.category_id" class="alert alert-danger">
                        {{ errors.category_id }}
                      </div>
                    </div>
                  </div>
                  <div class="row">
                    <div class="col-md-6">
                      <div class="mb-3">
                        <label class="fw-bold">Nama Produk</label>
                        <input
                          class="form-control"
                          v-model="form.title"
                          :class="{ 'is-invalid': errors.title }"
                          type="text"
                          placeholder="Nama Produk"
                        />
                      </div>
                      <div v-if="errors.title" class="alert alert-danger">
                        {{ errors.title }}
                      </div>
                    </div>
                    <div class="col-md-3">
                      <div class="mb-3">
                        <label class="fw-bold">Ukuran Produk</label>
                        <select
                          v-model="form.types_id"
                          :class="{ 'is-invalid': errors.types_id }"
                          class="form-select"
                        >
                          <option
                            v-for="(type, index) in types"
                            :key="index"
                            :value="type.id"
                          >
                            {{ type.name }}
                          </option>
                        </select>
                      </div>
                      <div v-if="errors.types" class="alert alert-danger">
                        {{ errors.types }}
                      </div>
                    </div>
                    <div class="col-md-3">
                      <div class="mb-3">
                        <label class="fw-bold">Stok Produk</label>
                        <input
                          class="form-control"
                          v-model="form.stock"
                          :class="{ 'is-invalid': errors.stock }"
                          type="number"
                          placeholder="Stok Produk"
                        />
                      </div>
                      <div v-if="errors.stock" class="alert alert-danger">
                        {{ errors.stock }}
                      </div>
                    </div>
                  </div>
                  <div class="row">
                    <div class="mb-3">
                      <label class="fw-bold">Deskripsi</label>
                      <textarea
                        rows="4"
                        placeholder="Deskripsi Kategori"
                        v-model="form.description"
                        :class="{ 'is-invalid': errors.description }"
                        class="form-control"
                      ></textarea>
                    </div>
                    <div v-if="errors.description" class="alert alert-danger">
                      {{ errors.description }}
                    </div>
                  </div>
                  <div class="row">
                    <div class="col-md-6">
                      <div class="mb-3">
                        <label class="fw-bold">Harga Beli</label>
                        <input
                          class="form-control"
                          v-model="form.buy_price"
                          :class="{ 'is-invalid': errors.buy_price }"
                          type="number"
                          placeholder="Harga Beli"
                        />
                      </div>
                      <div v-if="errors.buy_price" class="alert alert-danger">
                        {{ errors.buy_price }}
                      </div>
                    </div>
                    <div class="col-md-6">
                      <div class="mb-3">
                        <label class="fw-bold">Harga Jual</label>
                        <input
                          class="form-control"
                          v-model="form.sell_price"
                          :class="{ 'is-invalid': errors.sell_price }"
                          type="number"
                          placeholder="Harga Jual"
                        />
                      </div>
                      <div v-if="errors.sell_price" class="alert alert-danger">
                        {{ errors.sell_price }}
                      </div>
                    </div>
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
    categories: Array,
    types: Array,
  },

  setup() {
    // define form with reactive
    const form = reactive({
      title: "",
      barcode: "",
      buy_price: "",
      sell_price: "",
      category_id: "",
      types_id: "",
      stock: "",
      description: "",
    });

    // method submit
    const submit = () => {
      Inertia.post(
        "/apps/products",
        {
          // data
          barcode: form.barcode,
          title: form.title,
          buy_price: form.buy_price,
          sell_price: form.sell_price,
          category_id: form.category_id,
          types_id: form.types_id,
          stock: form.stock,
          description: form.description,
        },
        {
          onSuccess: () => {
            Swal.fire({
              title: "Success!",
              text: "Produk sukses terbuat.",
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