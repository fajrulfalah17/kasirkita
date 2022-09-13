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
                                    <span class="input-group-text"><i class="fa fa-barcode"></i></span>
                                    <input type="text" class="form-control" placeholder="Scan Barcode">
                                </div>
                                <div class="mb-3">
                                    <label for="" class="form-label fw-bold">Nama Produk</label>
                                    <input type="text" class="form-control" placeholder="Nama Produk" readonly>
                                </div>
                                <div class="mb-3">
                                    <div class="form-label fw-bold">Qty</div>
                                    <input type="number" class="form-control text-center" placeholder="Qty" min="1">
                                </div>
                                <div class="text-end">
                                    <button class="btn btn-warning btn-md border-0 shadow text-uppercase mt-3 me-2">Reset</button>
                                    <button class="btn btn-success btn-md border-0 shadow text-uppercase mt-3">Add Item</button>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-8">
                        <div class="card border-0 rounded-2 shadow border-top-success">
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-md-4 col-4">
                                        <h4 class="fw-bold">GRAND TOTAL</h4>
                                    </div>
                                    <div class="col-md-8 col-8 text-end">
                                        <h4 class="fw-bold">Rp. 0</h4>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="card border-0 rounded-2 shadow">
                            <div class="card-body">
                                <div class="row mb-3">
                                    <div class="col-md-6">
                                        <label for="" class="fw-bold">Kasir</label>

                                    </div>
                                    <div class="col-md-6 float-end">
                                        <label for="" class="fw-bold">Customer</label>

                                    </div>
                                </div>
                                <hr>
                                <table class="table table-bordered">
                                    <thead>
                                        <tr style="background-color: #e6e6e7">
                                            <th scope="col">#</th>
                                            <th scope="col">Nama Produk</th>
                                            <th scope="col">Harga</th>
                                            <th scope="col">Qty</th>
                                            <th scope="col">Sub Total</th>
                                        </tr>
                                    </thead>
                                </table>
                                <hr>
                                <div class="d-flex align-items-end flex-column bd-hightligt mb-3">
                                    <div class="mt-auto bd-highlight">
                                        <label for="">Diskon (Rp.)</label>
                                        <input type="number" class="form-control" placeholder="Diskon (Rp.)">
                                    </div>
                                    <div class="bd-highlight mt-4">
                                        <label for="">Bayar (Rp.)</label>
                                        <input type="number" class="form-control" placeholder="Bayar (Rp.)">
                                    </div>
                                </div>
                                <div class="text-end mt-4">
                                    <button class="btn btn-warning btn-md border-0 shadow text-uppercase me-2">Cancel</button>
                                    <button class="btn btn-purple btn-md border-0 shadow text-uppercase">Bayar & Print</button>
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
import LayoutApp from '../../../Layouts/App.vue'

import { Head } from '@inertiajs/inertia-vue3';

export default({
    layout: LayoutApp,

    components: {
        Head
    },

    setup() {
        
    },
})
</script>
