<?php

    namespace App\DataFixtures;

    use App\Entity\Tables\Housing\HousingPriceAndSchedule;
    use Doctrine\Bundle\FixturesBundle\Fixture;
    use App\Entity\Tables\Housing\HousingGeneralInfo;
    use Doctrine\Bundle\FixturesBundle\FixtureGroupInterface;
    use Doctrine\Persistence\ObjectManager;

    class HousingPriceAndScheduleEntityFixture extends Fixture implements FixtureGroupInterface
    {
        public function load(ObjectManager $manager): void
        {
            $housingGeneralInfo = $manager->getRepository(HousingGeneralInfo::class)->findAll();

            foreach ($housingGeneralInfo as $hgi) {
                $housingPriceAndSchedule = new HousingPriceAndSchedule();
                $housingPriceAndSchedule->setHowToReserve('réserver instantanément');
                $housingPriceAndSchedule->setPricePerNight(90000);
                $housingPriceAndSchedule->setArrivalDate('dès que possible');
                $housingPriceAndSchedule->setAvalaibilitySynchronisation('Ne pas synchroniser');
                $housingPriceAndSchedule->setStayOfMoreThanThirtyNights('non');
                $housingPriceAndSchedule->setHousingGeneralInfo($hgi);

                $manager->persist($housingPriceAndSchedule);
            }

            $manager->flush();
        }


        public static function getGroups(): array
        {
            return ['housingPriceAndSchedule'];
        }
    }