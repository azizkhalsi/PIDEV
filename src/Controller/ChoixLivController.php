<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ChoixLivController extends AbstractController
{
    #[Route('/ChoixLiv', name: 'app_ChoixLiv')]
    public function index(): Response
    {
        return $this->render('ChoixLiv/index.html.twig', [
            'controller_name' => 'ChoixLivController',
        ]);
    }
}
