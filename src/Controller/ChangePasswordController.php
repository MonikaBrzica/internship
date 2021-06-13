<?php


namespace App\Controller;

use App\Form\ChangePassword;
use App\Service\ResponseService;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Config\Definition\Exception\Exception;
use Symfony\Component\Filesystem\Filesystem;
use Symfony\Component\Form\FormInterface;
use Symfony\Component\HttpFoundation\BinaryFileResponse;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\ResponseHeaderBag;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Form\FormError;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;
use App\Entity\User;

class ChangePasswordController extends AbstractController
{

    /**
     * @Route("/change", name="change")
     */
    public function ChangePassword(Request $request, UserPasswordEncoderInterface $passwordEncoder)
    {
        $em = $this->getDoctrine()->getManager();
        $user = $this->getUser();
        $form = $this->createForm(ChangePassword::class, $user);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $password = $form->get('password')->getData();
            if ($passwordEncoder->isPasswordValid($user, $password))
            {
                $encodedPassword = $passwordEncoder->encodePassword(
                    $user,
                    $form->get('plainPassword')->getData()
                );
                $user->setPassword($encodedPassword);
                $em->persist($user);
                $em->flush();

                return $this->redirectToRoute('homepage');

            } else {
                $form->addError(new FormError('Incorrect password'));
            }
        }
        return $this->render('change.html.twig', array(
            'form' => $form->createView(),
        ));
    }
}
