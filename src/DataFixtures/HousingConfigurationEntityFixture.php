<?php

    namespace App\DataFixtures;

    use Doctrine\Bundle\FixturesBundle\Fixture;
    use Doctrine\Persistence\ObjectManager;
    use App\Entity\Tables\Housing\HousingConfigurations;
    use App\Entity\Tables\Housing\HousingGeneralInfo;
    use Doctrine\Bundle\FixturesBundle\FixtureGroupInterface;

    class HousingConfigurationEntityFixture extends Fixture implements FixtureGroupInterface
    {
        public function load(ObjectManager $manager): void
        {
            $housingGeneralInfos = $manager->getRepository(HousingGeneralInfo::class)->findAll();

            //for each entry in housingGeneralInfo set the entry in housingConfiguration
            foreach ($housingGeneralInfos as $hgi) {
                $housingConfiguration = new HousingConfigurations();
                $housingConfiguration->setWhereToSleep('chambre');
                $housingConfiguration->setPeopleCanStay(mt_rand(1, 3));
                $housingConfiguration->setNumberOfBathroom(mt_rand(1, 6));
                $housingConfiguration->setKidsIsAccept('oui');
                $housingConfiguration->setBabyBed('oui');
                //$housingConfiguration->setHousingArea();
                $housingConfiguration->setHomeEquipment(['climatisation', 'connexion-wifi']);
                $housingConfiguration->setLunch('non');
                $housingConfiguration->setCarPark('Oui, gratuitement');
                $housingConfiguration->setMyLanguage(['anglais', 'français']);
                $housingConfiguration->setSmoker('non');
                $housingConfiguration->setAnimalIsAccept('oui');
                $housingConfiguration->setPartyIsAccept('non');
                //$housingConfiguration->setApartmentProfil();
                //$housingConfiguration->setAreaProfil();
                $housingConfiguration->setHousingGeneralInfo($hgi);

                $manager->persist($housingConfiguration);
            }

            $manager->flush();
        }


        public static function getGroups(): array
        {
            return ['housingConfiguration'];
        }

    }