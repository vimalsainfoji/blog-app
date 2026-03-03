<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Log;

class SendRealEmail implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    public $userEmail;
    public $userName;

    /**
     * Create a new job instance.
     */
    public function __construct($userEmail = null, $userName = null)
    {
        // If no data passed → Static Email
        $this->userEmail = $userEmail ?? 'yourgmail@gmail.com';
        $this->userName  = $userName ?? 'Static User';
    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        Mail::raw(
            "Hello {$this->userName}, Welcome to our Laravel App!",
            function ($message) {
                $message->to($this->userEmail)
                        ->subject('Welcome Email from Laravel Queue');
            }
        );

        Log::info("Email sent to: " . $this->userEmail);
    }
}