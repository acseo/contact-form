<?php

namespace AC\ContactBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use AC\ContactBundle\Entity\AdminType;
use AC\ContactBundle\Entity\Demande;
use AC\ContactBundle\Entity\InternauteType;
use AC\ContactBundle\Entity\Internaute;
use AC\ContactBundle\Entity\Admin;
use Symfony\Component\Security\Core\Exception\AccessDeniedException;



class DefaultController extends Controller {

    public function accueilAction() {
        return $this->render('ACContactBundle:Default:accueil.html.twig');
    }

    public function formAction(Request $request) {
        $internaute = new Internaute();
        $demande = new Demande();
        $internaute->getDemande()->add($demande);
        $form = $this->createForm(InternauteType::class, $internaute);
        if ($request->isMethod('POST')) {
            $form->handleRequest($request);
            if ($form->isValid()) {
                $demande->setInternaute($internaute);
                $em = $this->getDoctrine()->getManager();
                $em->persist($internaute);
                $em->persist($demande);
                $em->flush();
                $request->getSession()->getFlashBag()->add('notice', 'Demande bien enregistrée.');
                return $this->redirectToRoute('ac_contact_accueil');
            }
        }
        return $this->render('ACContactBundle:Default:form.html.twig', array(
                    'form' => $form->createView(),
        ));
    }

    function adminAction(Request $request) {
         if (!$this->get('security.authorization_checker')->isGranted('ROLE_ADMIN')) {
            // Sinon on déclenche une exception « Accès interdit »
            throw new AccessDeniedException('Accès non autorisé.');
          }
        $em = $this->getDoctrine()->getManager();
        $listDemandes = $em->getRepository('ACContactBundle:Demande')->findAll();
        $listInternautes = $em->createQueryBuilder()
                ->select('i')->from(Internaute::class, 'i', 'i.id')
                ->getQuery()
                ->getResult(\Doctrine\ORM\Query::HYDRATE_ARRAY);
        $admin = new Admin();
        foreach ($listDemandes as $demande) {
            $admin->getDemande()->add($demande);
        }
        $form = $this->createForm(AdminType::class, $admin);
        if ($request->isMethod('POST')) {
            $form->handleRequest($request);
            if ($form->isValid()) {
                $em = $this->getDoctrine()->getManager();
                $em->persist($demande);
                $em->flush();
                return $this->redirectToRoute('ac_contact_admin');
            }
        }
        return $this->render('ACContactBundle:Default:admin.html.twig', array(
                    'form' => $form->createView(),
                    'listDemandes' => $listDemandes,
                    'listInternautes' => $listInternautes)
        );
    }

    public function loginAction(Request $request) {
        // OC ;)
        // Si le visiteur est déjà identifié, on le redirige vers l'accueil
        if ($this->get('security.authorization_checker')->isGranted('IS_AUTHENTICATED_REMEMBERED')) {
            return $this->redirectToRoute('ac_contact_accueil');
        }

        // Le service authentication_utils permet de récupérer le nom d'utilisateur
        // et l'erreur dans le cas où le formulaire a déjà été soumis mais était invalide
        // (mauvais mot de passe par exemple)
        $authenticationUtils = $this->get('security.authentication_utils');

        return $this->render('ACContactBundle:Default:login.html.twig', array(
                    'last_username' => $authenticationUtils->getLastUsername(),
                    'error' => $authenticationUtils->getLastAuthenticationError(),
        ));
    }

}
