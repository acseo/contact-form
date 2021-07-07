<?php


namespace App\Controller;

use App\Form\Type\QuestionsType;
use App\Repository\QuestionRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * Class AdminQuestionController
 * @package App\Controller
 * @Route("/admin")
 */
class AdminQuestionController extends AbstractController
{
    /**
     * @Route("/questions", methods="GET|POST", name="admin_questions")
     */
    public function questions(Request $request, QuestionRepository $questionRepository): Response
    {
        $questions = $questionRepository->findAll();

        $form = $this->createForm(QuestionsType::class, $questions);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
        }

            return $this->render('adminQuestions.html.twig', [
            'form' => $form->createView()
        ]);
    }
}