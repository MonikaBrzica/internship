<?php


namespace App\Controller;


use App\Entity\JobApplications;
use App\Service\ResponseService;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Config\Definition\Exception\Exception;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use App\Service\Mailer\MailerServiceInterface;


class JobController extends AbstractController
{

    public function create(EntityManagerInterface $em, Request $request,ResponseService $responseService,MailerServiceInterface $mailerServiceInterface){
        if(!$request->get('first_name') || !$request->get('last_name') || !$request->get('email') || !$request->get('message') || !$request->files->get('fileName')){
            $responseService->responseCode(Response::HTTP_BAD_REQUEST, 'Bad Request!');
        }else{
            $first_name = $request->get('first_name');
            $last_name = $request->get('last_name');
            $email = $request->get('email');
            $message = $request->get('message');
            $uploadedFile = $request->files->get('fileName');
            $archived = 0;
            if($uploadedFile->getSize()/1024 < 5000 && ($uploadedFile->getClientOriginalExtension() === "pdf" || $uploadedFile->getClientOriginalExtension() === "docx")){
                if (!$first_name || !$last_name || !$email || !$message || !$uploadedFile) {
                    $responseService->responseCode(Response::HTTP_BAD_REQUEST, 'All fields must be filled!!');
                } else {
                    $destination = $this->getParameter('kernel.project_dir') . '/public/CVs';
                    $originalFilename = pathinfo($uploadedFile->getClientOriginalName(), PATHINFO_FILENAME);
                    $newFilename = $originalFilename . '-' . date('Y-m-d') . '-' . uniqid() . '.' . $uploadedFile->getClientOriginalExtension();
                    try {
                        $uploadedFile->move(
                            $destination,
                            $newFilename
                        );
                    } catch (Exception $e) {
                        $responseService->responseCode(Response::HTTP_INTERNAL_SERVER_ERROR, 'Internal server error!');

                    }
                    $cv = new JobApplications();
                    $cv->setFirstName($first_name);
                    $cv->setLastName($last_name);
                    $cv->setEmail($email);
                    $cv->setMessage($message);
                    $cv->setfilename($newFilename);
                    $cv->setarchived($archived);
                    $em->persist($cv);
                    $em->flush();


                    $mailerServiceInterface->send(
                        "praksa@mail.com",
                        $email,
                        'Application submitted!',
                        "email/job_response.html.twig",["first_name" => $first_name]
                    );


                    $responseService->responseCode(Response::HTTP_OK, 'Success!');
                }
            } else {
                $responseService->responseCode(Response::HTTP_BAD_REQUEST, 'File format is not supported');
            }

        }

    }
}