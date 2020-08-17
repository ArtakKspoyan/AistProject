<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use App\Mail\SendEmail;
use Mail;
use App\User;
use App\Message;

class SendEmailJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    protected $details;
    public $message;
    /**
     * Create a new job instance.
     *
     * @return void
     */
     public function __construct($details, $message)
     {
         $this->details = $details;
         $this->message = $message;
     }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
      $email = new SendEmail($this->message);
      Mail::to($this->details['email'])->send($email);
    }
}
