<?php

namespace App\Mail;

use App\Models\Sale;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Mpdf\Mpdf;

class SaleNotificationMailable extends Mailable
{
    use Queueable, SerializesModels;

    public $sale;

    public function __construct(Sale $sale)
    {
        $this->sale = $sale;
    }

    public function build()
    {
        // Generar PDF con mPDF
        $mpdf = new Mpdf();
        $mpdf->WriteHTML(view('emails.invoice', ['sale' => $this->sale])->render());
        $pdfContent = $mpdf->Output('', 'S');

        return $this->subject('Compra Exitosa')
                    ->view('emails.sale_confirmation')
                    ->attachData($pdfContent, 'factura.pdf', [
                        'mime' => 'application/pdf',
                    ]);
    }
}