<?php
namespace App\DataFixtures;

use App\Entity\Avis;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Component\Validator\Constraints\DateTime;

class AvisFixtures extends Fixture
{
    /**
     * @param ObjectManager $manager
     *
     * @return void
     */
    public function load(ObjectManager $manager) : void
    {
        $avis1 = new Avis();
        $avis1->setCommentaire("Trajet très agréable ")
            ->setDatePublication(new \DateTime('02-04-2019'));



        $manager->persist($avis1);

        $manager->flush();

        $this->addReference('avis-utilisateur', $avis1);

    }
}