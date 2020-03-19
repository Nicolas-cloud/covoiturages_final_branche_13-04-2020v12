<?php
namespace App\DataFixtures;

use App\Entity\Reservation;
use App\Entity\Trajet;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use Doctrine\ORM\EntityManagerInterface;

class TrajetFixtures extends Fixture implements DependentFixtureInterface
{

    /**
     * @param ObjectManager $manager
     * @return void
     * @throws \Exception
     */
    public function load(ObjectManager $manager): void
    {
        $trajet1 = new Trajet();
        $description = <<< _lorem
Le Lorem Ipsum est simplement du faux texte employé dans la composition et la mise en page avant impression. Le Lorem Ipsum est le faux texte standard de l'imprimerie depuis les années 1500, quand un imprimeur anonyme assembla ensemble des morceaux de texte pour réaliser un livre spécimen de polices de texte. Il n'a pas fait que survivre cinq siècles, mais s'est aussi adapté à la bureautique informatique, sans que son contenu n'en soit modifié. Il a été popularisé dans les années 1960 grâce à la vente de feuilles Letraset contenant des passages du Lorem Ipsum, et, plus récemment, par son inclusion dans des applications de mise en page de texte, comme Aldus PageMaker.
_lorem;
        $trajet1->setDateCreation(new \DateTime(2020-01-01))
            ->setDateModification(new \DateTime(2020-01-01))
            ->setDescription($description)
            ->setHeureArrivee(new \DateTime('17:40:00'))
            ->setHeureDepart(new \DateTime('13:40:00'))
            ->setNbPlaces(2)
            ->setPrix(20)
            ->setVilleArrivee("Paris")
            ->setVilleDepart("Nantes");
        $manager->persist($trajet1);
        

        $trajet2 = new Trajet();
        $description = <<< _lorem
test description trajet numéro2
_lorem;
        $trajet2->setDateCreation(new \DateTime(2020-03-07))
            ->setDateModification(new \DateTime(2020-03-07))
            ->setDescription($description)
            ->setHeureArrivee(new \DateTime('07:20:00'))
            ->setHeureDepart(new \DateTime('11:20:00'))
            ->setNbPlaces(2)
            ->setPrix(10)
            ->setVilleArrivee("Marseille")
            ->setVilleDepart("Lyon")
            ->setDateExpiration(new \DateTime('-30 days'));
        $manager->persist($trajet2);

        $trajet3 = new Trajet();
        $description = <<< _lorem
numéro 3
_lorem;
        $trajet3->setDateCreation(new \DateTime(2020-03-07))
            ->setDateModification(new \DateTime(2020-03-07))
            ->setDescription($description)
            ->setHeureArrivee(new \DateTime('07:20:00'))
            ->setHeureDepart(new \DateTime('11:20:00'))
            ->setNbPlaces(4)
            ->setPrix(15)
            ->setVilleArrivee("Toulouse")
            ->setVilleDepart("Montpellier")
            ->setDateExpiration(new \DateTime('+90 days'));
        $manager->persist($trajet3);

        $manager->flush();
    }

    /**
     * @return array
     */
    public function getDependencies(): array
    {
        return [
            ReservationFixtures::class,
            AvisFixtures::class,
        ];
    }
}
