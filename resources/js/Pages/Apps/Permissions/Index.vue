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
                            <span class="font-weight-bold"><i class="fa"></i> Permissions</span>
                        </div>
                        <div class="card-body">
                            <form @submit.prevent="handleSearch">
                                <div class="input-group mb-3">
                                    <input type="text" v-model="search" class="form-control" placeholder="Cari Permissions...">
                                    <button type="submit" class="btn btn-primary input-group-text"><i class="fa fa-search me-2"></i>Search</button>
                                </div>
                            </form>
                            <table class="table table-striped table-bordered table-hover">
                                <thead>
                                    <tr>
                                        <th scope="col">Permission Name</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr v-for="(permission, index) in permissions.data" :key="index">
                                        <td>{{ permission.name }}</td>
                                    </tr>
                                </tbody>
                            </table>
                            <Pagination :links="permissions.links" align="end" />
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
            permissions: Object
        },

        setup() {
            // define search
            const search = ref('' || (new URL(document.location)).searchParams.get('q'));

            // define search method
            const handleSearch = () => {
                Inertia.get('/apps/permissions', {
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