<?php
namespace App\Controller\Admin;

use App\Entity\Message;
use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use\Symfony\Component\HttpFoundation\Response;

class AdminController extends AbstractController
{

    /**
     * @param Request $request
     * @return Response
     */
    public function checkMessages(Request $request) : Response
    {
        $messages = $this->getDoctrine()
            ->getRepository(Message::class)
            ->findAll();

        return $this->render('admin/messages.html.twig', [
            'messages' => $messages
        ]);
    }

    /**
     * @param Request $request
     * @return Response
     */
    public function processMessages(Request $request) : Response
    {
        $checkedMessages = $request->request->get('processedMessages', []);

        foreach ($checkedMessages as $checkedMessage){
            $em = $this->getDoctrine()->getManager();
            $message = $em
                ->getRepository(Message::class)
                ->find($checkedMessage);
            if(!$message->getProcessed()){
                $message->setProcessed(true);
            }
            $em->flush();
        }
        $messages = $this->getDoctrine()
            ->getRepository(Message::class)
            ->findAll();
        return $this->render('admin/messages.html.twig', [
            'messages' => $messages
        ]);
    }
}