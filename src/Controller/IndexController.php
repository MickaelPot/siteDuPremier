<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Repository\LangageRepository;

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



}
