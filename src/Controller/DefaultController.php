<?php

/*
 * This file is part of the AdminLTE-Bundle demo.
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace App\Controller;

use App\Entity\JobApplications;
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

/**
 * Default controller
 */
class DefaultController extends AbstractController
{
    /**
     * @Route("/home", defaults={}, name="homepage")
     */
    public function index(ResponseService $responseService)
    {
        $cvs = $this->getDoctrine()
            ->getRepository(JobApplications::class)->findAll();

        if (!$cvs) {
            $responseService->responseCode(Response::HTTP_NOT_FOUND, 'File Not Found');
        }

        return $this->render('default/index.html.twig', array('cvs' => $cvs));
    }

    /**
     * @Route("/home/delete/{id}", methods={"DELETE"})
     *
     */
    public function delete(Request $request, $id) {
        $cv = $this->getDoctrine()->getRepository(JobApplications::class)->find($id);
        $filename = $cv->getfilename();
        $entityManager = $this->getDoctrine()->getManager();
        $entityManager->remove($cv);
        $entityManager->flush();
        $response = new Response();
        $response->send();
        $filesystem = new Filesystem();
        $filesystem->remove($this->projectDir . "/public/CVs/" . $filename);

    }

    private $projectDir;
    public function __construct(string $projectDir)
    {
        $this->projectDir = $projectDir;
    }
    /**
     * @Route("/home/download/{id}",name="download" )
     */
    public function download($id, ResponseService $responseService) {
        try {
            $cv = $this->getDoctrine ()->getRepository (JobApplications::class)->find($id);
            if (!$cv) {
                $responseService->responseCode(Response::HTTP_NOT_FOUND, 'CV Not Found');
            }
            $fileName = $cv->getfilename();
            $fileWithPath = $this->projectDir . "/public/CVs/" . $fileName;

            $response = new BinaryFileResponse($fileWithPath);
            $response->headers->set ('Content-Type', 'application/pdf');
            $response->setContentDisposition (ResponseHeaderBag::DISPOSITION_ATTACHMENT, $fileName);
            return $response;
        } catch ( Exception $e ) {
            $responseService->responseCode(Response::HTTP_BAD_REQUEST, 'Download error');
        }
    }

    /**
     * @Route("/home/archive/{id}", methods={"POST"})
     */
    public function archive($id, ResponseService $responseService) {
        $entityManager = $this->getDoctrine()->getManager();
        $active = $entityManager->getRepository(JobApplications::class)->find($id);

        if (!$active) {
            $responseService->responseCode(Response::HTTP_NOT_FOUND, 'Application Not Found');
        }

        $active->setarchived(1);
        $entityManager->flush();

        return $responseService->responseCode(Response::HTTP_OK, 'Archived Successful');
    }

    /**
     * @Route("/home/active/{id}", methods={"POST"})
     */
    public function active($id, ResponseService $responseService) {
        $entityManager = $this->getDoctrine()->getManager();
        $arhived = $entityManager->getRepository(JobApplications::class)->find($id);

        if (!$arhived) {
            $responseService->responseCode(Response::HTTP_NOT_FOUND, 'Application Not Found');
        }

        $arhived->setarchived(0);
        $entityManager->flush();

        return $responseService->responseCode(Response::HTTP_OK, 'Activation Successful');
    }
}
