<?php

namespace App\Controller;

use App\Entity\Contact;
use App\Form\ContactType;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class ContactController extends AbstractController
{
    /**
     * Permet la création d'un message
     * @Route("/contact", name="contact")
     */
    public function index(Request $request): Response
    {
        $contact = new Contact();
        $contactForm =  $this->createForm(ContactType::class, $contact);
        $contactForm->handleRequest($request);

        if($contactForm->isSubmitted() && $contactForm->isValid())
        {
            $arrayContact = [];
            $message = [];
            $validate = "0";
            $fileContact = $contactForm->get('nom')->getData().'.json';
            $filePath = $this->getParameter('contact_directory').$fileContact;

            if(!file_exists($filePath)){
               
                $message= [   
                    'message' => $contactForm->get('message')->getData(),
                    'valider' => $validate
                ];
                
                $arrayContact[] = [
                    "nom" => $contactForm->get('nom')->getData(),
                    "prenom" => $contactForm->get('prenom')->getData(),
                    "email" => $contactForm->get('email')->getData(),
                    "message" => [$message]
                    
                ];


                
                $file = json_encode($arrayContact);
                file_put_contents($filePath, $file);

                $this->addFlash(
                    'success',
                    "le message a bien été envoyé!"
                );
                
                
                return $this->redirectToRoute('home');

            } else {

                $dataJson = file_get_contents($filePath);
                $fichier = json_decode($dataJson, true);
                $filePath = $this->getParameter('contact_directory').$fileContact;

                foreach($fichier as $data){
                    
                    $message= [   
                        'message' => $contactForm->get('message')->getData(),
                        'valider' => $validate
                    ];
                    
                    array_push($data['message'], $message);
                    
                    
                    $listData[] = [
                        'nom' => $data['nom'],
                        "prenom" => $data['prenom'],
                        'email' => $data['email'],
                        'message' => $data['message']
                    ];
                    
                }

                $fichierbis = json_encode($listData);
                file_put_contents($filePath, $fichierbis);

                $this->addFlash(
                    'success',
                    "le message a bien été envoyé!"
                );
                
                
                return $this->redirectToRoute('home');
                
            }
                  
        }
        
        return $this->render('contact/index.html.twig', [
            'contactForm' => $contactForm->createView(),
        ]);
    }
}
