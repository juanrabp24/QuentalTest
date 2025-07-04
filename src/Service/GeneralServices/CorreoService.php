<?php

namespace App\Service\GeneralServices;

use Symfony\Component\Mailer\MailerInterface;
use Symfony\Component\Mime\Email;

class CorreoService
{
    public function __construct(private MailerInterface $mailer) {}

    public function enviar(string $destinatario, string $asunto, string $contenido): void
    {
        $email = (new Email())
            ->from('quental@prueba.com')
            ->to($destinatario)
            ->subject($asunto)
            ->text($contenido);

        $this->mailer->send($email);
    }
}