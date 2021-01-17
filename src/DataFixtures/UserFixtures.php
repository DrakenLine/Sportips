<?php

namespace App\DataFixtures;

use App\Entity\User;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Faker\Factory;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

class UserFixtures extends Fixture
{

    const USER_COUNT = 40;
    private $userPasswordEncoder;

    public function __construct(UserPasswordEncoderInterface $userPasswordEncoder)
    {
        $this->userPasswordEncoder = $userPasswordEncoder;
    }

    public function load(ObjectManager $manager)
    {
        $faker = Factory::create('fr_FR');

        $password = $this->userPasswordEncoder->encodePassword(new User(), 'user');

        //ne pas oublier de créer un pro pour les articles

        $admin = new User();
        $admin->setMail('admin@mail.com');
        $admin->setFirstname('Super');
        $admin->setLastname('Administrateur');
        $admin->setCreatedAt(new \DateTime());
        $admin->setPassword($this->userPasswordEncoder->encodePassword($admin, 'admin'));
        $admin->setRole(['ROLE_ADMIN']);
        $manager->persist($admin);

        for ($i=0; $i < self::USER_COUNT; $i++) {
            $user = new User();
            $user->setMail($faker->email);
            $user->setFirstname($faker->firstName);
            $user->setLastname($faker->lastName);
            $user->setCreatedAt(new \DateTime());
            $user->setPassword($password);
            $this->addReference('user'.$i, $user);
            $manager->persist($user);
        }

        $manager->flush();
    }
}
