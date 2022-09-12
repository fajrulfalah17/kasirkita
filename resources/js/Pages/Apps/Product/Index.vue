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
                            <span class="font-weight-bold"><i class="fa fa-shopping-bag"></i> Produk</span>
                        </div>
                        <div class="card-body">
                            <form @submit.prevent="handleSearch">
                                <div class="input-group mb-3">
                                    <Link href="/apps/products/create" v-if="hasAnyPermission(['products.create'])" class="btn btn-primary input-group-text">
                                        <i class="fa fa-plus-circle me-2"></i> New
                                    </Link>

                                    <input v-model="search" type="text" class="form-control" placeholder="Cari Nama Ukuran...">

                                    <button class="btn btn-primary input-group-text" type="submit"><i class="fa fa-search me-2"></i> Search</button>
                                </div>
                            </form>
                            <table class="table table-bordered table-hover">
                                <thead>
                                    <tr>
                                        <th scope="col" class="text-center">Barcode</th>
                                        <th scope="col">Nama Produk</th>
                                        <th scope="col">Harga Beli</th>
                                        <th scope="col">Harga Jual</th>
                                        <th scope="col">Stok</th>
                                        <th scope="col" style="width: 20%">Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr v-for="(product, index) in products.data" :key="index">
                                        <td class="text-center"><Barcode
                                                    :value="product.barcode"
                                                    :format="'CODE39'"
                                                    :lineColor="'#000'"
                                                    :width="1"
                                                    :height="20"
                                                /></td>
                                        <td style="text-transform:uppercase;">{{ product.title }}</td>
                                        <td>Rp. {{ formatPrice(product.buy_price) }}</td>
                                        <td>Rp. {{ formatPrice(product.sell_price) }}</td>
                                        <td>{{ product.stock }}</td>
                                        <td class="text-center">
                                            <Link :href="`/apps/products/${product.id}/edit`" v-if="hasAnyPermission(['products.edit'])" class="btn btn-success btn-sm me-2"><i class="fa fa-pencil-alt me-1"></i> Edit</Link>
                                            <button @click.prevent="destroy(product.id)" v-if="hasAnyPermission(['products.delete'])" class="btn btn-danger btn-sm"><i class="fa fa-trash"></i> Delete</button>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                            <Pagination :links="products.links" align="end" />
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
    import Swal from 'sweetalert2';
    import Barcode from '../../../Components/Barcode.vue';

    export default {

        //layout
        layout: LayoutApp,

        //register component
        components: {
            Head,
            Pagination,
            Link,
            Barcode
        },

        props: {
            products: Object
        },

        setup() {
            // define search
            const search = ref('' || (new URL(document.location)).searchParams.get('q'));

            // define search method
            const handleSearch = () => {
                Inertia.get('/apps/products', {
                    // send params "q" with value from state search
                    q: search.value
                })
            }

            const destroy = (id) => {
                Swal.fire({
                        title: 'Apakah anda yakin?',
                        text: 'Kamu tidak bisa mengembalikan ini!.',
                        icon: 'warning',
                        showCancelButton: true,
                        confirmButtonColor : '#4da9ff',
                        cancelButtonColor: '#d33',
                        confirmButtonText: 'Ya, Hapus!'
                    })
                .then((result) => {
                    if(result.isConfirmed) {
                        Inertia.delete(`/apps/products/${id}`)

                        Swal.fire({
                        title: 'Dihapus!',
                        text: 'User sukses dihapus.',
                        icon: 'success',
                        showConfirmButton: false,
                        timer: 2000
                    })
                    }
                })
            }

            return {
                search,
                handleSearch,
                destroy
            }
        }

    }
</script>

<style>

</style>