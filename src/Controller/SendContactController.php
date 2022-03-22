<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class SendContactController extends AbstractController
{
    #[Route('/send/contact', methods: 'POST', name: 'app_send_contact')]
    public function index(): Response
    {

        return $this->json([
            'message' => 'Welcome to your new controller!',
            'path' => 'src/Controller/SendContactController.php',
        ]);
    }
}
