<?php

namespace App\Controller;

use App\Entity\Activity;
use App\Entity\User;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ActivityController extends AbstractController
{
    /**
     * @Route("/activity/{id<\d+>}", name="activity_details")
     */
    public function detailsActivity(User $user = null, Activity $activity): Response
    {
        $user = $this->getUser();
        return $this->render('activity/activity.html.twig', [
            'activity' => $activity,
            'user' => $user
        ]);
    }
}
