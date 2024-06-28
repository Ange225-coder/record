<?php

    namespace App\DataFixtures;

    use Doctrine\Bundle\FixturesBundle\FixtureGroupInterface;
    use Doctrine\Bundle\FixturesBundle\Fixture;
    use App\Entity\Tables\Housing\HousingGeneralInfo;
    use Doctrine\Persistence\ObjectManager;

    class HousingGeneralInfoEntityFixture extends Fixture implements FixtureGroupInterface
    {
        public function load(ObjectManager $manager): void
        {
            for ($hgi=1; $hgi<=10; $hgi++) {

                $housingGeneralInfo = new HousingGeneralInfo();
                $housingGeneralInfo->setHousingChoice('1 appartement');
                $housingGeneralInfo->setHousingAlreadyRegistered(['Airbnb', 'Tripadvisor']);
                $housingGeneralInfo->setHousingName('housing-'.$hgi);
                $housingGeneralInfo->setHousingCountry('Ghana');
                $housingGeneralInfo->setHousingAddress('Rue B'.$hgi);
                //postal code here if necessary
                //$housingGeneralInfo->setPostalCode();
                $housingGeneralInfo->setHousingTown('Kumasi');
                $housingGeneralInfo->setPartner('partner-'.$hgi.'@free.fr');

                $manager->persist($housingGeneralInfo);
            }

            $manager->flush();
        }


        public static function getGroups(): array
        {
            return ['housingGeneralInfo'];
        }

    }