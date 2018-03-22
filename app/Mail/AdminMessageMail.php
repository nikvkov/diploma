<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class AdminMessageMail extends Mailable
{
    use Queueable, SerializesModels;

    //тема сообщения
    public $title;

    //текст сообщения
    public $content;
    /**
     * Create a new message instance.
     * @return void
     */
    public function __construct($title, $content)
    {
        $this->title = $title;
        $this->content = $content;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->view('orders.adminMessage')->subject($this->title);
    }
}
