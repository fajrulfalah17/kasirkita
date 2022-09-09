<template>
    <Head>
        <title>Edit User - Kasir Kita</title>
    </Head>

    <main class="c-main">
    <div class="container-fluid">
      <div class="fade-in">
        <div class="row">
          <div class="col-md-12">
            <div class="card boirder-0 rounded-2 shadow border-top-purple">
              <div class="card-header">
                <span class="font-weight-bold"
                  ><i class="fa fa-adjust"></i> Edit Ukuran</span
                >
              </div>
              <div class="card-body">
                <form @submit.prevent="submit">
                  <div class="mb-3">
                    <label class="fw-bold">Nama Ukuran</label>
                    <input
                      class="form-control"
                      v-model="form.name"
                      :class="{ 'is-invalid': errors.name }"
                      type="text"
                      placeholder="Nama Ukuran"
                    />
                  </div>
                  <div v-if="errors.name" class="alert alert-danger">
                    {{ errors.name }}
                  </div>

                  <div class="mb-3">
                    <label class="fw-bold">Deskripsi</label>
                    <textarea rows="4" placeholder="Deskripsi Ukuran" v-model="form.description" :class="{ 'is-invalid': errors.description }" class="form-control"></textarea>
                  </div>
                  <div v-if="errors.description" class="alert alert-danger">
                    {{ errors.description }}
                  </div>

                  <div class="row">
                    <div class="col-12">
                      <button class="btn btn-primary shadow-sm rounded-sm">
                        <i class="fa fa-paper-plane" aria-hidden="true"></i>
                        Update
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
import LayoutApp from '../../../Layouts/App.vue';

import { Head, Link } from '@inertiajs/inertia-vue3';

import { reactive } from 'vue';

import { Inertia } from '@inertiajs/inertia';

import Swal from 'sweetalert2';

export default {
    layout: LayoutApp,

    components: {
        Head,
        Link
    },

    props: {
        errors: Object,
        type: Object,
    },

    setup(props) {
        // define form with reactive
        const form = reactive({
            name : props.type.name,
            description: props.type.description,
        });

        // method submit
        const submit = () => {
            Inertia.put(`/apps/types/${props.type.id}`, {
                // data
                name: form.name,
                description: form.description,
            }, {
                onSuccess: () => {
                    Swal.fire({
                        title: 'Success!',
                        text: 'Ukuran sukses terupdate.',
                        icon: 'success',
                        showConfirmButton: false,
                        timer: 2000
                    })
                }
            })
        }

        return {
            form,
            submit
        }
    }
}
</script>