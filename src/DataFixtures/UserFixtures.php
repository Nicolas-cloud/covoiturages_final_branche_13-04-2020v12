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
        $user->setEmail("user1@user.fr")
            ->setPassword($this->passwordEncoder->encodePassword($user, 'useruser'))
            ->setPasswordConfirm($this->passwordEncoder->encodePassword($user, 'useruser'))
            ->setNom("DENIS")
            ->setPrenom("Jean")
            ->setPseudo("Jeeaann")
            ->setSexe("Homme")
            ->setAnneeNaissance(new \DateTime(1997-01-01));
        $manager->persist($user);


        $user = new User();
        $user->setEmail("user2@user.fr")
            ->setPassword($this->passwordEncoder->encodePassword($user, 'useruser'))
            ->setPasswordConfirm($this->passwordEncoder->encodePassword($user, 'useruser'))
            ->setNom("DENIS")
            ->setPrenom("Jean")
            ->setPseudo("Jeeaann")
            ->setSexe("Homme")
            ->setAnneeNaissance(new \DateTime(1997-01-01));
        $manager->persist($user);

                $user = new User();
        $user->setEmail("user3@user.fr")
            ->setPassword($this->passwordEncoder->encodePassword($user, 'useruser'))
            ->setPasswordConfirm($this->passwordEncoder->encodePassword($user, 'useruser'))
            ->setNom("DENIS")
            ->setPrenom("Jean")
            ->setPseudo("Jeeaann")
            ->setSexe("Homme")
            ->setAnneeNaissance(new \DateTime(1997-01-01));
        $manager->persist($user);

                $user = new User();
        $user->setEmail("user4@user.fr")
            ->setPassword($this->passwordEncoder->encodePassword($user, 'useruser'))
            ->setPasswordConfirm($this->passwordEncoder->encodePassword($user, 'useruser'))
            ->setNom("DENIS")
            ->setPrenom("Jean")
            ->setPseudo("Jeeaann")
            ->setSexe("Homme")
            ->setAnneeNaissance(new \DateTime(1997-01-01));
        $manager->persist($user);

                $user = new User();
        $user->setEmail("user5@user.fr")
            ->setPassword($this->passwordEncoder->encodePassword($user, 'useruser'))
            ->setPasswordConfirm($this->passwordEncoder->encodePassword($user, 'useruser'))
            ->setNom("DENIS")
            ->setPrenom("Jean")
            ->setPseudo("Jeeaann")
            ->setSexe("Homme")
            ->setAnneeNaissance(new \DateTime(1997-01-01));
        $manager->persist($user);

                        $user = new User();
        $user->setEmail("user6@user.fr")
            ->setPassword($this->passwordEncoder->encodePassword($user, 'useruser'))
            ->setPasswordConfirm($this->passwordEncoder->encodePassword($user, 'useruser'))
            ->setNom("DENIS")
            ->setPrenom("Jean")
            ->setPseudo("Jeeaann")
            ->setSexe("Homme")
            ->setAnneeNaissance(new \DateTime(1997-01-01));
        $manager->persist($user);

                        $user = new User();
        $user->setEmail("user7@user.fr")
            ->setPassword($this->passwordEncoder->encodePassword($user, 'useruser'))
            ->setPasswordConfirm($this->passwordEncoder->encodePassword($user, 'useruser'))
            ->setNom("DENIS")
            ->setPrenom("Jean")
            ->setPseudo("Jeeaann")
            ->setSexe("Homme")
            ->setAnneeNaissance(new \DateTime(1997-01-01));
        $manager->persist($user);

                        $user = new User();
        $user->setEmail("user8@user.fr")
            ->setPassword($this->passwordEncoder->encodePassword($user, 'useruser'))
            ->setPasswordConfirm($this->passwordEncoder->encodePassword($user, 'useruser'))
            ->setNom("DENIS")
            ->setPrenom("Jean")
            ->setPseudo("Jeeaann")
            ->setSexe("Homme")
            ->setAnneeNaissance(new \DateTime(1997-01-01));
        $manager->persist($user);

                        $user = new User();
        $user->setEmail("user9@user.fr")
            ->setPassword($this->passwordEncoder->encodePassword($user, 'useruser'))
            ->setPasswordConfirm($this->passwordEncoder->encodePassword($user, 'useruser'))
            ->setNom("DENIS")
            ->setPrenom("Jean")
            ->setPseudo("Jeeaann")
            ->setSexe("Homme")
            ->setAnneeNaissance(new \DateTime(1997-01-01));
        $manager->persist($user);

                        $user = new User();
        $user->setEmail("user10@user.fr")
            ->setPassword($this->passwordEncoder->encodePassword($user, 'useruser'))
            ->setPasswordConfirm($this->passwordEncoder->encodePassword($user, 'useruser'))
            ->setNom("DENIS")
            ->setPrenom("Jean")
            ->setPseudo("Jeeaann")
            ->setSexe("Homme")
            ->setAnneeNaissance(new \DateTime(1997-01-01));
        $manager->persist($user);

        $admin = new User();
        $admin->setEmail("admin@admin.fr")
        ->setPassword($this->passwordEncoder->encodePassword($user, 'adminadmin'))
        ->setPasswordConfirm($this->passwordEncoder->encodePassword($user, 'adminadmin'))
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