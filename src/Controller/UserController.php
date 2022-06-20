<?php
namespace App\Controller;

use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class UserController extends AbstractController
{
   /**
    * @Route("/users")
    */
    public function notifications(): Response
    {
        $userName = "Rafael";
        $userNotifications = "Notifications - Você ganhou 2 milhões de quanza";


        return $this->render('user/notifications.html.twig', [
            'user_first_name' => $userName,
            'notifications' => $userNotifications,
        ]);
    }
}