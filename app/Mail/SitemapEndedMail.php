<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class SitemapEndedMail extends Mailable
{
    use Queueable, SerializesModels;

    //ссылка на скачивание файла
    public $type;
    public $filename;
    /**
     * Create a new message instance.
     * @return void
     */
    public function __construct($filename, $type)
    {
        $this->type = $type;
        $this->filename = $filename;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->view('orders.sitemapOrder')->subject("Карта сайта готова");
    }

}//class
