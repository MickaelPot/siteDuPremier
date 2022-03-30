<?php

namespace App\Controller;

use App\Entity\ImageCours;
use App\Form\ImageCoursType;
use App\Repository\ImageCoursRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/image/cours')]
class ImageCoursController extends AbstractController
{
    #[Route('/', name: 'app_image_cours_index', methods: ['GET'])]
    public function index(ImageCoursRepository $imageCoursRepository): Response
    {
        return $this->render('image_cours/index.html.twig', [
            'image_cours' => $imageCoursRepository->findAll(),
        ]);
    }

    #[Route('/new', name: 'app_image_cours_new', methods: ['GET', 'POST'])]
    public function new(Request $request, ImageCoursRepository $imageCoursRepository): Response
    {
        $imageCour = new ImageCours();
        $form = $this->createForm(ImageCoursType::class, $imageCour);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $imageCoursRepository->add($imageCour);
            return $this->redirectToRoute('app_image_cours_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('image_cours/new.html.twig', [
            'image_cour' => $imageCour,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_image_cours_show', methods: ['GET'])]
    public function show(ImageCours $imageCour): Response
    {
        return $this->render('image_cours/show.html.twig', [
            'image_cour' => $imageCour,
        ]);
    }

    #[Route('/{id}/edit', name: 'app_image_cours_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, ImageCours $imageCour, ImageCoursRepository $imageCoursRepository): Response
    {
        $form = $this->createForm(ImageCoursType::class, $imageCour);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $imageCoursRepository->add($imageCour);
            return $this->redirectToRoute('app_image_cours_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('image_cours/edit.html.twig', [
            'image_cour' => $imageCour,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_image_cours_delete', methods: ['POST'])]
    public function delete(Request $request, ImageCours $imageCour, ImageCoursRepository $imageCoursRepository): Response
    {
        if ($this->isCsrfTokenValid('delete'.$imageCour->getId(), $request->request->get('_token'))) {
            $imageCoursRepository->remove($imageCour);
        }

        return $this->redirectToRoute('app_image_cours_index', [], Response::HTTP_SEE_OTHER);
    }
}
