<?php

    namespace App\Controller\PartnerController\HousingController\Adding\Apartments\PricesAndSchedule;

    use App\Entity\Tables\Housing\HousingGeneralInfo;
    use App\Entity\Tables\Housing\HousingPictures;
    use Symfony\Component\HttpFoundation\Response;
    use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
    use Symfony\Component\Routing\Annotation\Route;
    use Doctrine\ORM\EntityManagerInterface;

    class HowToReceiveReservationController extends AbstractController
    {
        #[Route(path: '/partner/add/apartment-rec-res/{housing_id}', name: 'how_receive_reservation')]
        public function howToReceiveReservation(int $housing_id, EntityManagerInterface $entityManager): Response
        {
            //get pictures saves
            $pictures = $entityManager->getRepository(HousingPictures::class)->findBy([
                'housingGeneralInfo' => $housing_id,
            ]);



            return $this->render('partners/housing/adding/apartments/pricesAndSchedule/howToReceiveReservations.html.twig', [
                'img' => $pictures,
            ]);
        }
    }