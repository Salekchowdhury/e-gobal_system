<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;
// use App\Models\Purchase;
use App\Models\{
    User,
    Purchase,
    Settings,
    Withdraw,

};
use Auth;
class PdfController extends Controller
{
    public function generate_pdf(int $id)
    {
        $setting = Settings::find(1);
        // dd($setting->address);
        $purchase = Purchase::find($id);
        $auth_name = Auth::user()->name;
        $userData = User::find($purchase->user_id);

        $datas = Purchase::where('id',$id)->with('purchaseDetails')->get();
        // dd($datas);

        $pdf = Pdf::loadView('Admin.pdf.pdf_view_invoice',compact('datas','userData','auth_name','setting'));
        return $pdf->stream('invoice.pdf');
    }
    public function withdrawPdfGenerate(int $id)
    {
        $setting = Settings::find(1);
        // dd($setting->address);
        $withdraw = Withdraw::where('id',$id)->with(['admin','user'])->get();
        // dd($withdraw);


        $pdf = Pdf::loadView('Admin.pdf.withdraw_pdf',compact('withdraw','setting'));
        return $pdf->download('withdraw.pdf');
    }

     public function download_pdf(int $id)
    {
        $setting = Settings::find(1);
        // dd($setting->address);
        $purchase = Purchase::find($id);
        $auth_name = Auth::user()->name;
        $userData = User::find($purchase->user_id);

        $datas = Purchase::where('id',$id)->with('purchaseDetails')->get();
        // dd($datas);

        $pdf = Pdf::loadView('Admin.pdf.pdf_view_invoice',compact('datas','userData','auth_name','setting'));
        return $pdf->download('invoice.pdf');
        // download('invoice.pdf')
    }

    public function viewReport(int $id)
    {
        $setting = Settings::find(1);
        $purchase = Purchase::find($id);
        $auth_name = Auth::user()->name;
        $userData = User::find($purchase->user_id);

        $datas = Purchase::where('id',$id)->with('purchaseDetails')->get();

        // dd($datas);

        return view('Admin.pdf.view_invoice',compact('datas','userData','auth_name','setting'));
        // return $pdf->stream('invoice.pdf');
    }
}