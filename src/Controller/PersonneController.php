<?php


namespace App\Controller;


use App\Beans\Service\Personne\SavePersonneBean;
use App\Form\Type\PersonneSearchEmail;
use App\Form\Type\PersonneSearchEmailType;
use App\Form\Type\PersonneType;
use App\Repository\PersonneRepository;
use App\Service\PersonneJsonService;
use App\Service\PersonneService;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * Class PersonneController
 * @package App\Controller
 * @Route("/personne")
 */
class PersonneController extends AbstractController
{
    /**
     * @Route("/list", methods="GET", name="personne_list")
     */
    public function getList(): Response
    {
        return $this->render('personnes.html.twig');
    }

    /**
     * @Route("/new", methods="GET|POST", name="new")
     * @param Request $request
     * @return Response
     */
    public function new(Request $request, PersonneService $personneService, PersonneJsonService $personneJsonService): Response
    {
        $form = $this->createForm(PersonneType::class);

        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $personne = $form->getData();
            $savePersonneBean = new SavePersonneBean(
                $personne['nom'],
                $personne['email'],
                $personne['question']
            );

            $personneEntity = $personneService->save($savePersonneBean);
            $em = $this->getDoctrine()->getManager();
            $em->persist($personneEntity);
            $em->flush();

            $personneJsonService->saveJson($savePersonneBean);

            return $this->redirectToRoute('personne_success');
        }
        return $this->render('new.html.twig', [
            'form' => $form->createView()
        ]);
    }

    /**
     * @Route("/success_save", methods="GET", name="personne_success")
     */
    public function enregistrementReussie()
    {
        return $this->render('enregistrementReussie.html.twig');
    }

    /**
     * @Route ("/questions", methods="GET|POST", name="questions_personne")
     * @param Request $request
     * @param PersonneRepository $personneRepository
     * @return Response
     */
    public function voirQuestions(Request $request, PersonneRepository $personneRepository): Response
    {
        $form = $this->createForm(PersonneSearchEmailType::class);
        $errorMessage = null;

        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $personneData = $form->getData();
            $personne = $personneRepository->findOneBy(['email' => $personneData['email']]);

            if (null === $personne) {
                $errorMessage = "L'adresse email " . $personneData['email'] . ' est inconnue.';
            } else {
                return $this->render('personnes.html.twig', [
                    'form' => $form->createView(),
                    'questions' => $personne->getQuestions()
                ]);
            }
        }


        return $this->render('personnes.html.twig', [
            'form' => $form->createView(),
            'errorMsg' => $errorMessage
        ]);


    }


}