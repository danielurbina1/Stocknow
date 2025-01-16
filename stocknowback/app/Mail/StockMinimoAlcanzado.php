<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class StockMinimoAlcanzado extends Mailable
{
    use Queueable, SerializesModels;

    public $producto;
    public $jefe;

    /**
     * Create a new message instance.
     */
    public function __construct($producto, $jefe)
    {
        $this->producto = $producto;
        $this->jefe = $jefe;
    }

    /**
     * Build the message.
     */
    public function build()
    {
        return $this->subject('Producto alcanzó el stock mínimo')
                    ->view('emails.stock_minimo')
                    ->with([
                        'producto' => $this->producto,
                        'jefe' => $this->jefe,
                    ]);
    }
}
