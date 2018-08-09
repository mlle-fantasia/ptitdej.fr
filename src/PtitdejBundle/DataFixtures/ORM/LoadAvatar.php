<?php


namespace PtitdejBundle\DataFixtures\ORM;

use Doctrine\Common\DataFixtures\FixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use PtitdejBundle\Entity\Avatar;

class LoadAvatar implements FixtureInterface
{
    // Dans l'argument de la méthode load, l'objet $manager est l'EntityManager
    public function load(ObjectManager $manager)
    {


        $avatar = new Avatar();
        $avatar->setUrl('images/ane-cofe.png');
        $avatar->setAlt('avatar ane');
        $manager->persist($avatar);

        $avatar = new Avatar();
        $avatar->setUrl('images/avatar2.png');
        $avatar->setAlt('avatar noël');
        $manager->persist($avatar);

        $avatar = new Avatar();
        $avatar->setUrl('images/avatar-com.png');
        $avatar->setAlt('avatar dessin noir et blanc');
        $manager->persist($avatar);

        $avatar = new Avatar();
        $avatar->setUrl('images/boiresoncafe.png');
        $avatar->setAlt('avatar dessin');
        $manager->persist($avatar);

        $avatar = new Avatar();
        $avatar->setUrl('images/cafe-anime-manga.png');
        $avatar->setAlt('avatar manga1');
        $manager->persist($avatar);

        $avatar = new Avatar();
        $avatar->setUrl('images/cafe-dessin.png');
        $avatar->setAlt('avatar dessin illustrator');
        $manager->persist($avatar);

        $avatar = new Avatar();
        $avatar->setUrl('images/cafe-manga2.png');
        $avatar->setAlt('avatar manga2');
        $manager->persist($avatar);

        $avatar = new Avatar();
        $avatar->setUrl('images/cafe-popart.png');
        $avatar->setAlt('avatar pop art');
        $manager->persist($avatar);

        $avatar = new Avatar();
        $avatar->setUrl('images/cofe-chat.png');
        $avatar->setAlt('avatar chat');
        $manager->persist($avatar);

        $avatar = new Avatar();
        $avatar->setUrl('images/dessin.png');
        $avatar->setAlt('avatar dessin femme');
        $manager->persist($avatar);

        $avatar = new Avatar();
        $avatar->setUrl('images/femme-au-cafe.png');
        $avatar->setAlt('avatar silhouette de femme');
        $manager->persist($avatar);

        $avatar = new Avatar();
        $avatar->setUrl('images/homme-assis-cafe.png');
        $avatar->setAlt('avatar homme assis');
        $manager->persist($avatar);

        $avatar = new Avatar();
        $avatar->setUrl('images/la-fille-boit-du-café-dessinant.png');
        $avatar->setAlt('avatar fille en café');
        $manager->persist($avatar);

        $avatar = new Avatar();
        $avatar->setUrl('images/tache-cafe-monstre-01.png');
        $avatar->setAlt('avatar tache de café');
        $manager->persist($avatar);


        $manager->flush();
    }
}