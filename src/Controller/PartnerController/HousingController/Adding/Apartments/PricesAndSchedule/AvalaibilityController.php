<?php

    namespace App\Controller\PartnerController\HousingController\Adding\Apartments\PricesAndSchedule;

    use App\Entity\Tables\Housing\HousingGeneralInfo;
    use App\Entity\Tables\Housing\HousingPriceAndSchedule;
    use App\Forms\Fields\Partners\Housing\Adding\Apartments\PricesAndSchedule\AvalaibilityFields;
    use App\Forms\Types\Partners\Housing\Adding\Apartments\PricesAndSchedule\AvalaibilityTypes;
    use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
    use Symfony\Component\HttpFoundation\Response;
    use Symfony\Component\HttpFoundation\Request;
    use Symfony\Component\Routing\Annotation\Route;
    use Doctrine\ORM\EntityManagerInterface;
    use Symfony\Component\HttpFoundation\Session\SessionInterface;

    class AvalaibilityController extends AbstractController
    {
        #[Route(path: '/partner/add/apartment/avalaibility/{housing_id}', name: 'avalaibility')]
        public function avalaibility(int $housing_id, EntityManagerInterface $entityManager, Request $request, SessionInterface $session): Response
        {
            //get apartment id
            $apartment_id = $entityManager->getRepository(HousingGeneralInfo::class)->find($housing_id);

            $avalaibilityFields = new AvalaibilityFields();
            $pricesAndScheduleEntity = new HousingPriceAndSchedule();

            $avalaibilityTypes = $this->createForm(AvalaibilityTypes::class, $avalaibilityFields);

            $avalaibilityTypes->handleRequest($request);

            //get all session's datas
            $howToReserve = $session->get('how_to_reserve');
            $pricePerNight = $session->get('price_per_night');

            if($avalaibilityTypes->isSubmitted() && $avalaibilityTypes->isValid()) {

                $pricesAndScheduleEntity->setHousingGeneralInfo($apartment_id);
                $pricesAndScheduleEntity->setHowToReserve($howToReserve);
                $pricesAndScheduleEntity->setPricePerNight($pricePerNight);
                $pricesAndScheduleEntity->setArrivalDate($avalaibilityFields->getArrivalDate());
                $pricesAndScheduleEntity->setAvalaibilitySynchronisation($avalaibilityFields->getAvalaibilitySynchronisation());
                $pricesAndScheduleEntity->setStayOfMoreThanThirtyNights($avalaibilityFields->getStayOfMoreThanThirtyNights());

                $entityManager->persist($pricesAndScheduleEntity);
                $entityManager->flush();

                return $this->redirectToRoute('revision_and_finalization', ['housing_id' => $housing_id]);
            }

            return $this->render('partners/housing/adding/apartments/pricesAndSchedule/avalaibility.html.twig', [
                'avalaibilityForm' => $avalaibilityTypes->createView(),
            ]);
        }
    }