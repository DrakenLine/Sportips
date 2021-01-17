<?php

namespace App\Controller;

use App\Entity\Activity;
use App\Entity\TypeOfActivity;
use App\Entity\User;
use App\Repository\ActivityRepository;
use Knp\Component\Pager\PaginatorInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class HomeController extends AbstractController
{
    /**
     * @Route("/", name="home")
     * @Route("/home/activity/{id<\d+>}", name="activity_homepage")
     * @Route("/page/{page}", name="home_paginated")
     */
    public function index(ActivityRepository $activityRepository, User $user = null, PaginatorInterface $paginator, $page = 1, Activity $activity): Response
    {
        $user = $this->getUser();
        $activities = $activityRepository->getLatestPaginatedActivities($paginator, $page);
        $activities->setUsedRoute('home_paginated');
        $type = $activityRepository->getTypeOfActivity($activity);

        return $this->render('home/home.html.twig', [
            'lastActivity' => $activityRepository->getLastActivity($user),
            'user' => $user,
            'activities' => $activities,
            'type' => $type
        ]);
    }
}
