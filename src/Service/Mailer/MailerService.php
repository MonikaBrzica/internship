<?php

namespace App\Service\Mailer;


use Symfony\Component\Mailer\Exception\TransportException;
use Symfony\Component\Mailer\MailerInterface;
use Symfony\Component\Mime\Email;
use Twig\Environment;
use Symfony\Component\Mailer\Exception\TransportExceptionInterface;

final class MailerService implements MailerServiceInterface
{
    /**
     * @var MailerInterface
     */
    private $mailer;

    /**
     * @var Environment
     */
    private $twig;

    /**
     * MailerService constructor.
     *
     * @param MailerInterface       $mailer
     * @param Environment   $twig
     */
    public function __construct(MailerInterface $mailer, Environment $twig)
    {
        $this->mailer = $mailer;
        $this->twig = $twig;
    }

    /**
     * @param string $from
     * @param string $to
     * @param string $subject
     * @param string $template
     * @param array $message
     * @throws TransportExceptionInterface
     * @throws \Twig\Error\LoaderError
     * @throws \Twig\Error\RuntimeError
     * @throws \Twig\Error\SyntaxError
     */
    public function send(string $from, string $to, string $subject, string $template, array $message): void
    {
        try {
            $email = (new Email())
                ->from($from)
                ->to($to)
                ->subject($subject)
                ->html(
                    $this->twig->render($template, $message),
                    'text/html'
                );


            $this->mailer->send($email);
        } catch (TransportException $e) {
            print $e->getMessage()."\n";
            throw $e;
        }

    }
}