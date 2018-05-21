<?php

namespace App\DataFixtures;

use App\Entity\Role;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;

class RolesFixtures extends Fixture implements DependentFixtureInterface
{
    public function load(ObjectManager $manager)
    {
        $roleSuperadmin = new Role();
        $roleSuperadmin->setName('Super Admin');
        $roleSuperadmin->setRole('ROLE_ADMIN');
        $manager->persist($roleSuperadmin);

        $roleUser = new Role();
        $roleUser->setName('User');
        $roleUser->setRole('ROLE_USER');
        $manager->persist($roleUser);

        $roleSuperadmin->addUser(
            $this->getReference(UsersFixtures::ADMIN_USER_REFERENCE)
        );

        $manager->flush();
    }

    public function getDependencies()
    {
        return array(
            UsersFixtures::class,
        );
    }
}
