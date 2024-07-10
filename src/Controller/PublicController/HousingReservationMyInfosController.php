<?php

    namespace App\Controller\PublicController;

    use App\Entity\Tables\Housing\HousingConfigurations;
    use App\Entity\Tables\Housing\HousingGeneralInfo;
    use App\Entity\Tables\Housing\HousingPriceAndSchedule;
    use App\Entity\Tables\Partners\Reservations;
    use App\Forms\Fields\Public\Housing\HousingReservationMyInfosFields;
    use App\Forms\Types\Public\Housing\HousingReservationMyInfoTypes;
    use Symfony\Component\HttpFoundation\Response;
    use Symfony\Component\HttpFoundation\Request;
    use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
    use Symfony\Component\Routing\Annotation\Route;
    use Doctrine\ORM\EntityManagerInterface;
    use Symfony\Component\HttpFoundation\Session\SessionInterface;

    class HousingReservationMyInfosController extends AbstractController
    {
        #[Route(path: '/reservation/{housing_id}/my-infos', name: 'reservation_my_infos')]
        public function reservationMyInfos(int $housing_id, EntityManagerInterface $entityManager, Request $request, SessionInterface $session): Response
        {
            $housingGeneralInfo = $entityManager->getRepository(HousingGeneralInfo::class)->find($housing_id);

            $housingConfig = $entityManager->getRepository(HousingConfigurations::class)->find($housingGeneralInfo->getHousingId());

            $housingPriceAndSchedule = $entityManager->getRepository(HousingPriceAndSchedule::class)->find($housingGeneralInfo->getHousingId());

            $reservationMyInfosFields = new HousingReservationMyInfosFields();
            $reservationMyInfosTypes = $this->createForm(HousingReservationMyInfoTypes::class, $reservationMyInfosFields);

            $reservationMyInfosTypes->handleRequest($request);

            if($reservationMyInfosTypes->isSubmitted() && $reservationMyInfosTypes->isValid()) {

                $session->set('housing_id', $housingGeneralInfo->getHousingId());
                $session->set('housing_choice', $housingGeneralInfo->getHousingChoice());
                $session->set('housing_name', $housingGeneralInfo->getHousingName());
                $session->set('housing_town', $housingGeneralInfo->getHousingTown());
                $session->set('housing_address', $housingGeneralInfo->getHousingAddress());
                $session->set('housing_price', $housingPriceAndSchedule->getPricePerNight());
                $session->set('client_first_name', $reservationMyInfosFields->getFirstName());
                $session->set('client_last_name', $reservationMyInfosFields->getLastName());
                if($this->getUser()) {
                    $session->set('client_email', $this->getUser()->getUserIdentifier());
                }
                else {
                    $session->set('client_email', $reservationMyInfosFields->getEmail());
                }

                /**
                 * reservation number manage
                 */
                $existingCode = $entityManager->getRepository(Reservations::class)->findAll();

                $reservationCodes = [];
                foreach ($existingCode as $codes) {
                    $reservationCodes[] = $codes->getReservationNumber();
                }

                do {
                    $reservationNumber = substr(str_shuffle('1234567890'), 0, 9);
                }
                while (in_array($reservationNumber, $reservationCodes));

                $session->set('reservation_number', $reservationNumber);
                $session->set('partner', $housingGeneralInfo->getPartner());

                return $this->redirectToRoute('reservation_last_step', ['housing_id' => $housingGeneralInfo->getHousingId()]);

            }

            return $this->render('public/housingReservationMyInfos.html.twig', [
                'housingGeneralInfo' => $housingGeneralInfo,
                'housingConfig' => $housingConfig,
                'housingPrice' => $housingPriceAndSchedule,
                'reservationInfoForm' => $reservationMyInfosTypes->createView(),
            ]);
        }
    }