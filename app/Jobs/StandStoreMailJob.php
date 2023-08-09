<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use App\Mail\StandStoreMail;
use Illuminate\Support\Facades\Mail;
use App\Models\Stand;

class StandStoreMailJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    public $standStore;
    public $file;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct($standStore, $file)
    {
        $this->standStore = $standStore;
        $this->file = $file;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        Mail::to(Auth::user()->email)->send(new StandStoreMail($this->standStore, $this->file));
    }
}
