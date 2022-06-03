<?php

namespace App\Controller;

use App\Entity\Formation;
use App\Entity\User;
use App\Form\FormationType;
use Doctrine\ORM\Mapping as ORM;
use Doctrine\ORM\Mapping\Entity;
use App\Repository\UserRepository;
use App\Repository\LangageRepository;
use App\Repository\FormationRepository;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Vich\UploaderBundle\Mapping\Annotation as Vich;
use Vich\UploaderBundle\Mapping\Annotation\Uploadable;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

/**
 * @ORM\Entity(repositoryClass=FormationRepository::class)
 * @Vich\Uploadable()
 */
#[Route('/formation')]
class FormationController extends AbstractController
{


    #[Route('/', name: 'app_formation_index', methods: ['GET'])]
    public function index(FormationRepository $formationRepository, LangageRepository $repository): Response
    {

        $maVar = $repository->findAll();

        return $this->render('formation/index.html.twig', [
            'formations' => $formationRepository->findAll(),
            'langages' => $maVar,
        ]);
    }

    #[Route('/browse', name: 'app_formation_browse', methods: ['GET'])]
    public function browseAll(UserRepository $userRepository, FormationRepository $formationRepository, LangageRepository $repository): Response
    {

        $maVar = $repository->findAll();
        return $this->render('formation/browse.html.twig', [
            'langages' => $maVar,
            'formations' => $formationRepository->findAll(),
            'users' => $userRepository->findAll()
        ]);
    }

    #[Route('/browse/{name}', name: 'app_formation_browse_langage', methods: ['GET'])]
    public function browseLanguage(string $name, UserRepository $userRepository, FormationRepository $formationRepository, LangageRepository $repository): Response
    {

        $maVar = $repository->findAll();
        $langageId = $repository->findOneBy(array("nom" => $name));
        if ($langageId == null) {
            $formation = $formationRepository->findBy(array("langage" => "-1"));
        } else {
            $formation = $formationRepository->findBy(array("langage" => $langageId->getId()));
        }
        return $this->render('formation/browse.html.twig', [
            'langages' => $maVar,
            'formations' => $formation,
            'users' => $userRepository->findAll()
        ]);
    }
    #[Route('/cours/{id}', name: 'app_formation_cours', methods: ['GET'])]
    public function browseCours(int $id, UserRepository $userRepository, FormationRepository $formationRepository, LangageRepository $repository): Response
    {
        $maVar = $repository->findAll();
        return $this->render('formation/cours.html.twig', [
            'langages' => $maVar,
            'formation' => $formationRepository->findoneBy(array("id" => $id)),
            'users' => $userRepository->findAll()
        ]);
    }

    #[Route('/new', name: 'app_formation_new', methods: ['GET', 'POST'])]
    public function new(Request $request, FormationRepository $formationRepository, LangageRepository $repository): Response
    {

        $maVar = $repository->findAll();

        $formation = new Formation();
        $user = $this->getUser();
        $form = $this->createForm(FormationType::class, $formation);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $formation->setIsSignaled(false);
            $formation->setAuteur($user);
            $file = $form['image']->getData();

            $stockageBDD = "imageformation";
            $directory = "../public/" . $stockageBDD;
            $file->move($directory, $file->getClientOriginalName());

            $monFichier = '/' . $stockageBDD . '/' . $file->getClientOriginalName();
            $formation->setImage($monFichier);

            $formationRepository->add($formation);
            return $this->redirectToRoute('app_formation_browse', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('formation/new.html.twig', [
            'formation' => $formation,
            'form' => $form,
            'langages' => $maVar,
        ]);
    }

    #[Route('/{id}', name: 'app_formation_show', methods: ['GET'])]
    public function show(Formation $formation): Response
    {
        return $this->render('formation/show.html.twig', [
            'formation' => $formation,
        ]);
    }

    #[Route('/{id}/edit', name: 'app_formation_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, Formation $formation, FormationRepository $formationRepository, LangageRepository $repository): Response
    {

       

        if ($formation->getImage() != null) {
            $formation->setImage(null);
        }

        $form = $this->createForm(FormationType::class, $formation);
        $form->handleRequest($request);
        $maVar = $repository->findAll();

        if ($form->isSubmitted() && $form->isValid()) {
            $file = $form['image']->getData();

            $stockageBDD = "imageformation";
            $directory = "../public/" . $stockageBDD;
            $file->move($directory, $file->getClientOriginalName());

            $monFichier = '/' . $stockageBDD . '/' . $file->getClientOriginalName();
            $formation->setImage($monFichier);

            $formationRepository->add($formation);
            return $this->redirectToRoute('app_formation_browse', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('formation/edit.html.twig', [
            'formation' => $formation,
            'form' => $form,
            'langages' => $maVar,
        ]);
    }

    #[Route('/{id}', name: 'app_formation_delete', methods: ['POST'])]
    public function delete(Request $request, Formation $formation, FormationRepository $formationRepository): Response
    {
        DD('acces');
        if ($this->isCsrfTokenValid('delete' . $formation->getId(), $request->request->get('_token'))) {
            $formationRepository->remove($formation);
        }

        return $this->redirectToRoute('app_formation_index', [], Response::HTTP_SEE_OTHER);
    }



    //PATH DE SIGNALEMENT
    #[Route('/{id}/signalement', name: 'app_formation_signalement', methods: ['GET', 'POST'])]
    public function signalement(Formation $formation, FormationRepository $formationRepository): Response
    {
        $formation->setIsSignaled(true);
        $formationRepository->add($formation);
        return $this->redirectToRoute('app_formation_browse', [], Response::HTTP_SEE_OTHER);
    }

    //PATH ADMIN NON SIGNALEMENT
    #[Route('/{id}/nonsignalement', name: 'app_formation_nonsignalement', methods: ['GET', 'POST'])]
    public function nonsignalement(Formation $formation, FormationRepository $formationRepository): Response
    {
        $user = $this->getUser();
        $tabRole = $user->getRoles();
        $isAdmin = false;
        for ($i = 0; $i < count($tabRole); $i++) {
            if ($tabRole[$i] == "ROLE_ADMIN") {
                $isAdmin = true;
            }
        }
        if ($isAdmin) {
            $formation->setIsSignaled(false);
            $formationRepository->add($formation);
        }
        return $this->redirectToRoute('app_admin_index', [], Response::HTTP_SEE_OTHER);
    }

    //PATH DE SUPPRESSION
    #[Route('/{id}/suppression', name: 'app_formation_suppression', methods: ['GET', 'POST'])]
    public function supression(Formation $formation, FormationRepository $formationRepository): Response
    {
        $formationRepository->remove($formation);
        return $this->redirectToRoute('app_formation_browse', [], Response::HTTP_SEE_OTHER);
    }
}
