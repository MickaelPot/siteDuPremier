<?php

namespace App\Controller;

use App\DTO\SearchDto;
use App\Repository\FormationRepository;
use App\Repository\LangageRepository;
use FOS\CKEditorBundle\Builder\JsonBuilder;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class IndexController extends AbstractController
{


    #[Route('/', name: 'app_index')]
    public function index(LangageRepository $repository ): Response
    {

        $maVar= $repository->findAll();

        return $this->render('index/index.html.twig', [
            'controller_name' => 'IndexController',
            'langages' => $maVar,
        ]);
    }

    public function showLangage()
    {
    $entityManager = $this->getDoctrine()->getManager();
    $records = $entityManager->getRepository("App\Entity\Langage")->findAll();
    dd($records);
        //return $this->render('project/show.html.twig', [
        //    'records' => $records
        //]);
    }

    #[Route('/rechercher', name: 'rechercher', methods: ['POST'])]
    public function rechercher(Request $request, LangageRepository $langage, FormationRepository $formationRepository) : Response
    {

        //Creer un objet DTO
        $donnee= $request->request->get('recherche');

        $dto = new SearchDto();

        $search = $dto->getSearch($donnee, $langage, $formationRepository );




        $response = new Response(
            'Content',
             Response::HTTP_OK,
             ['content-type' => 'text/html']
        );
        $response->setContent(json_encode($search));
        return $response;
    } 



}
