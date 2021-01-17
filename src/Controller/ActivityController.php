<?php

namespace App\Controller;

use App\Entity\Activity;
use App\Entity\User;
use App\Form\ActivityFormType;
use Doctrine\ORM\EntityManagerInterface;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Security;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
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

    /**
     * @Route("/activity/add", name="activity_add")
     * @Route("/activity/edit/{id}", name="activity_edit")
     * @Security("is_granted('IS_AUTHENTICATED_FULLY') and (activity === null or activity.getUser() == user)")
     */

    public function activityForm(Request $request, EntityManagerInterface $manager, Activity $activity=null){

        if($activity === null) {
            $activity = new Activity();
        }

        $activityForm = $this->createForm(ActivityFormType::class, $activity);

        $activityForm->handleRequest($request);

        if($activityForm->isSubmitted() && $activityForm->isValid()) {
            // enregistrement du jeu en base de données
            if( ! $activity->getId()) {
                $activity->setUser($this->getUser());
            }
            $manager->persist($activity);
            $manager->flush();
            return $this->redirectToRoute('profile');
        }

        return $this->render('activity/activity-form.html.twig', [
            'activity_form' => $activityForm->createView(),
            'activity' => $activity
        ]);

    }
}
