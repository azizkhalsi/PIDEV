<?php

namespace App\Controller;

use App\Entity\TypeCons;
use App\Form\TypeConsType;
use App\Repository\TypeConsRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/type/cons')]
class TypeConsController extends AbstractController
{
    #[Route('/', name: 'app_type_cons_index', methods: ['GET'])]
    public function index(TypeConsRepository $typeConsRepository): Response
    {
        return $this->render('type_cons/index.html.twig', [
            'type_cons' => $typeConsRepository->findAll(),
        ]);
    }

    #[Route('/new', name: 'app_type_cons_new', methods: ['GET', 'POST'])]
    public function new(Request $request, TypeConsRepository $typeConsRepository): Response
    {
        $typeCon = new TypeCons();
        $form = $this->createForm(TypeConsType::class, $typeCon);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $typeConsRepository->save($typeCon, true);

            return $this->redirectToRoute('app_type_cons_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('type_cons/new.html.twig', [
            'type_con' => $typeCon,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_type_cons_show', methods: ['GET'])]
    public function show(TypeCons $typeCon): Response
    {
        return $this->render('type_cons/show.html.twig', [
            'type_con' => $typeCon,
        ]);
    }

    #[Route('/{id}/edit', name: 'app_type_cons_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, TypeCons $typeCon, TypeConsRepository $typeConsRepository): Response
    {
        $form = $this->createForm(TypeConsType::class, $typeCon);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $typeConsRepository->save($typeCon, true);

            return $this->redirectToRoute('app_type_cons_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('type_cons/edit.html.twig', [
            'type_con' => $typeCon,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_type_cons_delete', methods: ['POST'])]
    public function delete(Request $request, TypeCons $typeCon, TypeConsRepository $typeConsRepository): Response
    {
        if ($this->isCsrfTokenValid('delete'.$typeCon->getId(), $request->request->get('_token'))) {
            $typeConsRepository->remove($typeCon, true);
        }

        return $this->redirectToRoute('app_type_cons_index', [], Response::HTTP_SEE_OTHER);
    }
}
