<?php

namespace App\Controller;

use App\Entity\Message;
use App\Form\Type\MessageType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\HttpFoundation\Request;
use \Symfony\Component\HttpFoundation\Response;

class ContactController extends AbstractController
{
    /**
     * @param Request $request
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function index(Request $request) : Response
    {
        $message = new Message();

        // set the time to now
//        $message->setMessageDate(new \DateTime('now'));

        // creating the form
        $form = $this->createForm(MessageType::class, $message);

        $form->handleRequest($request);
        // if the form is submitted
        if ($form->isSubmitted() && $form->isValid()) {
            $message = $form->getData();

            // set the time to now
            $message->setMessageDate(new \DateTime());

            // save the message
            $em = $this->getDoctrine()->getManager();
            $em->persist($message);
            $em->flush();

//            return $this->redirectToRoute('task_success');
            return $this->render('contact/success.html.twig', [
            'firstName' => $message->getFirstName(),
            'lastName' => $message->getLastName(),
        ]);

        }

        return $this->render('contact/contact.html.twig', [
            'form' => $form->createView(),
        ]);


    }


}
