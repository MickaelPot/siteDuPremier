<?php

namespace App\Controller;

use App\Entity\User;
use App\Form\AvatarType;
use App\Repository\LangageRepository;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class ModifieAvatarController extends AbstractController
{
    #[Route('/modifie/avatar', name: 'app_modifie_avatar', methods: ['GET', 'POST'])]
    public function index(LangageRepository $repository, Request $request): Response
    {
        $maVar = $repository->findAll();
        $userActif = $this->getUser();

        $userAModif = new User();

        $form = $this->createForm(AvatarType::class, $userAModif);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            DD($userAModif->getPhoto());
            //$userActif->setPhoto()

        }
            return $this->renderForm('avatar/index.html.twig', [
                'user' => $userAModif,
                'form' => $form,
                'langages' => $maVar,
            ]);
        }
    
}
