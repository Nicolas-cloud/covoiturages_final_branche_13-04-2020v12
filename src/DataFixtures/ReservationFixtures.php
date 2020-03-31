<?php
namespace App\DataFixtures;


use App\Entity\Reservation;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;

class ReservationFixtures extends Fixture
{
    /**
     * @param ObjectManager $manager
     *
     * @return void
     */
    public function load(ObjectManager $manager) : void
    {
        $reservation1 = new Reservation();
        $reservation1->setDateReservation(new \DateTime('02-04-2020'))
            ->setValidation(true)
            ->setAnnulation(false);
        $manager->persist($reservation1);


        $manager->flush();

    }
}