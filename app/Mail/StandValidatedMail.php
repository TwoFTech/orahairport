<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use App\Models\Stand;

class StandValidatedMail extends Mailable
{
    use Queueable, SerializesModels;

    public $stand;
    protected $file;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct(Stand $stand, $file)
    {
        $this->stand = $stand;
        $this->file = $file;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->from('orahairport2023@gmail.com', 'ORAHAIRPORT Travel')->subject('Votre demande de point de vente a été validée.')
                                      ->markdown('emails.stands.validated')
                                      ->attach($this->file);
    }
}
