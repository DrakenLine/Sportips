<?php

namespace App\Controller;

use App\Entity\User;
use App\Repository\ActivityRepository;
use App\Repository\UserRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class UserController extends AbstractController
{
    /**
     * @Route("/profile", name="profile")
     * @Route("/user/{id<\d+>}", name="user_details")
     */
    public function details(UserRepository $repository, User $user = null, ActivityRepository $activityRepository): Response
    {

        $user = $user ? $user : $this->getUser();
        if( ! $user){
            return $this->redirectToRoute('login');
        }
        $activities = $activityRepository->getActivities($user);

        return $this->render('user/details.html.twig', [
            'user' => $user,
            'activities' => $activities
        ]);
    }
}
