<?php

namespace App\Controller;

use App\Repository\LangageRepository;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class AttenteMailController extends AbstractController
{
    #[Route('/attente/mail', name: 'app_attente_mail')]
    public function index(LangageRepository $repository): Response
    {

        $maVar= $repository->findAll();

        return $this->render('attente_mail/index.html.twig', [
            'controller_name' => 'AttenteMailController',
            'langages' => $maVar,
        ]);
    }
}
