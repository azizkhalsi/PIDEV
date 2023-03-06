<?php

namespace App\Controller;

use App\Entity\Reclamation;
use App\Form\ReclamationType;
use App\Repository\ReclamationRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Mailer\MailerInterface;
use Symfony\Component\Mime\Email;

#[Route('/reclamation')]
class ReclamationController extends AbstractController
{
    #[Route('/re', name: 'app_reclamation_index', methods: ['GET'])]
    public function index(ReclamationRepository $reclamationRepository): Response
    {
        return $this->render('reclamation/index.html.twig', [
            'Reclamations' => $reclamationRepository->findAll(),
        ]);
    }

    #[Route('/reC', name: 'app_reclamation_client', methods: ['GET'])]
    public function indexclient(ReclamationRepository $reclamationRepository): Response
    {
        return $this->render('reclamation/indexClient.html.twig', [
            'Reclamations' => $reclamationRepository->findAll(),
        ]);
    }

    #[Route('/new', name: 'app_reclamation_new', methods: ['GET', 'POST'])]
    public function new(Request $request, ReclamationRepository $reclamationRepository,MailerInterface $mailer): Response
    {
        $reclamation = new Reclamation();
        $form = $this->createForm(ReclamationType::class, $reclamation);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $reclamationRepository->save($reclamation, true);
            return $this->redirectToRoute('app_reclamation_index', [], Response::HTTP_SEE_OTHER);

        }
        return $this->renderForm('reclamation/new.html.twig', [
            'reclamation' => $reclamation,
            'form' => $form,
        ]);

    }

    #[Route('/newclient', name: 'app_reclamation_newclient', methods: ['GET', 'POST'])]
    public function newclient(Request $request, ReclamationRepository $reclamationRepository,MailerInterface $mailer): Response
    {
        $reclamation = new Reclamation();
        $form = $this->createForm(ReclamationType::class, $reclamation);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $reclamationRepository->save($reclamation, true);
            $email = (new Email())
            ->from('Recyc-Ligne@gmail.com')
            ->to('User@gmail.com')
            ->subject('Recyc-Ligne')
            ->text('Votre Recelamation est bien pris en compte');

        $mailer->send($email);
      
        return $this->redirectToRoute('app_reclamation_client', [], Response::HTTP_SEE_OTHER);

        }

        return $this->renderForm('reclamation/newclient.html.twig', [
            'reclamation' => $reclamation,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_reclamation_show', methods: ['GET'])]
    public function show(Reclamation $reclamation): Response
    {
        return $this->render('reclamation/show.html.twig', [
            'reclamation' => $reclamation,
        ]);
    }

    #[Route('/{id}/showclient', name: 'app_reclamation_showclient', methods: ['GET'])]
    public function showclient(Reclamation $reclamation): Response
    {
        return $this->render('reclamation/showclient.html.twig', [
            'reclamation' => $reclamation,
        ]);
    }


    #[Route('/{id}/edit', name: 'app_reclamation_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, Reclamation $reclamation, ReclamationRepository $reclamationRepository): Response
    {
        $form = $this->createForm(ReclamationType::class, $reclamation);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $reclamationRepository->save($reclamation, true);

            return $this->redirectToRoute('app_reclamation_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('reclamation/edit.html.twig', [
            'reclamation' => $reclamation,
            'form' => $form,
        ]);
    }

    #[Route('/{id}/editclient', name: 'app_reclamation_editclient', methods: ['GET', 'POST'])]
    public function editclient(Request $request, Reclamation $reclamation, ReclamationRepository $reclamationRepository): Response
    {
        $form = $this->createForm(ReclamationType::class, $reclamation);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $reclamationRepository->save($reclamation, true);

            return $this->redirectToRoute('app_reclamation_client', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('reclamation/editclient.html.twig', [
            'reclamation' => $reclamation,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_reclamation_delete', methods: ['POST'])]
    public function delete(Request $request, Reclamation $reclamation, ReclamationRepository $reclamationRepository): Response
    {
        if ($this->isCsrfTokenValid('delete'.$reclamation->getId(), $request->request->get('_token'))) {
            $reclamationRepository->remove($reclamation, true);
        }

        return $this->redirectToRoute('app_reclamation_index', [], Response::HTTP_SEE_OTHER);
    }


}
