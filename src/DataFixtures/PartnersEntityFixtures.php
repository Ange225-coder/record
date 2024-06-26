<?php

    namespace App\DataFixtures;

    use Doctrine\Bundle\FixturesBundle\Fixture;
    use Doctrine\Persistence\ObjectManager;
    use App\Entity\Tables\Partners\Partner;
    use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;
    use Doctrine\Bundle\FixturesBundle\FixtureGroupInterface;

    class PartnersEntityFixtures extends Fixture implements FixtureGroupInterface
    {
        private UserPasswordHasherInterface $passwordHasher;

        public function __construct(UserPasswordHasherInterface $passwordHasher)
        {
            $this->passwordHasher = $passwordHasher;
        }


        public function load(ObjectManager $manager): void
        {
            for ($p=1; $p<=7; $p++) {

                $partner = new Partner();
                $partner->setEmail('partner-'.$p.'@free.fr');
                $partner->setFirstName('emma-'.$p);
                $partner->setLastName('ouattara-'.$p);
                $partner->setContact('225010203040'.$p);
                $partner->setPassword($this->passwordHasher->hashPassword($partner, 'partnerpartner'.$p));
                $partner->setRoles(['ROLE_PARTNER']);

                $manager->persist($partner);
            }

            $manager->flush();
        }


        public static function getGroups(): array
        {
            return ['partners'];
        }
    }