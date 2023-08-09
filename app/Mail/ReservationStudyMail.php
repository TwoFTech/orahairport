<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use App\Models\Reservation;

class ReservationStudyMail extends Mailable
{
    use Queueable, SerializesModels;

    public $reservation;
    protected $pdf;
    protected $file;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct(Reservation $reservation, $pdf, $file)
    {
        $this->reservation = $reservation;
        $this->pdf = base64_encode($pdf->output());
        $this->file = $file;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->from('orahairport2023@gmail.com', 'ORAHAIRPORT Travel')->subject('Obtenez le numero PNR et le montant de votre réservation (bon de commande inclus).')
                                      ->markdown('emails.reservations.study')
                                      ->attachData(base64_decode($this->pdf), 'bon_de_commande.pdf', [
                                            'mime' => 'application/pdf'
                                      ]);
    }
}
