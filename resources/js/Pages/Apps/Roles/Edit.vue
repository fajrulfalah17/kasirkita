<template>
    <Head>
        <title>Tambah Role Baru - Kasir Kita</title>
    </Head>

    <main class="c-main">
        <div class="container-fluid">
            <div class="fade-in">
                <div class="row">
                    <div class="col-md-12">
                        <div class="card boirder-0 rounded-2 shadow border-top-purple">
                            <div class="card-header">
                                <span class="font-weight-bold"><i class="fa fa-shield-alt"></i> Edit Role</span>
                            </div>
                            <div class="card-body">
                                <form @submit.prevent="submit">
                                    <div class="mb-3">
                                        <label class="fw-bold">Role Name</label>
                                        <input class="form-control" v-model="form.name" :class="{ 'is-invalid': errors.name }" type="text" placeholder="Role Name">
                                        
                                        <div v-if="errors.name" class="alert alert-danger">
                                            {{ errors.name }}
                                        </div>
                                    </div>
                                    
                                    <hr>
                                    <div class="mb-3">
                                        <label class="fw-bold">Permission</label>
                                        <br>
                                        <div class="form-check form-check-inline" v-for="(permission, index) in permissions" :key="index">
                                            <input type="checkbox" class="form-check-input" v-model="form.permissions" :value="permission.name" placeholder="Nama Role" :id="`check-${permission.id}`">
                                            <label class="form-check-label" :for="`check-${permission.id}`">{{ permission.name }}</label>
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col-12">
                                            <button class="btn btn-primary shadow-sm rounded-sm"><i class="fa fa-paper-plane" aria-hidden="true"></i> Save</button>
                                            <button class="btn btn-warning shadow-sm rounded-sm ms-3"><i class="fa fa-ban" aria-hidden="true"></i> Reset</button>
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
        permissions: Array,
        role: Object
    },

    setup(props) {
        // define form with reactive
        const form = reactive({
            name : props.role.name,
            permissions : props.role.permissions.map(obj => obj.name)
        });

        // method submit
        const submit = () => {
            Inertia.put(`/apps/roles/${props.role.id}`, {
                // data
                name: form.name,
                permissions: form.permissions,
            }, {
                onSuccess: () => {
                    Swal.fire({
                        title: 'Success!',
                        text: 'Role sukses terupdate.',
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