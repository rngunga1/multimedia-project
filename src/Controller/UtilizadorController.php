<?php

namespace App\Controller;

use App\Entity\Pessoa;
use App\Entity\Utilizador;
use App\Form\FormRegistroUtilizadorType;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Entity\User;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasher;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;
use Symfony\Component\PasswordHasher\PasswordHasherInterface;
use Symfony\Component\Security\Http\Authentication\AuthenticationUtils;


class UtilizadorController extends AbstractController
{
    /**
     * @Route("/utilizador", name="create_utilizador")
     */
    public function criarUtilizador(UserPasswordHasherInterface $passwordHasher, Request $request, ManagerRegistry $doctrine): Response
    {
        $utilizador1 = new User();
        $formulario1 = $this->createForm(FormRegistroUtilizadorType::class, $utilizador1);
       ;
    

        $formulario1->handleRequest($request);
        if($formulario1->isSubmitted()) {
            $utilizador1 = $formulario1->getData();
            $hashedPassword = $passwordHasher->hashPassword($utilizador1, $utilizador1->getPassword());
            $utilizador1->setPassword($hashedPassword);

            $entityManager = $doctrine->getManager();
            $entityManager->persist($utilizador1);
            $entityManager->flush();
            
            $response = $this->forward('App\Controller\HomeController::index', [
  
            ]);
            return $response;
            // return new Response('Check out this great user: '. $utilizador1->getusername() . "<br>Password: " . $utilizador1->getPassword());

        }

        $utilizador = new User();
    

        $form = $this->createForm(FormRegistroUtilizadorType::class, $utilizador);

        return $this->renderForm('utilizador/registro_utilizador.html.twig', [
            'form' =>$form
        ]);
        
    }

    /**
     * @Route("/login", name="login")
     */
    public function login(AuthenticationUtils $authenticationUtils): Response
    {
        $error = $authenticationUtils->getLastAuthenticationError();
        $lastUsername = $authenticationUtils->getLastUsername();
        return $this->render("utilizador/login.html.twig", [
            'controller_name' => 'LoginController',
            'last_username' => $lastUsername,
            'error' => $error,
        ]); 
    }

    /**
     * @Route("/show_utilizador/{id}", name="show_utilizador")
     */
    public function mostrarUtilizador(ManagerRegistry $doctrine, int $id): Response
    {
        $utilizadorRepository = $doctrine->getRepository(Utilizador::class);
        $utilizador = $utilizadorRepository->find($id);
        return new Response("<body>Utilizador " . $utilizador->getUsername() . " Encontrado</body>");
    }
}
