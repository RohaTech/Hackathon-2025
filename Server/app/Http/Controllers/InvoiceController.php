<?php

namespace App\Http\Controllers;
use Barryvdh\DomPDF\Facade\Pdf;


class InvoiceController extends Controller
{

   public function showinvoice(){
    return view('invoice');
   }
   public function pdfinbrowser(){
    $pdf = Pdf::loadView('invoice');
    return $pdf->stream('browserinvoice.pdf');
   }
   public  function downloadpdf(){ 
    $pdf = Pdf::loadView('invoice');
    return $pdf->download('downloadinvoice.pdf');
   }
}
