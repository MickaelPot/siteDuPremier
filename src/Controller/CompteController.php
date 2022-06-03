<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Repository\LangageRepository;

class CompteController extends AbstractController
{
    #[Route('/compte', name: 'app_compte')]
    public function index(LangageRepository $repository): Response
    {

        $maVar= $repository->findAll();
        $user=$this->getUser();

        return $this->render('compte/index.html.twig', [
            'controller_name' => 'CompteController',
            'langages' => $maVar,
            'user'=>$user,
        ]);
    }
}
