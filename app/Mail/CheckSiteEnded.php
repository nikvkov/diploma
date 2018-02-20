<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class CheckSiteEnded extends Mailable
{
    use Queueable, SerializesModels;

    //ссылка на скачивание файла
    public $filename;
    public $uri;
    /**
     * Create a new message instance.
     * @return void
     */
    public function __construct($filename, $uri)
    {
        $this->filename = $filename;
        $this->uri = $uri;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->view('orders.checkFileOrder')->subject("Проверка сайта окончена");
    }

}//class
