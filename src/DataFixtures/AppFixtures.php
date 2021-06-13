<?php

namespace App\DataFixtures;

use App\Entity\User;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

class AppFixtures extends Fixture
{

    private $encoder;

    public function __construct(UserPasswordEncoderInterface $encoder)
    {
        $this->encoder = $encoder;
    }

    public function load(ObjectManager $manager)
    {
		
		$admin = new User();
        $admin->setUsername('admin');
        $admin_pass = $this->encoder->encodePassword($admin, '1.admin.1');
        $admin->setPassword($admin_pass);
        $admin->setEmail('admin@gmail.com');
        $admin->setIsActive('1');
        $admin->setRoles("ROLE_ADMIN");
        $manager->persist($admin);

        $korisnik = new User();
        $korisnik->setUsername('korisnik');
        $korisnik_pass = $this->encoder->encodePassword($korisnik, 'korisnik123');
        $korisnik->setPassword($korisnik_pass);
        $korisnik->setEmail('korisnik@gmail.com');
        $korisnik->setIsActive('1');
        $korisnik->setRoles("ROLE_ADMIN");
        $manager->persist($korisnik);


        $manager->flush();
    }
}
