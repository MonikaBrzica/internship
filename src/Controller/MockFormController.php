<?php
namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Response;

class MockFormController extends AbstractController
{
    /**
     * @Route("/form", name="mock-form")
     */
    public function form(): Response
    {
        return $this->render('form/mock-form.html.twig');

    }
}
