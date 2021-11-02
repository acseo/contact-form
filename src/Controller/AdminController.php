<?php

namespace App\Controller;

use App\Entity\User;
use App\Form\RegisterType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

class AdminController extends AbstractController
{
    /**
     * recupére tous les messages
     * @Route("/admin/dashboard", name="admin_dashboard")
     */
    public function dashboard(): Response
    {
        $listData = [];
        $chemin_dossier = $this->getParameter('contact_directory');
        $fichierJson = scandir($this->getParameter('contact_directory'));
        unset($fichierJson[0]);
        unset($fichierJson[1]);
       
        foreach($fichierJson as $fichier)
        {
            $dataJson = file_get_contents($chemin_dossier.$fichier);
            $fichier = json_decode($dataJson, true);

            foreach($fichier as $data){
                
                $listData[] = [
                    'nom' => $data['nom'],
                    'email' => $data['email'],
                    'message' => $data['message']
                ];
            }
        }
            
        return $this->render('admin/dashboard.html.twig', [
            'listData' => $listData
        ]);
    }


    /**
     * Permet de savoir si on a répondu à la personne
     * @Route("admin/{nom}/{message}", name="valide")
     * 
     */
    public function valide($nom, $message)
    {
        // Voir pour le faire en js si plus rapide
        $fichier = $nom.'.json';
        $chemin_fichier = $this->getParameter('contact_directory');
        $listData = [];

        if(file_exists($chemin_fichier.$fichier)){
            $dataJson = file_get_contents($chemin_fichier.$fichier);
            $fichier = json_decode($dataJson, true);
            $fichierPath = $this->getParameter('contact_directory').$nom.'.json';
            
            foreach($fichier as $data){
                
                // récupération du bollean pour le message
                foreach($data['message'] as $d){
                    if($d['message'] === $message){
                       $valider = $d['valider'] ;
                       $valider = "1";
                       $d['valider'] = $valider;
                       
                       $messages = [
                        'message' => $d['message'],
                        'valider' => $d['valider']                  
                       ];                     
                    } 
                }

                array_push($data['message'], $messages);

                $listData[] = [
                    'nom' => $data['nom'],
                    "prenom" => $data['prenom'],
                    'email' => $data['email'],
                    'message' => $data['message']
                ];
            }

            $fichierBis = json_encode($listData);
            file_put_contents($fichierPath, $fichierBis);
            
            return $this->redirectToRoute('admin_dashboard');
        }    
        

        return $this->render('admin/dashboard.html.twig', ['listData' => $listData]);

    }


     /**
     * Permet la création d'un utilisateur
     * @Route("/admin/register", name="admin_create")
     * 
     * @return Response
     */
    public function create(Request $request, EntityManagerInterface $manager,UserPasswordEncoderInterface $encoder)
    {
        $user = new User();
        $form = $this->createForm(RegisterType::class, $user);
        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid())
        {
            $hash = $encoder->encodePassword($user, $user->getHash());
            $user->setHash($hash);

            $manager->persist($user);
            $manager->flush();

            $this->addFlash(
                'success',
                "l'inscription a bient été créé!"
            );

            return $this->redirectToRoute('home');
        }

        return $this->render('admin/register.html.twig', [
            'form' => $form->createView()
        ]);
    }
    
}
