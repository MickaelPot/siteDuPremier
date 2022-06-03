<?php

namespace App\Controller;

use App\Entity\User;
use App\Form\BiographieType;
use App\Repository\UserRepository;
use App\Repository\LangageRepository;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

#[Route('/biography')]
class BiographyController extends AbstractController
{
    #[Route('/', name: 'app_biography_index', methods: ['GET'])]
    public function index(UserRepository $userRepository): Response
    {
        return $this->render('biography/index.html.twig', [
            'users' => $userRepository->findAll(),
        ]);
    }

    #[Route('/new', name: 'app_biography_new', methods: ['GET', 'POST'])]
    public function new(Request $request, UserRepository $userRepository): Response
    {
        $user = new User();
        $form = $this->createForm(User1Type::class, $user);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $userRepository->add($user);
            return $this->redirectToRoute('app_biography_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('biography/new.html.twig', [
            'user' => $user,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_biography_show', methods: ['GET'])]
    public function show(User $user): Response
    {
        return $this->render('biography/show.html.twig', [
            'user' => $user,
        ]);
    }

    #[Route('/{id}/edit', name: 'app_biography_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, User $user, UserRepository $userRepository): Response
    {
        $form = $this->createForm(User1Type::class, $user);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $userRepository->add($user);
            return $this->redirectToRoute('app_biography_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('biography/edit.html.twig', [
            'user' => $user,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_biography_delete', methods: ['POST'])]
    public function delete(Request $request, User $user, UserRepository $userRepository): Response
    {
        if ($this->isCsrfTokenValid('delete'.$user->getId(), $request->request->get('_token'))) {
            $userRepository->remove($user);
        }

        return $this->redirectToRoute('app_biography_index', [], Response::HTTP_SEE_OTHER);
    }

    #[Route('/biography/edit', name: 'app_biography_edit')]
    public function modifieAvatar(LangageRepository $repository,Request $request, UserRepository $userRepository): Response
    {

        $maVar = $repository->findAll();
        $userActif = $this->getUser();

        $userAModif = new User();

        $form = $this->createForm(BiographieType::class, $userAModif);
        $form->handleRequest($request);
        
        if ($form->isSubmitted() && $form->isValid()) {
            $biographie = $form['biographie']->getData();
            $userActif->setBiographie($biographie);
            $userRepository->add($userActif);
            return $this->redirectToRoute('app_compte', [], Response::HTTP_SEE_OTHER);

        }

        return $this->renderForm('avatar/edit.html.twig', [
            'user' => $userAModif,
            'langages' =>$maVar,
            'form' => $form,
        ]);
    }
}
