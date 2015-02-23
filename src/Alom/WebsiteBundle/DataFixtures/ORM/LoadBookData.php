<?php

namespace Alom\WebsiteBundle\DataFixtures\ORM;

use Alom\WebsiteBundle\Entity\Book;

use Doctrine\Common\DataFixtures\FixtureInterface;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Component\DependencyInjection\ContainerAwareInterface;
use Symfony\Component\DependencyInjection\ContainerInterface;


class LoadBookData implements FixtureInterface, OrderedFixtureInterface, ContainerAwareInterface
{
    /**
     * @var Symfony\Component\DependencyInjection\ContainerInterface
     */
    private $container;

    public function load(ObjectManager $manager)
    {
        $book = new Book();
        $book->setTitle('Disabled book');
        $book->setSlug('disabled-book');
        $book->setReadAt(new \DateTime('2011-10-10'));
        $book->setDescription('Description of the disabled book');
        $book->disable();
        $manager->persist($book);

        $book = new Book();
        $book->setTitle('Enabled book');
        $book->setSlug('enabled-book');
        $book->setReadAt(new \DateTime('2011-10-10'));
        $book->setDescription('Description of the enabled book');
        $book->enable();
        $manager->persist($book);

        $manager->flush();
    }

    public function getOrder()
    {
        return 1;
    }

    public function setContainer(ContainerInterface $container = null)
    {
        $this->container = $container;
    }
}
