<?php

namespace App\Http\Controllers;

use Inertia\Inertia;
use App\Models\Product;
use App\Models\Category;
use Illuminate\Http\Request;
use Codedge\Fpdf\Fpdf\Fpdf;

class PosController extends Controller
{

    protected $fpdf;

    public function __construct()
    {
        $this->fpdf = new Fpdf($orientation='P',$unit='mm', array(75,258));
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
    public function test()
    {
        $this->fpdf->SetMargins(4,10,4);
        $this->fpdf->AddPage();
 # Encabezado y datos de la empresa #
 $this->fpdf->Ln(20);
 $this->fpdf->SetFont('Arial','B',10);
    $this->fpdf->SetTextColor(0,0,0);
    $this->fpdf->MultiCell(0,5,utf8_decode(strtoupper("Nombre de empresa")),0,'C',false);
    $this->fpdf->SetFont('Arial','',9);
    $this->fpdf->MultiCell(0,5,utf8_decode("RFC: 0000000000"),0,'C',false);
    $this->fpdf->MultiCell(0,5,utf8_decode("Direccion San Salvador, El Salvador"),0,'C',false);
    $this->fpdf->MultiCell(0,5,utf8_decode("Teléfono: 00000000"),0,'C',false);
    $this->fpdf->MultiCell(0,5,utf8_decode("Email: correo@ejemplo.com"),0,'C',false);
      $this->fpdf->Ln(1);
      $this->fpdf->Cell(0,5,utf8_decode("------------------------------------------------------"),0,0,'C');
      $this->fpdf->Ln(5);

      $this->fpdf->MultiCell(0,5,utf8_decode("Fecha: ".date("d/m/Y", strtotime("13-09-2022"))." ".date("h:s A")),0,'C',false);
    //   $this->fpdf->MultiCell(0,5,utf8_decode("Caja Nro: 1"),0,'C',false);
      $this->fpdf->MultiCell(0,5,utf8_decode("Cajero: Carlos Alfaro"),0,'C',false);
      $this->fpdf->SetFont('Arial','B',10);
      $this->fpdf->MultiCell(0,5,utf8_decode(strtoupper("Ticket: 10021")),0,'C',false);
      $this->fpdf->SetFont('Arial','',10);

      $this->fpdf->Ln(1);
      $this->fpdf->Cell(0,5,utf8_decode("------------------------------------------------------"),0,0,'C');
      $this->fpdf->Ln(5);
    # Tabla de productos #
    $this->fpdf->Cell(10,4,utf8_decode("#"),0,0,'C');
    $this->fpdf->Cell(19,5,utf8_decode("Precio"),0,0,'C');
    $this->fpdf->Cell(15,5,utf8_decode("Desc."),0,0,'C');
    $this->fpdf->Cell(28,5,utf8_decode("Total"),0,0,'C');

    $this->fpdf->Ln(3);
    $this->fpdf->Cell(72,5,utf8_decode("-------------------------------------------------------------------"),0,0,'C');
    $this->fpdf->Ln(3);



    /*----------  Detalles de la tabla  ----------*/
    $this->fpdf->MultiCell(0,4,utf8_decode("Nombre de producto a vender"),0,'C',false);
    $this->fpdf->Cell(10,4,utf8_decode("7"),0,0,'C');
    $this->fpdf->Cell(19,4,utf8_decode("$100 "),0,0,'C');
    $this->fpdf->Cell(19,4,utf8_decode("$000.00 "),0,0,'C');
    $this->fpdf->Cell(28,4,utf8_decode("$7000.00 "),0,0,'C');
    $this->fpdf->Ln(4);
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

    $this->fpdf->Cell(72,5,utf8_decode("-------------------------------------------------------------------"),0,0,'C');

    $this->fpdf->Ln(5);

    $this->fpdf->Cell(18,5,utf8_decode(""),0,0,'C');
    $this->fpdf->Cell(22,5,utf8_decode("SUBTOTAL"),0,0,'R');
    $this->fpdf->Cell(23,5,utf8_decode("$7000.00"),0,0,'R');

    $this->fpdf->Ln(5);

    $this->fpdf->Cell(18,5,utf8_decode(""),0,0,'C');
    $this->fpdf->Cell(22,5,utf8_decode("DESCUENTO"),0,0,'R');
    $this->fpdf->Cell(23,5,utf8_decode("$7000.00"),0,0,'R');

    $this->fpdf->Ln(5);

    $this->fpdf->Cell(18,5,utf8_decode(""),0,0,'C');
    $this->fpdf->Cell(22,5,utf8_decode("TOTAL"),0,0,'R');
    $this->fpdf->Cell(23,5,utf8_decode("$7000.00"),0,0,'R');

    $this->fpdf->Ln(5);

    $this->fpdf->Cell(18,5,utf8_decode(""),0,0,'C');
    $this->fpdf->Cell(22,5,utf8_decode("USTED AHORRA"),0,0,'R');
    $this->fpdf->Cell(23,5,utf8_decode("$7000.00"),0,0,'R');

    $this->fpdf->Ln(10);

    $this->fpdf->MultiCell(0,5,utf8_decode("*** Precios de productos incluyen impuestos. Para poder realizar un reclamo o devolución debe de presentar este ticket ***"),0,'C',false);
    $this->fpdf->SetFont('Arial','B',9);
    $this->fpdf->Cell(0,7,utf8_decode("Gracias por su compra"),'',0,'C');

    $this->fpdf->Output("I","Ticket_Nro_1.pdf",true);

        exit;
    }
}
