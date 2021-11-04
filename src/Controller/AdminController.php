<?php

namespace App\Controller;

use App\Entity\User;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class AdminController extends AbstractController
{
    /**
     * permet de voir les messages
     * @Route("/admin", name="admin_contact")
     */
    public function index(): Response
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
            
            return $this->redirectToRoute('admin_contact');
        }    
        

        return $this->render('admin/dashboard.html.twig', ['listData' => $listData]);

    }


    /**
     * @Route("/admin/users", name="admin_users")
     */
    public function user(): Response
    {
        $users = $this->getDoctrine()->getRepository(User::class)->findAll();

        return $this->render('admin/users.html.twig', [
            'users' => $users
        ]);
    }
}
