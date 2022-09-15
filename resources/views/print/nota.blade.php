<html>
    <head>
        <title>
            Nota Pembelian
        </title>
        <style>
            html {
                font-family: "Verdana";
                
            }
            
            /* .content {
                width: 210mm;
                font-size: 10px;
                padding: 20px;
            } */
            
            .content {
                /* background-color: red; */
                width: 80mm;
                font-size: 12px;
                padding: 8px 20px 20px 4px;
            }

            .content .title {
                text-align: center;
            }

            .content .head-desc {
                margin-top: 10px;
                display: table;
                width: 100%;
            }

            .content .head-desc>div {
                display: table-cell;
            }

            .content .head-desc .user {
                text-align: right;
            }

            .content .nota {
                text-align: center;
                margin-top: 5px;
                margin-bottom: 5px;
            }
            
            .content .separate {
                margin-top: 10px;
                margin-bottom: 15px;
                border-top: 1px dashed #000;
            }

            .content .transaction-table {
                width: 100%;
                font-size: 12px;
            }

            .content .transaction-table .name {
                /* width: 185px; */
            }

            .content .transaction-table .qty {
                /* text-align: center */
                /* width: 65px; */
            }

            /* .content .transaction-table .sell-price {
                width:  65px;
                text-align: right;
            } */

            .content .transaction-table .sell-price {
                width:  50px;
                text-align: right;
            }

            .content .transaction-table .final-price {
                text-align: right;
            }

            .content .transaction-table tr td {
                vertical-align:  top;
            }

            .content .transaction-table .price-tr td {
                padding-top: 7px;
                padding-bottom: 7px;
            }

            .content .transaction-table .separate-line  {
                height: 1px;
                border-top: 1px dashed #000;
            }

            .content .thanks {
                margin-top: 20px;
                text-align: center;
            }

            .content .azost {
                margin-top: 5px;
                text-align: center;
                font-size: 10px;
                font-weight: bold
            }

            @media print {
                @page {
                    width: 80mm;
                    margin: 0mm;
                }
            }

        </style>

        <script>
            window.print();
            window.onafterprint = function() {
                setTimeout(() => {
                    window.close
                }, 1000);
            }
        </script>
    </head>

    <body>
        <div class="content">
            <div class="title" style="padding-bottom: 13px">
                <div style="text-align: center; font-weight:bold; text-transform: uppercase; font-size: 20px;">
                    BAROYA <br>
                    <small style="font-size: 10px;"><i>A Personal Style</i></small>
                </div>
                <div style="text-align: center;">
                    Alamat: Jl. Wesi Aji (Depan MANU LIMPUNG)
                    <br>Kec. Limpung Kab. Batang
                </div>
            </div>

            <div class="separate-line" style="border-top: 1px dashed #000; height: 1px; margin-bottom: 5px;"></div>
            <table class="transaction-table" cellspacing="0" cellpadding="0">
                <tr>
                    <td>TANGGAL</td>
                    <td>:</td>
                    <td>{{ $transaction->created_at }}</td>
                </tr>

                <tr>
                    <td>FAKTUR</td>
                    <td>:</td>
                    <td>{{ $transaction->invoice }}</td>
                </tr>

                <tr>
                    <td>KASIR</td>
                    <td>:</td>
                    <td>{{ $transaction->cashier->name ?? '' }}</td>
                </tr>

                <tr>
                    <td>PEMBELI</td>
                    <td>:</td>
                    <td>{{ $transaction->customer->name ?? 'Umum' }}</td>
                </tr>
            </table>

            <div class="transaction">
                <table class="transaction-table" cellspacing="0" cellpadding="0">
                    <tr class="price-tr">
                        <td colspan="3">
                            <div class="separate-line" style="border-top: 1px dashed #000"></div>
                        </td>
                        <td colspan="3">
                            <div class="separate-line" style="border-top: 1px dashed #000"></div>
                        </td>
                        <td colspan="3">
                            <div class="separate-line" style="border-top: 1px dashed #000"></div>
                        </td>
                    </tr>
                    <tr>
                        {{-- <td>BARCODE</td> --}}
                        <td style="text-align: center">QTY</td>
                        <td style="text-align: left; text-transform:uppercase;">PRODUK</td>
                        <td style="text-align: right" colspan="5">TOTAL</td>
                    </tr>
                    <tr class="price-tr">
                        <td colspan="3">
                            <div class="separate-line" style="border-top: 1px dashed #000"></div>
                        </td>
                        <td colspan="3">
                            <div class="separate-line" style="border-top: 1px dashed #000"></div>
                        </td>
                        <td colspan="3">
                            <div class="separate-line" style="border-top: 1px dashed #000"></div>
                        </td>
                    </tr>
                    @foreach ($transaction->details()->get() as $item)
                        <tr>
                            {{-- <td class="name">{{ $item->product->barcode }}</td> --}}
                            <td class="qty" style="text-align: center">{{ $item->qty }}</td>
                            <td class="name" style="text-transform: uppercase">{{ $item->product->title }}</td>
                            <td class="final-price" style="text-align: right" colspan="5">{{ number_format($item->price) }}</td>
                        </tr>
                    @endforeach
                    <tr class="price-tr">
                        <td colspan="3">
                            <div class="separate-line"></div>
                        </td>
                        <td colspan="3">
                            <div class="separate-line"></div>
                        </td>
                        <td colspan="3">
                            <div class="separate-line"></div>
                        </td>
                    </tr>
                    {{-- DISKON --}}
                    <tr>
                        <td colspan="3" class="final-price">
                            DISKON
                        </td>
                        <td colspan="3" class="final-price">
                            :
                        </td>
                        <td colspan="3" class="final-price">
                            {{ number_format($transaction->discount) }}
                        </td>
                    </tr>
                    {{-- SUBTOTAL --}}
                    <tr>
                        <td colspan="3" class="final-price">
                            SUB TOTAL
                        </td>
                        <td colspan="3" class="final-price">
                            :
                        </td>
                        <td colspan="3" class="final-price">
                            {{ number_format($transaction->grand_total) }}
                        </td>
                    </tr>
                    {{-- TUNAI --}}
                    <tr style="font-weight:bold">
                        <td colspan="3" class="final-price">
                            TUNAI
                        </td>
                        <td colspan="3" class="final-price">
                            :
                        </td>
                        <td colspan="3" class="final-price">
                            {{ number_format($transaction->cash) }}
                        </td>
                    </tr>

                    <tr class="price-tr">
                        <td colspan="3">
                            <div class="separate-line"></div>
                        </td>
                        <td colspan="3">
                            <div class="separate-line"></div>
                        </td>
                        <td colspan="3">
                            <div class="separate-line"></div>
                        </td>
                    </tr>
                    {{-- KEMBALI --}}
                    <tr style="font-weight:bold">
                        <td colspan="3" class="final-price">
                            KEMBALI
                        </td>
                        <td colspan="3" class="final-price">
                            :
                        </td>
                        <td colspan="3" class="final-price">
                            {{ number_format($transaction->change) }}
                        </td>
                    </tr>
                </table>
            </div>
            <div class="thanks">
                
                =============================
            </div>
            <div class="azost" style="margin-top: 5px; margin-bottom:10px">
                TERIMA KASIH
                <br>
                <p style="font-size: 10px; font-style: italic">BARANG YANG SUDAH DIBELI TIDAK BOLEH DITUKAR ATAU DIKEMBALIKAN</p>
            </div>
            
        </div>
    </body>
</html>