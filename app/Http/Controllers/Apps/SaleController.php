<?php

namespace App\Http\Controllers\Apps;

use App\Exports\SalesExport;
use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\Profit;
use App\Models\Transaction;
use App\Models\TransactionDetail;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Inertia\Inertia;
use Maatwebsite\Excel\Facades\Excel;

class SaleController extends Controller
{
    public function index()
    {
        return Inertia::render('Apps/Sales/Index');
    }

    public function filter(Request $request)
    {
        $this->validate($request, [
            'start_date'    => 'required',
            'end_date'      => 'required'
        ]);

        $sales = Transaction::with('cashier', 'customer', 'details.product')
                    ->whereDate('created_at', '>=', $request->start_date)
                    ->whereDate('created_at', '<=', $request->end_date)
                    ->get();

        $total = Transaction::whereDate('created_at', '>=', $request->start_date)
                ->whereDate('created_at', '<=', $request->end_date)
                ->sum('grand_total');
        return Inertia::render('Apps/Sales/Index', [
            'sales'     => $sales,
            'total'     => (int)$total,
        ]);
    }

    public function export(Request $request)
    {
        return Excel::download(new SalesExport($request->start_date, $request->end_date), 'sales : '.$request->start_date.'-'.$request->end_date.'.xlsx');
    }

    public function destroy($id)
    {

        // get transaction id
        $data = Transaction::findOrFail($id);
        
        // get Transaction Detail Id
        $transactionDetail = TransactionDetail::where('transaction_id', $id)->get();

        // looping get Detail Id
        foreach ($transactionDetail as $item) {
            // get produk
            Product::find($item->product_id)->increment('stock', $item->qty);
            
            // $delete transaction detail
            $item->delete();
        }

        // hapus data profit
        Profit::where('transaction_id', $id)->delete();
        
        $data->delete();

        // redirect ke halaman sebelumnya
        return Redirect::back();
    }

    public function pdf(Request $request)
    {
        $sales = Transaction::with('cashier', 'customer', 'details.product')->whereDate('created_at', '>=', $request->start_date)->whereDate('created_at', '<=', $request->end_date)->get();

        $total = Transaction::whereDate('created_at', '>=', $request->start_date)->whereDate('created_at', '<=', $request->end_date)->sum('grand_total');

        $pdf = Pdf::loadView('exports.sales', compact('sales', 'total'));

        return $pdf->download('sales : '. $request->start_date.' - '.$request->end_date.'.pdf');
    }
}
