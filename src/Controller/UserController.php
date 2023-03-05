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


use Symfony\Component\Serializer\Normalizer\NormalizerInterface;
use Symfony\Component\Serializer\Serializer;
use Symfony\Component\Serializer\SerializerInterface;
use Symfony\Component\Serializer\Normalizer\ObjectNormalizer;


class UserController extends AbstractController
{
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
    #[Route('/updateuser/{id}', name: 'app_updateuser')]
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

    #[Route('/deleteuser/{id}', name: 'app_deleteuser')]
    public function deleteuser(UserRepository $repository,$id,\Doctrine\Persistence\ManagerRegistry $doctrine){
        $user=$repository->find($id);
        $em=$doctrine->getManager();
        $em->remove($user);
        $em->flush();
        return $this->redirectToRoute("app_Listuser");
    }

//========================================================partie json================================//

#[Route("/AllUser", name: "list")]
//* Dans cette fonction, nous utilisons les services NormlizeInterface et StudentRepository, 
//* avec la méthode d'injection de dépendances.
public function getUsers(UserRepository $repo, SerializerInterface $serializer)
{
    $users = $repo->findAll();
    //* Nous utilisons la fonction normalize qui transforme le tableau d'objets 
    //* students en  tableau associatif simple.
    // $studentsNormalises = $normalizer->normalize($students, 'json', ['groups' => "students"]);

    // //* Nous utilisons la fonction json_encode pour transformer un tableau associatif en format JSON
    // $json = json_encode($studentsNormalises);

    $json = $serializer->serialize($users, 'json', ['groups' => "users"]);

    //* Nous renvoyons une réponse Http qui prend en paramètre un tableau en format JSON
    return new Response($json);
}

#[Route("/User/{id}", name: "user")]
public function UserId($id, NormalizerInterface $normalizer, UserRepository $repo)
{
    $user = $repo->find($id);
    $UserNormalises = $normalizer->normalize($user, 'json', ['groups' => "users"]);
    return new Response(json_encode($userNormalises));
}


#[Route("/register1", name: "addUserJSON", methods: ['GET'])]   
public function addUserJSON(Request $req,  SerializerInterface $serializer)
{

    $em = $this->getDoctrine()->getManager();
    $user = new User();

    $user->setUsername($req->get('username'));
    $user->setEmail($req->get('email'));
    $user->setadresse($req->get('adresse'));
    $user->setPassword($req->get('password'));
    $em->persist($user);
    $em->flush();


  // $json = $serializer->serialize($data, 'json');
    $jsonContent = $serializer->serialize($user, 'json', ['groups' => 'users']);
    return new Response(json_encode($jsonContent));
}

#[Route("updateUserJSON/{id}", name: "updateUserJSON")]
public function updateUserJSON(\Doctrine\Persistence\ManagerRegistry $doctrine,Request $request, $id, NormalizerInterface $Normalizer)
{

    $user=$repository->find($id);
    $form=$this->createForm(UserType::class,$user);
    $form->handleRequest($request);
    if($form->isSubmitted() && $form->isValid()) {
        $em = $doctrine->getManager();
        $em->flush();
    }

    $jsonContent = $Normalizer->normalize($user, 'json', ['groups' => 'users']);
    return new Response("user updated successfully " . json_encode($jsonContent));
}

#[Route("deleteUserJSON/{id}", name: "deleteUserJSON")]
public function deleteUserJSON(Request $req, $id, NormalizerInterface $Normalizer)
{

    $em = $this->getDoctrine()->getManager();
    $user = $em->getRepository(User::class)->find($id);
    $em->remove($User);
    $em->flush();
    $jsonContent = $Normalizer->normalize($user, 'json', ['groups' => 'users']);
    return new Response("User deleted successfully " . json_encode($jsonContent));
}
  #[Route("signin", name: "app_signin")]
    public function signinAction(Request $request)
    {

       $email=$request->query->get("email");
       $password=$request->query->get("password");

       $em=$this->getDoctrine()->getManager();
       $user =$em->getRepository(User::class)->findOneBy(['email'=>$email]);

       if($user){
        if(password_verify($password,$user->getPassword())){
            $serializer = new Serializer([new ObjectNormalizer()]);
            $formatted = $serializer->normalize($user);
            return new JsonResponse($formatted);
        }
                 else {
                   return new Response("password not found");
                    }           
       }
       else {
        return new Response("user not found");
         }
    } 



}
