<?php

    namespace App\Controller\PublicController;

    use App\Entity\Tables\Housing\HousingConfigurations;
    use App\Entity\Tables\Housing\HousingGeneralInfo;
    use App\Entity\Tables\Housing\HousingPriceAndSchedule;
    use Symfony\Component\HttpFoundation\Response;
    use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
    use Symfony\Component\Routing\Annotation\Route;
    use Doctrine\ORM\EntityManagerInterface;
    use App\Entity\Tables\Housing\HousingPictures;

    class HousingReservationChoiceController extends AbstractController
    {
        #[Route(path: '/reservation/{housing_id}', name: 'reservation')]
        public function reservationChoice(int $housing_id, EntityManagerInterface $entityManager): Response
        {
            $housingGeneralInfo = $entityManager->getRepository(HousingGeneralInfo::class)->find($housing_id);

            $housingPic = $entityManager->getRepository(HousingPictures::class)->find($housingGeneralInfo->getHousingId());

            $housingPrice = $entityManager->getRepository(HousingPriceAndSchedule::class)->find($housingGeneralInfo->getHousingId());

            $housingConfigurations = $entityManager->getRepository(HousingConfigurations::class)->find($housingGeneralInfo->getHousingId());

            return $this->render('public/housingReservation.html.twig', [
                'housingGeneralInfo' => $housingGeneralInfo,
                'housingPic' => $housingPic->getTeaserPic(),
                'housingPrice' => $housingPrice->getPricePerNight(),
                'housingConfig' => $housingConfigurations,
            ]);
        }
    }