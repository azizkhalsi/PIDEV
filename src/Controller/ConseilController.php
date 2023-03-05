<?php

namespace App\Controller;

use App\Entity\Conseil;
use App\Form\ConseilType;
use App\Repository\ConseilRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\JsonResponse;

#[Route('/conseil')]
class ConseilController extends AbstractController
{

   
    #[Route('/recherche_ajax', name :'recherche_ajax')]
    public function rechercheAjax(Request $request,ConseilRepository $sr): JsonResponse
    {
        $requestString = $request->query->get('searchValue');
        $resultats = $sr->findStudentByNsc($requestString);

        return $this->json($resultats);
    }

    #[Route('/', name: 'app_conseil_index', methods: ['GET'])]
    public function index(ConseilRepository $conseilRepository): Response
    {
        return $this->render('conseil/index.html.twig', [
            'conseils' => $conseilRepository->findAll(),
        ]);
    }

    #[Route('/co', name: 'app_conseil_index1', methods: ['GET'])]
    public function index1(ConseilRepository $conseilRepository): Response
    {
        return $this->render('conseil/index1.html.twig', [
            'conseils' => $conseilRepository->findAll(),
        ]);
    }

    #[Route('/new', name: 'app_conseil_new', methods: ['GET', 'POST'])]
    public function new(Request $request, ConseilRepository $conseilRepository): Response
    {
       
        $conseil = new Conseil();
        $form = $this->createForm(ConseilType::class, $conseil);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $conseilRepository->save($conseil, true);

            return $this->redirectToRoute('app_conseil_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('conseil/new.html.twig', [
            'conseil' => $conseil,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_conseil_show', methods: ['GET'])]
    public function show(Conseil $conseil): Response
    {
        return $this->render('conseil/show.html.twig', [
            'conseil' => $conseil,
        ]);
    }

    #[Route('/{id}/edit', name: 'app_conseil_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, Conseil $conseil, ConseilRepository $conseilRepository): Response
    {
        $form = $this->createForm(ConseilType::class, $conseil);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $conseilRepository->save($conseil, true);

            return $this->redirectToRoute('app_conseil_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('conseil/edit.html.twig', [
            'conseil' => $conseil,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_conseil_delete', methods: ['POST'])]
    public function delete(Request $request, Conseil $conseil, ConseilRepository $conseilRepository): Response
    {
        if ($this->isCsrfTokenValid('delete'.$conseil->getId(), $request->request->get('_token'))) {
            $conseilRepository->remove($conseil, true);
        }

        return $this->redirectToRoute('app_conseil_index', [], Response::HTTP_SEE_OTHER);
    }
}
