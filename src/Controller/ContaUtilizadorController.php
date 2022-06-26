<?php

namespace App\Controller;

use App\Entity\User;
use App\Repository\FilmeRepository;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;



class ContaUtilizadorController extends AbstractController
{
    /**
     * @Route("/minha_conta", name="app_conta_utilizador")
     */
    public function index(ManagerRegistry $doctrine): Response
    {

        $userLogado = $this->get('security.token_storage')->getToken()->getUser();
        

        $filmeRepository = new FilmeRepository($doctrine);

        $filmes = $filmeRepository->findAll();

        $filmesByUser = [];

        foreach ($filmes as $filme) {
            $user = $filme->getUploadUser();
            
            if ($user->getId() == $userLogado->getId()) {
                array_push($filmesByUser, $filme);
            }
        }


        // return new Response($filmesByCategory[0]->getCategoria()->getNome());
        return $this->render('conta_utilizador/index.html.twig', [
            'filmes' => $filmesByUser
        ]);
        return $this->render('conta_utilizador/index.html.twig', [
            'controller_name' => 'ContaUtilizadorController',
        ]);
    }
}
