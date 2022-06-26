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
use Symfony\Component\String\Slugger\SluggerInterface;
use Symfony\Component\HttpFoundation\File\Exception\FileException;
use App\Repository\CategoriaRepository;

use Symfony\Component\HttpFoundation\Request;

class VideoPageController extends AbstractController
{
    /**
     * @Route("/video_page/{filme}", name="app_video")
     */
    public function index(Filme $filme): Response
    {
        $user = $filme->getUploadUser();
        $url = $filme->getUrl();
        
        //Keemple-Smart-Home-3D-animation-62b7c29c5b11b.mp4
        return $this->render('video/video_page.html.twig', [
            'controller_name' => 'VideoController',
            'filme' => $filme,
            'user' => $user,
            'url' => '/uploads/videos/' . $url,
        ]);
    }

    /**
     * @Route("/upload", name="upload")
     */
    public function uploadController(Request $request, SluggerInterface $slugger, ManagerRegistry $doctrine): Response
    {

        $filme1 = new Filme();
        $formulario = $this->createForm(FormMovieType::class, $filme1);



        $formulario->handleRequest($request);
        if($formulario->isSubmitted() && $formulario->isValid()) {
            $brochureFile = $formulario->get('URL')->getData();

            if ($brochureFile) {
                $originalFilename = pathinfo($brochureFile->getClientOriginalName(), PATHINFO_FILENAME);
                $safeFilename = $slugger->slug($originalFilename);
                $newFilename = $safeFilename.'-'.uniqid().'.'.$brochureFile->guessExtension();

                //move the file to the directory where brochures are stored
                try {
                    $brochureFile->move(
                        $this->getParameter('videos'),
                        $newFilename
                    );
                } catch (FileException $e) {
                    // ... handle exception if something happens during file upload
                }
                $filme1->setUrl($newFilename);

                $categoriaRepository = new CategoriaRepository($doctrine);
                $categoria = $categoriaRepository->findByName($filme1->getCategoria()->getNome());
                

                $user = $this->get('security.token_storage')->getToken()->getUser();

                $filme1->setCategoria($categoria);
                $filme1->setUploadUser($user);
                $entityManager = $doctrine->getManager();
                $entityManager->persist($filme1);
                $entityManager->flush();
                

            }
            return new Response('Check out this great product: '. $categoria->getNome() );
            

        }

        
        $filme = new Filme();
    

        $form = $this->createForm(FormMovieType::class, $filme);

        return $this->renderForm('video/upload_video.html.twig', [
            'form' =>$form
        ]);
        
        //return $this->render('video/upload_video.html.twig');
    }

    
}
