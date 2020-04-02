<?php

namespace App\DataFixtures;

use App\Entity\User;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;


class UserFixtures extends Fixture
{
    private $passwordEncoder;
    public function __construct(UserPasswordEncoderInterface $passwordEncoder)
    {
        $this->passwordEncoder = $passwordEncoder;
    }

    public function load(ObjectManager $manager)
    {
        $user = new User();
        $user->setEmail("user@user.fr")
            ->setPassword($this->passwordEncoder->encodePassword($user, 'user'))
            ->setPasswordConfirm($this->passwordEncoder->encodePassword($user, 'user'))
            ->setNom("DENIS")
            ->setPrenom("Jean")
            ->setPseudo("Jeeaann")
            ->setSexe("Homme")
            ->setAnneeNaissance(new \DateTime(1997-01-01));
        $manager->persist($user);

        $admin = new User();
        $admin->setEmail("admin@admin.fr")
        ->setPassword($this->passwordEncoder->encodePassword($user, 'admin'))
        ->setPasswordConfirm($this->passwordEncoder->encodePassword($user, 'admin'))
        ->setRoles(['ROLE_ADMIN'])
        ->setNom("SACHOT")
        ->setPrenom("Pierre")
        ->setPseudo("pierre_s")
        ->setSexe("Homme")
        ->setAnneeNaissance(new \DateTime(1995-01-01));
        $manager->persist($admin);

        $manager->flush();

    }
}