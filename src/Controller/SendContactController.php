<?php

namespace App\Controller;

use App\Entity\User;
use DateTimeImmutable;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Serializer\Serializer;
use Symfony\Component\Serializer\SerializerInterface;

class SendContactController extends AbstractController
{
    #[Route('/send/contact', methods: 'POST', name: 'send_contact')]
    public function store(Request $request, ManagerRegistry $managerRegistry): Response
    {
        $manager  = $managerRegistry->getManager();

        $user = new User;
        $user->setName($request->get('name'));
        $user->setEmail($request->get('email'));
        $user->setPhone($request->get('phone'));
        $user->setCep($request->get('cep'));
        $user->setUpdatedAt(new DateTimeImmutable());
        $user->setCreatedAt(new DateTimeImmutable());
        $manager->persist($user);
        $manager->flush();

        return $this->json([
            'message' => 'user inserted successfully'
        ]);
    }

    #[Route('/list/contact', methods: 'GET', name: 'list_contact')]
    public function list(ManagerRegistry $managerRegistry)
    {        
        $allContacts = $managerRegistry->getRepository(User::class)->findAll();

        $allContactSerialize = array_map(function($contact){
            return $contact->toArray();
        }, $allContacts);
       
        return $this->json([
            'data'=> $allContactSerialize
        ]);
    }
}
