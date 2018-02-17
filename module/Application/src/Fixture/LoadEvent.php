<?php

namespace Application\Fixture;

use Application\Entity\Event;
use DateTime;
use Doctrine\Common\DataFixtures\FixtureInterface;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;

/**
 * Class LoadEvent
 * @package Application\Fixture
 */
class LoadEvent implements FixtureInterface, OrderedFixtureInterface
{
    /**
     * Load data fixtures with the passed EntityManager
     *
     * @param ObjectManager $manager
     */
    public function load(ObjectManager $manager)
    {
        $eventOne = new Event([
            'name' => 'Peça teatral Sítio do Pica-pau Amarelo',
            'description' => 'Enorme sucesso em todo o Brasil agora também em Curitiba',
            'location' => 'Mini Auditório PUC',
            'capacity' => 139,
            'ticketAmount' => 23.76,
            'showDate' => new DateTime()
        ]);

        $eventTwo = new Event([
            'name' => 'Musical o Rei Leão',
            'description' => 'O musical mais antigo em atividade no mundo agora está em Curitiba',
            'location' => 'Teatro Positivo',
            'capacity' => 1562,
            'ticketAmount' => 23.76,
            'showDate' => new DateTime()
        ]);

        $eventThree = new Event([
            'name' => 'Show Toquinho e Vinícius',
            'description' => 'Não sei o que cantam, mas ouvi falar muito...',
            'location' => 'Teatro Paiol',
            'capacity' => 800,
            'ticketAmount' => 23.76,
            'showDate' => new DateTime()
        ]);

        $manager->persist($eventOne);
        $manager->persist($eventTwo);
        $manager->persist($eventThree);
        $manager->flush();
    }

    /**
     * Get the order of this fixture
     *
     * @return integer
     */
    public function getOrder()
    {
        return 0;
    }
}
