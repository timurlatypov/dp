<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class Callback extends Mailable
{
    use Queueable;
    use SerializesModels;

    public function __construct($request)
    {
        $this->request = $request;
    }

    public function build(): self
    {
        return $this->view('emails.callback')->subject('Обратный звонок');
    }
}
