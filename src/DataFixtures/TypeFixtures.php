<?php

namespace App\DataFixtures;

use App\Entity\TypeOfActivity;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Faker\Factory;

class TypeFixtures extends Fixture
{
    const TYPESKM = [
        "Course",
        "Cyclism",
        "Randonnée",
        "Natation",
        "Roller",

    ];

    const TYPES = [
        "Musculation/Fitness",
        "Equitation",
        "Escalade",
        "Surf"
    ];

    public function load(ObjectManager $manager)
    {
        $i = 0;
        foreach (self::TYPES as $typeName){
            $type = new TypeOfActivity();
            $type->setName($typeName);
            $manager->persist($type);
            $this->addReference('type'.$i, $type);
            $i++;
        }

        $y = 0;
        foreach (self::TYPESKM as $typeKmName){
            $type2 = new TypeOfActivity();
            $type2->setName($typeKmName);
            $type2->setDistance(1);
            $type2->setElevation(1);
            $manager->persist($type2);
            $this->addReference('type2'.$y, $type2);
            $y++;
        }

        $manager->flush();
    }
}
