<?php


namespace App\Controller;

use Symfony\Component\Routing\Annotation\Route;
use App\Form\ContactType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use App\Service\Mailer\MailerServiceInterface;

class ContactController extends AbstractController
{
    /**
     * @Route("/contact", name="contact")
     * @param Request $request
     * @param MailerServiceInterface $mailerServiceInterface
     * @return Response
     */

    public function contact(
        Request $request,
        MailerServiceInterface $mailerServiceInterface
    ): Response
    {
        $form = $this->createForm(ContactType::class);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

            $contactFormData = $form->getData();

            if ($contactFormData['template']) {
                $mailerServiceInterface->send(
                    "praksa@mail.com",
                    $contactFormData['to'],
                    $contactFormData['subject'],
                    "email/email.html.twig", ["message" => $contactFormData['message']]
                );
            } else {
                $mailerServiceInterface->send(
                    "praksa@mail.com",
                    $contactFormData['to'],
                    $contactFormData['subject'],
                    "email/regular.html.twig",
                    ["message" => $contactFormData['message']]

                );

            }

            $this->addFlash('success', 'Email sent!');

            return $this->redirectToRoute('contact');
        }

        return $this->render('contact/contact.html.twig', [
            'our_form' => $form->createView(),
        ]);
    }
}

