<?php

namespace App\Controller;

use App\Repository\UserRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;
use Symfony\Component\Routing\Attribute\Route;

class LoginController extends AbstractController
{
    #[Route('/login', name: 'app_login')]
    public function index(
        Request $request,
        UserRepository $repository,
        UserPasswordHasherInterface $passwordHasher
    ): JsonResponse
    {
        $content = json_decode($request->getContent(),true); // decode json en tableau

        $pseudo = $content['pseudo'] ??  null;
        $password = $content['password'] ?? null;

        $user = $repository->findOneBy(['pseudo'=>$pseudo]);
        if(!$user){
            return new JsonResponse([
                'statut'=> false,
                'message'=> 'Pseudo ou Mots de passe invalide'
            ]);
        }

        $userPassword = $user->getPassword();
//        $hashPassword = $passwordHasher->hashPassword($user,$password);
        $hashPassword = md5($password);

        if($hashPassword != $userPassword){
            return new JsonResponse([
                'statut'=> false,
                'message'=> 'Pseudo ou Mots de passe invalide.'
            ]);
        }

        return new JsonResponse([
            'status'=>true,
            'user'=> [
                'id'=>$user->getId(),
                'name'=>$user->getNom(),
                'pseudo'=>$user->getPseudo()
            ],
            'message'=>'success'
        ]);
    }
}
