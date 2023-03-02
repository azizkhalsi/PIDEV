<?php

namespace App\Controller;

use App\Entity\Classroom;
use App\Entity\User;
use App\Form\ClassroomType;
use App\Form\UserType;
use App\Repository\ClassroomRepository;
use App\Repository\UserRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\JsonResponse;


class UserController extends AbstractController
{

   
    #[Route("/recherche_ajax", name: "recherche_ajax")]

    public function rechercheAjax(Request $request,UserRepository $sr): JsonResponse
    {
        $requestString = $request->query->get('searchValue');
        $resultats = $sr->findStudentByNsc($requestString);

        return $this->json($resultats);
    }
    
    #[Route('/user', name: 'app_user')]
    public function index(): Response
    {
        return $this->render('user/index.html.twig', [
            'controller_name' => 'UserController',
        ]);
    }

    #[Route('/Listuser', name: 'app_Listuser')]
    public function Listuser(UserRepository $repository){
        $user=$repository->findAll();


        //* Nous renvoyons une réponse Http qui prend en paramètre un tableau en format JSON

        return $this->render("user/listuser.html.twig",array("tabuser"=>$user));

    }
    #[Route('/adduser', name: 'app_adduser')]
    public function adduser(\Doctrine\Persistence\ManagerRegistry $doctrine,Request $request){

        $user=new  User();
        $form=$this->createForm(UserType::class,$user);
        $form->handleRequest($request);
        if($form->isSubmitted()) {
            $em = $doctrine->getManager();
            $em->persist($user);
            $em->flush();
            return $this->redirectToRoute('app_Listuser');
        }
        return $this->renderForm("user/adduser.html.twig",
            array("formUser"=>$form));

    }
    #[Route('/{id}/updateuser', name: 'app_updateuser')]
    public function updateuser(\Doctrine\Persistence\ManagerRegistry $doctrine,Request $request,UserRepository $repository,$id){

        $user=$repository->find($id);
        $form=$this->createForm(UserType::class,$user);
        $form->handleRequest($request);
        if($form->isSubmitted() && $form->isValid()) {
            $em = $doctrine->getManager();
            $em->flush();
            return $this->redirectToRoute('app_Listuser');
        }
        return $this->renderForm("user/updateuser.html.twig",array("formUser"=>$form));

    }

    #[Route('/{id}/deleteuser', name: 'app_deleteuser')]
    public function deleteuser(UserRepository $repository,$id,\Doctrine\Persistence\ManagerRegistry $doctrine){
        $user=$repository->find($id);
        $em=$doctrine->getManager();
        $em->remove($user);
        $em->flush();
        return $this->redirectToRoute("app_Listuser");

    }



}
