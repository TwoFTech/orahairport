<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Mail;
use App\Mail\ReservationStoreMail;

class ReservationStoreMailJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    protected $file;
    protected $details;
    protected $reservation;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct($details, $reservation, $file)
    {
        $this->details = $details;
        $this->reservation = $reservation;
        $this->file = $file;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        Mail::to([['email' => $this->details['email'], 'name' => $this->details['name']]])->send(new ReservationStoreMail($this->file));
    }
}
