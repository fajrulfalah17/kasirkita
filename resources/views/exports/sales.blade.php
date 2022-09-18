<div class="title">
    <div style="text-align: center;text-transform:uppercase: font-size:15px">
        Arunika Production
    </div>
    <div style="text-align: center">
        Alamat: Batang
    </div>
    <div style="text-align: center">
        Telp: 0892779282978
    </div>
</div>

<table style="width: 100%">
    <thead>
        <tr style="background-color: #e6e6e7;">
            <th scope="col">Tanggal</th>
            <th scope="col">Invoice</th>
            <th scope="col">Produk</th>
            <th scope="col">Harga</th>
            <th scope="col">Qty</th>
            <th scope="col">Kasir</th>
            <th scope="col">Customer</th>
            <th scope="col">Total</th>
        </tr>
    </thead>
    <tbody>
        @foreach($sales as $sale)
            <tr>
                <td>{{ $sale->created_at }}</td>
                <td>{{ $sale->invoice }}</td>
                <td>
                    @foreach ($sale->details as $data)
                        {{ $data->product->title }}
                    @endforeach    
                </td>
                <td>
                    @foreach ($sale->details as $data)
                    Rp. {{ number_format($data->price) }}
                    @endforeach 
                </td>
                <td>
                    @foreach ($sale->details as $data)
                        {{ $data->qty }}
                    @endforeach 
                </td>
                
                <td>{{ $sale->cashier->name ?? '' }}</td>
                <td>{{ $sale->customer->name ?? 'Umum' }}</td>
                <td class="text-end">Rp. {{ number_format($sale->grand_total) }}</td>
            </tr>
        @endforeach
        <tr>
            <td colspan="7" class="text-end fw-bold" style="background-color: #e6e6e7">TOTAL</td>
            <td class="text-end fw-bold" style="background-color: #e6e6e7">Rp. {{ number_format($total) }}</td>
            
        </tr>
    </tbody>
</table>