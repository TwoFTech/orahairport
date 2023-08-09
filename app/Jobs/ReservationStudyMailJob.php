<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Mail;
use App\Mail\ReservationStudyMail;

class ReservationStudyMailJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    protected $file;
    protected $pdf;
    protected $details1;
    protected $details2;
    protected $reservation;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct($details1, $details2, $reservation, $pdf, $file)
    {
        $this->details1 = $details1;
        $this->details2 = $details2;
        $this->reservation = $reservation;
        $this->pdf = $pdf;
        $this->file = $file;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        Mail::to([['email' => $this->details1['email'], 'name' => $this->details1['name']], ['email' => $this->details2['email'], 'name' => $this->details2['name']]])->send(new ReservationStudyMail($this->reservation, $this->pdf, $this->file));
    }
}
