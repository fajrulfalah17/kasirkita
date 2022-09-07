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
                  ><i class="fa fa-users"></i> Edit User</span
                >
              </div>
              <div class="card-body">
                <form @submit.prevent="submit">
                  <div class="row">
                    <div class="col-md-6">
                      <div class="mb-3">
                        <label class="fw-bold">Nama User</label>
                        <input
                          class="form-control"
                          v-model="form.name"
                          :class="{ 'is-invalid': errors.name }"
                          type="text"
                          placeholder="User Name"
                        />

                    </div>
                    <div v-if="errors.name" class="alert alert-danger">
                      {{ errors.name }}
                    </div>
                    </div>
                    <div class="col-md-6">
                      <div class="mb-3">
                        <label class="fw-bold">Email</label>
                        <input
                          class="form-control"
                          v-model="form.email"
                          :class="{ 'is-invalid': errors.email }"
                          type="email"
                          placeholder="Email"
                        />

                    </div>
                    <div v-if="errors.email" class="alert alert-danger">
                      {{ errors.email }}
                    </div>
                    </div>
                  </div>
                  <div class="row">
                    <div class="col-md-6">
                      <div class="mb-3">
                        <label class="fw-bold">Password</label>
                        <input
                          class="form-control"
                          v-model="form.password"
                          :class="{ 'is-invalid': errors.password }"
                          type="password"
                          placeholder="Password"
                        />

                    </div>
                    <div v-if="errors.password" class="alert alert-danger">
                      {{ errors.password }}
                    </div>
                    </div>
                    <div class="col-md-6">
                      <div class="mb-3">
                        <label class="fw-bold">Password Konfirmasi</label>
                        <input
                          class="form-control"
                          v-model="form.password_confirmation"
                          :class="{ 'is-invalid': errors.password }"
                          type="password"
                          placeholder="Password Konfirmasi"
                        />
                      </div>
                    </div>
                  </div>
                  <div class="row">
                    <div class="col-md-12">
                        <div class="mb-3">
                            <label for="" class="fw-bold">Roles</label>
                            <br>
                            <div class="form-check form-check-inline" v-for="(role, index) in roles" :key="index">
                                <input type="checkbox" v-model="form.roles" :value="role.name" :id="`check-$(role.id)`" class="form-check-input">
                            <label class="form-check-label" :for="`check-$(role.id)`">{{ role.name }}</label>
                            </div>
                        </div>
                        <div v-if="errors.roles" class="alert alert-danger">
                          {{ errors.roles }}
                        </div>
                    </div>
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
        user: Object,
        roles: Array
    },

    setup(props) {
        // define form with reactive
        const form = reactive({
            name : props.user.name,
            email: props.user.email,
            password: '',
            password_confirmation: '',
            roles : props.user.roles.map(obj => obj.name)
        });

        // method submit
        const submit = () => {
            Inertia.put(`/apps/users/${props.user.id}`, {
                // data
                name: form.name,
                email: form.email,
                password: form.password,
                password_confirmation: form.password_confirmation,
                roles: form.roles,
            }, {
                onSuccess: () => {
                    Swal.fire({
                        title: 'Success!',
                        text: 'User sukses terupdate.',
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