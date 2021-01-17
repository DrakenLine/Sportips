<?php

namespace App\DataFixtures;

use App\Entity\Activity;
use App\Entity\TypeOfActivity;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Persistence\ObjectManager;
use Faker\Factory;

class ActivityFixtures extends Fixture implements DependentFixtureInterface
{
    const ACTIVITIES_COUNT = 40;

    public function load(ObjectManager $manager)
    {
        $faker = Factory::create('fr_FR');
        // $product = new Product();
        // $manager->persist($product);

        for ($i=0; $i < self::ACTIVITIES_COUNT; $i++) {
            $activity = new Activity();
            $activity->setName($faker->text(25));
            $activity->setDidAt($faker->dateTimeBetween('-2 years', 'now'));
            if (TypeFixtures::TYPESKM ){
                $activity->setKm(random_int(0, 200));
                $activity->setElevation(random_int(0, 1000));
                $activity->setType($this->getReference('type2'.random_int(0, count(TypeFixtures::TYPESKM) -1)));

            }elseif(TypeFixtures::TYPES){
                $activity->setType($this->getReference('type'.random_int(0, count(TypeFixtures::TYPES) -1)));
            }
            $activity->setDuration($faker->dateTimeBetween('now', '+1day'));
            $activity->setUser($this->getReference('user'.random_int(0, UserFixtures::USER_COUNT -1)));


            $manager->persist($activity);
        }

        $manager->flush();
    }

    public function getDependencies(){
        return[
            UserFixtures::class,
            TypeFixtures::class,
        ];
    }
}

/*
 $type2->setDistance(random_int(0, 70));
 $type2->setElevation(random_int(0, 70));
*/
