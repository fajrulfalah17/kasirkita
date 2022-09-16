<template>
  <Head>
    <title>Transactions - Kasir Kita</title>
  </Head>

  <main class="c-main">
    <div class="container-fluid">
      <div class="fade-in">
        <div class="row">
          <div class="col-md-4">
            <div class="card border-0 rounded-2 shadow">
              <div class="card-body">
                <div class="input-group mb-3">
                  <span class="input-group-text"
                    ><i class="fa fa-barcode"></i
                  ></span>
                  <input
                    type="text"
                    class="form-control"
                    v-model="barcode"
                    @keyup="searchProduct"
                    placeholder="Scan or Input Barcode"
                  />
                </div>
                <div class="mb-3">
                  <label for="" class="form-label fw-bold">Nama Produk</label>
                  <input
                    type="text"
                    class="form-control"
                    :value="product.title"
                    placeholder="Nama Produk"
                    readonly
                  />
                </div>
                <div class="mb-3">
                  <label for="" class="form-label fw-bold">Nama Produk</label>
                  <input
                    type="text"
                    class="form-control"
                    :value="formatPrice(product.sell_price)"
                    placeholder="Harga Produk"
                    readonly
                  />
                </div>
                <div class="mb-3">
                  <label class="form-label fw-bold">Qty</label>
                  <input
                    type="number"
                    class="form-control text-center"
                    v-model="qty"
                    placeholder="Qty"
                    min="1"
                  />
                </div>
                
                <div class="text-end">
                  <button
                    @click.prevent="clearSearch"
                    class="
                      btn btn-warning btn-md
                      border-0
                      shadow
                      text-uppercase
                      mt-3
                      me-2
                    "
                    :disabled="!product.id"
                  >
                    Reset
                  </button>
                  <button
                    @click.prevent="addToCart"
                    class="
                      btn btn-success btn-md
                      border-0
                      shadow
                      text-uppercase
                      mt-3
                    "
                    :disabled="!product.id"
                  >
                    Add Item
                  </button>
                </div>
              </div>
            </div>
          </div>
          <div class="col-md-8">
            <div v-if="session.error" class="alert alert-danger">
              {{ session.error }}
            </div>

            <div v-if="session.success" class="alert alert-success">
              {{ session.success }}
            </div>

            <div class="card border-0 rounded-3 shadow border-top-success">
              <div class="card-body">
                <div class="row">
                  <div class="col-md-4 col-4">
                    <h4 class="fw-bold">GRAND TOTAL</h4>
                  </div>
                  <div class="col-md-8 col-8 text-end">
                    <h4 class="fw-bold">Rp. {{ formatPrice(grandTotal) }}</h4>
                    <div v-if="change > 0">
                      <hr />
                      <h5 class="text-success">
                        Kembalian :
                        <strong>Rp. {{ formatPrice(change) }}</strong>
                      </h5>
                    </div>
                  </div>
                </div>
              </div>
            </div>
            <div class="card border-0 rounded-2 shadow">
              <div class="card-body">
                <div class="row mb-3">
                  <div class="col-md-6">
                    <label for="" class="fw-bold">Kasir</label>
                    <input
                      type="text"
                      class="form-control"
                      :value="auth.user.name"
                    />
                  </div>
                  <div class="col-md-6 float-end">
                    <label class="fw-bold">Customer</label>
                    <VueMultiselect
                      v-model="customer_id"
                      label="name"
                      track-by="name"
                      :options="customers"
                    ></VueMultiselect>
                  </div>
                </div>
                <hr />
                <table class="table table-bordered">
                  <thead>
                    <tr style="background-color: #e6e6e7">
                      <th scope="col" style="width: 7%">#</th>
                      <th scope="col">Nama Produk</th>
                      <th scope="col">Harga</th>
                      <th scope="col">Qty</th>
                      <th scope="col" style="width: 20%">Sub Total</th>
                    </tr>
                  </thead>
                  <tbody>
                    <tr v-for="cart in carts" :key="cart.id">
                      <td class="text-center" style="width: 7%">
                        <button
                          @click.prevent="destroyCart(cart.id)"
                          class="btn btn-danger btn-sm rounded-pill"
                        >
                          <i class="fa fa-trash"></i>
                        </button>
                      </td>
                      <td style="text-transform: uppercase">
                        {{ cart.product.title }}
                      </td>
                      <td>Rp. {{ formatPrice(cart.product.sell_price) }}</td>
                      <td class="text-center">{{ cart.qty }}</td>
                      <td class="text-end" style="width: 20%">
                        Rp. {{ formatPrice(cart.price) }}
                      </td>
                    </tr>
                    <tr>
                      <td
                        class="text-end fw-bold"
                        style="background: #e6e6e7"
                        colspan="4"
                      >
                        TOTAL
                      </td>
                      <td class="text-end fw-bold" style="background: #e6e6e7">
                        Rp. {{ formatPrice(carts_total) }}
                      </td>
                    </tr>
                  </tbody>
                </table>
                <hr />
                <div
                  class="d-flex align-items-end flex-column bd-highlight mb-3"
                >
                  <div class="mt-auto bd-highlight">
                    <label>Diskon (Rp.)</label>
                    <input
                      type="number"
                      v-model="discount"
                      @keyup="setDiscount"
                      class="form-control"
                      placeholder="Diskon (Rp.)"
                    />
                  </div>
                  <div class="bd-highlight mt-4">
                    <label>Bayar (Rp.)</label>
                    <input
                      type="number"
                      v-model="cash"
                      @keyup="setChange"
                      class="form-control"
                      placeholder="Bayar (Rp.)"
                    />
                  </div>
                </div>
                <div class="text-end mt-4">
                  <button
                    class="
                      btn btn-warning btn-md
                      border-0
                      shadow
                      text-uppercase
                      me-2
                    "
                  >
                    Cancel
                  </button>
                  <button
                    @click.prevent="storeTransaction"
                    class="btn btn-purple btn-md border-0 shadow text-uppercase"
                    :disabled="cash < grandTotal || grandTotal == 0"
                  >
                    Bayar & Print
                  </button>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </main>
</template>

<script>
//import layout
import LayoutApp from "../../../Layouts/App.vue";

//import Heade from Inertia
import { Head } from "@inertiajs/inertia-vue3";

//import VueMultiselect
import VueMultiselect from "vue-multiselect";
import "vue-multiselect/dist/vue-multiselect.css";

//import ref form vue
import { ref } from "vue";

//import axios
import axios from "axios";
import { Inertia } from "@inertiajs/inertia";
import Swal from "sweetalert2";

export default {
  //layout
  layout: LayoutApp,

  //register components
  components: {
    Head,
    VueMultiselect,
  },

  //props
  props: {
    auth: Object,
    customers: Array,
    carts_total: Number,
    session: Object,
    carts: Array,
  },

  //composition API
  setup(props) {
    //define state
    const barcode = ref("");
    const product = ref({});
    const qty = ref(1);

    //metho "searchProduct"
    const searchProduct = () => {
      //fetch with axios
      axios
        .post("/apps/transactions/searchProduct", {
          //send data "barcode"
          barcode: barcode.value,
        })
        .then((response) => {
          if (response.data.success) {
            //assign response to state "product"
            product.value = response.data.data;
          } else {
            //set state "product" to empty object
            product.value = {};
          }
        });
    };

    //method "clearSearch"
    const clearSearch = () => {
      //set state "product" to empty object
      product.value = {};

      //set state "barcode" to empty string
      barcode.value = "";
    };

    const grandTotal = ref(props.carts_total);

    const addToCart = () => {
      Inertia.post(
        "/apps/transactions/addToCart",
        {
          product_id: product.value.id,
          qty: qty.value,
          sell_price: product.value.sell_price,
        },
        {
          onSuccess: () => {
            clearSearch();

            qty.value = 1;

            grandTotal.value = props.carts_total;

            cash.value = 0;

            change.value = 0;
          },
        }
      );
    };

    const destroyCart = (cart_id) => {
      Inertia.post(
        "/apps/transactions/destroyCart",
        {
          cart_id: cart_id,
        },
        {
          onSuccess: () => {
            grandTotal.value = props.carts_total;

            cash.value = 0;

            change.value = 0;
          },
        }
      );
    };

    const cash = ref(0);
    const change = ref(0);
    const discount = ref(0);

    const setDiscount = () => {
      grandTotal = () => {
        grandTotal.value = props.carts_total - discount.value;
      };

      cash.value = 0;

      change.value = 0;
    };

    const setChange = () => {
      change.value = cash.value - grandTotal.value;
    };

    const customer_id = ref("");

    const storeTransaction = () => {
      //HTTP request
      axios
        .post("/apps/transactions/store", {
          //send data to server
          customer_id: customer_id.value ? customer_id.value.id : "",
          discount: discount.value,
          grand_total: grandTotal.value,
          cash: cash.value,
          change: change.value,
        })
        .then((response) => {
          clearSearch();

          qty.value = 1;

          grandTotal.value = props.carts_total;

          cash.value = 0;

          change.value = 0;

          customer_id.value = "";

          Swal.fire({
            title: "Success!",
            text: "Transaksi Berhasil.",
            icon: "success",
            showConfirmButton: false,
            timer: 2000,
          }).then(() => {
            setTimeout(() => {
              window.open(
                `/apps/transactions/print?invoice=${response.data.data.invoice}`,
                "_blank"
              );

              location.reload();
            }, 40);
          });
        });
    };

    return {
      barcode,
      product,
      searchProduct,
      clearSearch,
      qty,
      grandTotal,
      addToCart,
      destroyCart,
      cash,
      change,
      discount,
      setDiscount,
      setChange,
      customer_id,
      storeTransaction,
    };
  },
};
</script>
