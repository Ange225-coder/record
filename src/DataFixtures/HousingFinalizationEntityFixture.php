<?php

    namespace App\DataFixtures;

    use App\Entity\Tables\Housing\HousingGeneralInfo;
    use Doctrine\Bundle\FixturesBundle\Fixture;
    use Doctrine\Bundle\FixturesBundle\FixtureGroupInterface;
    use App\Entity\Tables\Housing\HousingFinalization;
    use Doctrine\Persistence\ObjectManager;

    class HousingFinalizationEntityFixture extends Fixture implements FixtureGroupInterface
    {
        public function load(ObjectManager $manager): void
        {
            $housingGeneralInfo = $manager->getRepository(HousingGeneralInfo::class)->findAll();

            foreach ($housingGeneralInfo as $hgi) {
                $housingFinalization = new HousingFinalization();
                $housingFinalization->setFirstName('emma-'.$hgi->getHousingId());
                $housingFinalization->setLastName('ouattara-'.$hgi->getHousingId());
                $housingFinalization->setEmail('partner-'.$hgi->getHousingId().'@free.fr');
                $housingFinalization->setPhone('225010203040'.$hgi->getHousingId());
                $housingFinalization->setLocation('Ghana');
                $housingFinalization->setFirstAddress('Rue-B'.$hgi->getHousingId());
                $housingFinalization->setTown('Kumasi');
                $housingFinalization->setPartner('partner-'.$hgi->getHousingId().'@free.fr');
                $housingFinalization->setHousingGeneralInfo($hgi);

                $manager->persist($housingFinalization);
            }
            $manager->flush();
        }

        public static function getGroups(): array
        {
            return ['HousingFinalization'];
        }
    }