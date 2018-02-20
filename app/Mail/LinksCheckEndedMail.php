<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class LinksCheckEndedMail extends Mailable
{
    use Queueable, SerializesModels;

    //ссылка на скачивание файла
    public $filename;
    /**
     * Create a new message instance.
     * @return void
     */
    public function __construct($filename)
    {
        $this->filename = $filename;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->view('orders.checkLinksOrder')->subject("Проверка ссылок завершена");
    }

}//class
