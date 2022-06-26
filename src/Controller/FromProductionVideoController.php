<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class FromProductionVideoController extends AbstractController
{
    /**
     * @Route("/from/production/video", name="app_from_production_video")
     */
    public function index(): Response
    {
        return $this->render('from_production_video/index.html.twig', [
            'controller_name' => 'FromProductionVideoController',
        ]);
    }
}
