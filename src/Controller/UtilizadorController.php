<?php

namespace App\Controller;

use App\Entity\Pessoa;
use App\Entity\Utilizador;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class UtilizadorController extends AbstractController
{
    /**
     * @Route("/utilizador", name="create_utilizador")
     */
    public function criarUtilizador(ManagerRegistry $doctrine): Response
    {
        $entityManager = $doctrine->getManager();

        //Pessoa
        $pessoa = new Pessoa();
        $pessoa->setNome("Rafael Ngunga");
        $pessoa->setIdade(22);

        //Utilizador
        $utilizador = new Utilizador();
        $utilizador->setUsername("rngunga");
        $utilizador->setEmail("rafangu@gmail.com");
        $utilizador->setPassword("123");
        $utilizador->setPessoa($pessoa);

        $entityManager->persist($pessoa);
        $entityManager->persist($utilizador);

        $entityManager->flush();

        return $this->render('utilizador/index.html.twig', [
            'controller_name' => 'UtilizadorController',
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
