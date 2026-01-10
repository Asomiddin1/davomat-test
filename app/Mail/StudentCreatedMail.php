<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class StudentCreatedMail extends Mailable
{
    use Queueable, SerializesModels;

    public $user;
    public $password;

    // Bizga user ma'lumotlari va ochiq parol kerak (xatda ko'rsatish uchun)
    public function __construct($user, $password)
    {
        $this->user = $user;
        $this->password = $password;
    }

    public function build()
    {
        return $this->subject('Tizimga kirish ma\'lumotlaringiz')
                    ->view('mails.student_created');
    }
}