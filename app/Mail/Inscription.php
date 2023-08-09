<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use App\Models\User;

class Inscription extends Mailable
{
    use Queueable, SerializesModels;

    public $user;
    protected $file;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct(User $user, $file)
    {
        $this->user = $user;
        $this->file = $file;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->from('orahairport2023@gmail.com', 'ORAHAIRPORT Travel')->subject('Votre inscription a été bien enregistré.')
                                      ->markdown('emails.inscriptions.register')
                                      ->attach($this->file);
    }
}
