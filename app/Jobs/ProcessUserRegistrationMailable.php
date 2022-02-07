<?php

namespace App\Jobs;

use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Log;
use Illuminate\Bus\Queueable;
use App\Mail\UserRegistered;

class ProcessUserRegistrationMailable implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    public $tries = 3;
    public $backoff = 60;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct(
        public string $signed_url,
        public string $recipient
    ){}

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        try {
            Mail::to($this->recipient)
                ->send(
                    new UserRegistered($this->signed_url)
                );
        } catch (\Throwable $e) {
            Log::error($e->getMessage());

            return redirect()->route('user.login.index');
        }
    }
}
