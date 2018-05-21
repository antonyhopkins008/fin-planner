<?php

namespace App\DataFixtures;

use App\Entity\User;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

class UsersFixtures extends Fixture
{
    /**
     * @var UserPasswordEncoderInterface
     */
    private $encoder;
    public const ADMIN_USER_REFERENCE = 'admin-user';

    /**
     * {@inheritDoc}
     */
    public function __construct(UserPasswordEncoderInterface $encoder)
    {
        $this->encoder = $encoder;
    }

    /**
     * {@inheritDoc}
     */
    public function load(ObjectManager $manager)
    {
        $password = 'test';

        $user = new User();
        $user->setUsername('superadmin');
        $user->setEmail('superadmin@example.com');
        $user->setIsActive(true);

        $pass = $this->encoder->encodePassword($user, $password);
        $user->setPassword($pass);

        $manager->persist($user);

        $this->setReference(self::ADMIN_USER_REFERENCE, $user);

        $manager->flush();
    }
}
