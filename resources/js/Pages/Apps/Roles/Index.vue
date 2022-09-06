<template>

    <Head>
        <title>Dashboard - Aplikasi Kasir</title>
    </Head>

    <main class="c-main">
        <div class="container-fluid">
            <div class="fade-in">

                <div class="row">
                    <div class="col-md-12">
                        <div class="card border-0 rounded-2 shadow border-top-purple">
                        <div class="card-header">
                            <span class="font-weight-bold"><i class="fa fa-shield-alt"></i> Roles</span>
                        </div>
                        <div class="card-body">
                            <form @submit.prevent="handleSearch">
                                <div class="input-group mb-3">
                                    <Link href="/apps/roles/create" v-if="hasAnyPermission(['roles.create'])" class="btn btn-primary input-group-text">
                                        <i class="fa fa-plus-circle me-2"></i> New
                                    </Link>

                                    <input v-model="search" type="text" class="form-control" placeholder="Cari Nama Role...">

                                    <button class="btn btn-primary input-group-text" type="submit"><i class="fa fa-search me-2"></i> Search</button>
                                </div>
                            </form>
                            <table class="table table-striped table-bordered table-hover">
                                <thead>
                                    <tr>
                                        <th scope="col">Nama Role</th>
                                        <th scope="col" style="width: 50%">Permission</th>
                                        <th scope="col" style="width: 20%">Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr v-for="(role, index) in roles.data" :key="index">
                                        <td>{{ role.name }}</td>
                                        <td>
                                            <span v-for="(permission, index) in role.permissions" :key="index" class="badge badge-primary shadow border-0 ms-2 mb-2 p-2">{{ permission.name }}
                                            </span>
                                        </td>
                                        <td class="text-center">
                                            <Link :href="`/apps/roles/${role.id}/edit`" v-if="hasAnyPermission(['roles.edit'])" class="btn btn-success btn-sm me-2"><i class="fa fa-pencil-alt me-1"></i> Edit</Link>
                                            <button v-if="hasAnyPermission(['roles.delte'])" class="btn btn-danger btn-sm"><i class="fa fa-trash"></i> Delete</button>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                            <Pagination :links="roles.links" align="end" />
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
    import LayoutApp from '../../../Layouts/App.vue';

    //import Heade and useForm from Inertia
    import { Head, Link } from '@inertiajs/inertia-vue3';

    import Pagination from '../../../Components/Pagination.vue';
    import { ref } from '@vue/reactivity';
    import { Inertia } from '@inertiajs/inertia';

    export default {

        //layout
        layout: LayoutApp,

        //register component
        components: {
            Head,
            Pagination,
            Link
        },

        props: {
            roles: Object
        },

        setup() {
            // define search
            const search = ref('' || (new URL(document.location)).searchParams.get('q'));

            // define search method
            const handleSearch = () => {
                Inertia.get('/apps/roles', {
                    // send params "q" with value from state search
                    q: search.value
                })
            }

            return {
                search,
                handleSearch
            }
        }

    }
</script>

<style>

</style>