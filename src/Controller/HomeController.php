<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class HomeController extends AbstractController
{
    #[Route('/home', name: 'app_home')]
    public function index(): Response
    {
<<<<<<< Updated upstream
<<<<<<< HEAD
        return $this->render('home/index.html.twig', [
=======
        return $this->render('home/userhome.html.twig', [
>>>>>>> GestionUser
=======
        return $this->render('home/index.html.twig', [
>>>>>>> Stashed changes
            'controller_name' => 'HomeController',
        ]);
    }
}
