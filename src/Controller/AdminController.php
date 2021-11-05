<?php

namespace App\Controller;

use App\Entity\ContactMessage;
use App\Entity\ContactUser;
use App\Repository\ContactMessageRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class AdminController extends AbstractController
{
    /**
     * @Route("/admin", name="admin")
     */
    public function index(): Response
    {
        /** @var ContactMessageRepository $contactMessageRepo */
        $contactUserRepo = $this->getDoctrine()->getRepository(ContactUser::class);
        $questionsUsers = $contactUserRepo->findAll();
        return $this->render('admin/index.html.twig', [
            'controller_name' => 'AdminController',
            'questionsUsers' => $questionsUsers
        ]);
    }

    /**
     * @Route("/admin/contact/processed/{id}",name="processContactMessage",methods={"GET"})
     */
    public function setMessageAsProcessed(int $id):Response{

        $message = $this->getDoctrine()->getRepository(ContactMessage::class)->find($id);
        if($message != null){
            $message->setProcessed(true);
            $this->getDoctrine()->getManager()->flush();
            return new JsonResponse(['id'=>$id,'status'=>'success']);
        }else{
            return new JsonResponse(['id'=>$id,'status'=>'not found']);
        }

    }
}
