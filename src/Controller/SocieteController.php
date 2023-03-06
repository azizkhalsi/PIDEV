<?php

namespace App\Controller;

use App\Entity\Societe;
use App\Form\SocieteType;
use App\Repository\SocieteRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Serializer\Normalizer\NormalizerInterface;
use Symfony\Component\Serializer\Serializer;
use Symfony\Component\Serializer\SerializerInterface;
use Symfony\Component\Serializer\Normalizer\ObjectNormalizer;


#[Route('/Societe')]
class SocieteController extends AbstractController
{

    #[Route("/recherche_ajaxsociete", name: "recherche_ajaxsociete")]

    public function rechercheAjaxsociete(Request $request,SocieteRepository $sr,NormalizerInterface $Normalizer)
    {
        $requestString = $request->query->get('searchValue');
        $societes=$sr->findsociete($requestString);
        $jsonContent = $Normalizer->normalize($societes, 'json',['groups'=>'societes']);
        $resultats = json_encode($jsonContent);

        return new Response($resultats);
    }


    #[Route('/sa', name: 'app_Societe_index', methods: ['GET'])]
    public function index(SocieteRepository $SocieteRepository): Response
    {
        return $this->render('Societe/index.html.twig', [
            'Societes' => $SocieteRepository->findAll(),
        ]);
    }

    #[Route('/Societe', name: 'app_Societe_client', methods: ['GET'])]
    public function indexclient(SocieteRepository $SocieteRepository): Response
    {
        return $this->render('Societe/indexClient.html.twig', [
            'Societes' => $SocieteRepository->findAll(),
        ]);
    }

    #[Route('/new', name: 'app_Societe_new', methods: ['GET', 'POST'])]
    public function new(Request $request, SocieteRepository $SocieteRepository): Response
    {
        $Societe = new Societe();
        $form = $this->createForm(SocieteType::class, $Societe);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $SocieteRepository->save($Societe, true);

            return $this->redirectToRoute('app_Societe_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('Societe/new.html.twig', [
            'Societe' => $Societe,
            'form' => $form,
        ]);
    }

    #[Route('/{id}/admin', name: 'app_Societe_show', methods: ['GET'])]
    public function show(Societe $Societe): Response
    {
        return $this->render('Societe/show.html.twig', [
            'Societe' => $Societe,
        ]);
    }

    #[Route('/{id}', name: 'app_Societe_showclient', methods: ['GET'])]
    public function showclient(Societe $Societe): Response
    {
        return $this->render('Societe/showclient.html.twig', [
            'Societe' => $Societe,
        ]);
    }

    #[Route('/{id}/edit', name: 'app_Societe_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, Societe $Societe, SocieteRepository $SocieteRepository): Response
    {
        $form = $this->createForm(SocieteType::class, $Societe);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $SocieteRepository->save($Societe, true);

            return $this->redirectToRoute('app_Societe_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('Societe/edit.html.twig', [
            'Societe' => $Societe,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_Societe_delete', methods: ['POST'])]
    public function delete(Request $request, Societe $Societe, SocieteRepository $SocieteRepository): Response
    {
        if ($this->isCsrfTokenValid('delete'.$Societe->getId(), $request->request->get('_token'))) {
            $SocieteRepository->remove($Societe, true);
        }

        return $this->redirectToRoute('app_Societe_index', [], Response::HTTP_SEE_OTHER);
    }
}
