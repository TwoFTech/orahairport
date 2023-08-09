<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use App\Models\Stand;

class StandStoreMail extends Mailable
{
    use Queueable, SerializesModels;

    public $standStore;
    public $file;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct(Stand $standStore, $file)
    {
        $this->standStore = $standStore;
        $this->file = $file;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->from('orahairport2023@gmail.com', 'ORAHAIRPORT Travel')->subject('Votre demande de point de vente est en cours d\'étude.')
                                      ->markdown('emails.stands.store')
                                      ->attach($this->file);
    }
}
