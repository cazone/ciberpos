<?php

namespace App\Http\Controllers;

use Inertia\Inertia;
use App\Models\Invoice;
use App\Models\Product;
use Twilio\Rest\Client;
use App\Models\Category;
use App\Models\TicketSetup;
use Codedge\Fpdf\Fpdf\Fpdf;
use Illuminate\Http\Request;
use App\Models\InvoiceDetail;

class PosController extends Controller
{

    protected $fpdf;

    public function __construct()
    {
        $this->fpdf = new Fpdf($orientation='P',$unit='mm', array(75,258));
    }

    public function tickets()
    {
        $ticket =  Invoice::with('user')
        ->whereDay('created_at', '=', date('d'))
        ->orderBy('id','desc')->limit(10)->get();
         return $this->sendResponse(   $ticket, 'Outlay successfully.');
    }
    public function index()
    {
        return Inertia::render('Pos/Index',[
            'categories' => Category::all(),
            'favorites' => Product::with('category')->where('favorite','>',0)->get()

        ]);
    }
    public function search(Request $request){
        $request->validate([
            'query' => 'required',
        ]);
        $products = Product::with('category')->where('code',$request->input('query'))
        ->orWhere('barcode',$request->input('query'))
        ->get();
        return response()->json($products);

    }
    public function ticket_print($id)
    {
        $invoice = Invoice::with('invoiceDetails', 'user', 'invoiceDetails.product')->find($id);
        // return $invoice;

        $ticket =  TicketSetup::first();

        $this->fpdf->SetMargins(2,10,2);
        $this->fpdf->AddPage();
        # Encabezado y datos de la empresa #
        $this->fpdf->Ln(20);

        $this->fpdf->SetTextColor(0,0,0);
        $this->fpdf->SetFont('Arial','B',12);
        $this->fpdf->MultiCell(0,5,utf8_decode(strtoupper($ticket->company_name)),0,'C',false);
        $this->fpdf->SetFont('Arial','',8);
        $this->fpdf->MultiCell(0,5,utf8_decode("RFC: " .$ticket->RFC),0,'C',false);
        $this->fpdf->MultiCell(0,5,utf8_decode($ticket->address),0,'C',false);
        $this->fpdf->MultiCell(0,5,utf8_decode("Teléfono: " . $ticket->phone),0,'C',false);
        $this->fpdf->MultiCell(0,5,utf8_decode("Email: " . $ticket->email),0,'C',false);
      $this->fpdf->Ln(1);
      $this->fpdf->Cell(0,5,utf8_decode("----------------------------------------------------------------------"),0,0,'C');
      $this->fpdf->Ln(5);

      $this->fpdf->MultiCell(0,5,utf8_decode("Fecha: ".date("d/m/Y h:s A")),0,'C',false);
    //   $this->fpdf->MultiCell(0,5,utf8_decode("Caja Nro: 1"),0,'C',false);
      $this->fpdf->MultiCell(0,5,utf8_decode("Atendio: " . $invoice->user->name),0,'C',false);
      $this->fpdf->SetFont('Arial','B',10);
      $this->fpdf->MultiCell(0,5,utf8_decode(strtoupper("Ticket: ". $invoice->id)),0,'C',false);
      $this->fpdf->SetFont('Arial','',10);

      $this->fpdf->Ln(1);
      $this->fpdf->Cell(0,5,utf8_decode("----------------------------------------------------------"),0,0,'C');
      $this->fpdf->Ln(5);
    # Tabla de productos #
    $this->fpdf->Cell(10,5,utf8_decode("Cant"),0,0,'C');
    $this->fpdf->Cell(19,5,utf8_decode("Precio"),0,0,'C');
    $this->fpdf->Cell(15,5,utf8_decode("Desc"),0,0,'C');
    $this->fpdf->Cell(28,5,utf8_decode("Total"),0,0,'C');

    $this->fpdf->Ln(3);
    $this->fpdf->Cell(0,5,utf8_decode("----------------------------------------------------------"),0,0,'C');
    $this->fpdf->Ln(3);
    $this->fpdf->SetFont('Arial','B',6);
   foreach ($invoice->invoiceDetails as $key => $detail) {
        $this->fpdf->MultiCell(0,4,utf8_decode(strtoupper($detail->product->name_product)),0,'L',false);
        $this->fpdf->Cell(10,4,utf8_decode($detail->amount),0,0,'C');
        $this->fpdf->Cell(19,4,utf8_decode("$".number_format($detail->price, 2, '.', ',')),0,0,'C');
        $this->fpdf->Cell(15,4,utf8_decode("$".number_format($detail->discount, 2, '.', ',')),0,0,'C');
        $this->fpdf->Cell(28,4,utf8_decode("$".number_format($detail->total, 2, '.', ',')),0,0,'C');
        $this->fpdf->Ln(4);
    }
    $this->fpdf->SetFont('Arial','B',8);
    /*----------  Detalles de la tabla  ----------*/
    // $this->fpdf->MultiCell(0,4,utf8_decode("Nombre de producto a vender"),0,'C',false);
    // $this->fpdf->Cell(10,4,utf8_decode("7"),0,0,'C');
    // $this->fpdf->Cell(19,4,utf8_decode("$100 "),0,0,'C');
    // $this->fpdf->Cell(19,4,utf8_decode("$000.00 "),0,0,'C');
    // $this->fpdf->Cell(28,4,utf8_decode("$7000.00 "),0,0,'C');
    // $this->fpdf->Ln(4);
    // $this->fpdf->MultiCell(0,4,utf8_decode("Garantía de fábrica: 2 Meses"),0,'C',false);
    // $this->fpdf->Ln(7);
    /*----------  Fin Detalles de la tabla  ----------*/



    // $this->fpdf->Cell(72,5,utf8_decode("-------------------------------------------------------------------"),0,0,'C');

    //     $this->fpdf->Ln(5);

    // # Impuestos & totales #
    // $this->fpdf->Cell(18,5,utf8_decode(""),0,0,'C');
    // $this->fpdf->Cell(22,5,utf8_decode("SUBTOTAL"),0,0,'C');
    // $this->fpdf->Cell(32,5,utf8_decode("+ $70.00 USD"),0,0,'C');

    // $this->fpdf->Ln(5);

    // $this->fpdf->Cell(18,5,utf8_decode(""),0,0,'C');
    // $this->fpdf->Cell(22,5,utf8_decode("IVA (13%)"),0,0,'C');
    // $this->fpdf->Cell(32,5,utf8_decode("+ $0.00 USD"),0,0,'C');

    $this->fpdf->Ln(5);

    $this->fpdf->Cell(0,5,utf8_decode("----------------------------------------------------------"),0,0,'C');

    $this->fpdf->Ln(5);

    $this->fpdf->Cell(18,5,utf8_decode(""),0,0,'C');
    $this->fpdf->Cell(22,5,utf8_decode("SUBTOTAL"),0,0,'R');
    $this->fpdf->Cell(23,5,utf8_decode("$" .number_format($invoice->subtotal, 2, '.', ',')),0,0,'R');

    $this->fpdf->Ln(5);

    $this->fpdf->Cell(18,5,utf8_decode(""),0,0,'C');
    $this->fpdf->Cell(22,5,utf8_decode("DESCUENTO"),0,0,'R');
    $this->fpdf->Cell(23,5,utf8_decode("$" .number_format($invoice->discount, 2, '.', ',')),0,0,'R');

    $this->fpdf->Ln(5);

    $this->fpdf->Cell(18,5,utf8_decode(""),0,0,'C');
    $this->fpdf->Cell(22,5,utf8_decode("TOTAL"),0,0,'R');
    $this->fpdf->Cell(23,5,utf8_decode("$". number_format($invoice->total, 2, '.', ',')),0,0,'R');

    $this->fpdf->Ln(5);

    $this->fpdf->Cell(18,5,utf8_decode(""),0,0,'C');
    // $this->fpdf->Cell(22,5,utf8_decode("USTED AHORRA"),0,0,'R');
    // $this->fpdf->Cell(23,5,utf8_decode("$7000.00"),0,0,'R');

    $this->fpdf->Ln(10);
    $this->fpdf->SetFont('Arial','B',7);
    $this->fpdf->MultiCell(0,5,utf8_decode($ticket->text_footer),0,'C',false);
    $this->fpdf->SetFont('Arial','B',10);
    $this->fpdf->Cell(0,7,utf8_decode($ticket->text_thanks),'',0,'C');

    $this->fpdf->Output("I","Ticket_".$id.".pdf",true);

        exit;
    }

    public function edit($id)
    {
        return Inertia::render('Pos/Edit',[
          'invoicedetails' => InvoiceDetail::with('product')->where('invoice_id', $id)->get(),

        ]);
    }
}
