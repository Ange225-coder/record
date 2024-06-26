<?php

    namespace App\DataFixtures;

    use Doctrine\Bundle\FixturesBundle\Fixture;
    use Doctrine\Persistence\ObjectManager;
    use App\Entity\Tables\Users\Users;
    use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;
    use Doctrine\Bundle\FixturesBundle\FixtureGroupInterface;

    class UsersEntityFixtures extends Fixture implements FixtureGroupInterface
    {
        private UserPasswordHasherInterface $passwordHasher;

        public function __construct(UserPasswordHasherInterface $passwordHasher)
        {
            $this->passwordHasher = $passwordHasher;
        }

        public function load(ObjectManager $manager): void
        {
            for ($u=1; $u<=15; $u++) {

                $user = new Users();
                $user->setEmail('user-'.$u.'@free.fr');
                $user->setPassword($this->passwordHasher->hashPassword($user, 'useruser2.0'.$u));
                $user->setRoles(['ROLE_USER']);

                $manager->persist($user);
            }

            $manager->flush();
        }

        public static function getGroups(): array
        {
            return ['users'];
        }
    }