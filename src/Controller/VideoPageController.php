<?php

namespace App\Controller;

use App\Entity\Categoria;
use App\Entity\Filme;
use App\Entity\Utilizador;
use App\Form\FormMovieType;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\HttpFoundation\Request;

class VideoPageController extends AbstractController
{
    /**
     * @Route("/video_page", name="app_video")
     */
    public function index(): Response
    {
        return $this->render('video/video_page.html.twig', [
            'controller_name' => 'VideoController',
        ]);
    }

    /**
     * @Route("/upload", name="upload")
     */
    public function uploadController(Request $request, ManagerRegistry $doctrine): Response
    {

        $filme1 = new Filme();
        $formulario = $this->createForm(FormMovieType::class, $filme1);



        $formulario->handleRequest($request);
        if($formulario->isSubmitted() && $formulario->isValid()) {
            return new Response('Check out this great product: '. $filme1->getTitulo());

        }

        
        $filme = new Filme();
    

        $form = $this->createForm(FormMovieType::class, $filme);

        return $this->renderForm('video/upload_video.html.twig', [
            'form' =>$form
        ]);
        
        //return $this->render('video/upload_video.html.twig');
    }

    
}
