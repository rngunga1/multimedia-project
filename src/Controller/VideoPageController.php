<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class VideoPageController extends AbstractController
{
    /**
     * @Route("/video_page", name="app_video")
     */
    public function index(): Response
    {
        return $this->render('home/video_page.html.twig', [
            'controller_name' => 'HomeController',
        ]);
    }
}
