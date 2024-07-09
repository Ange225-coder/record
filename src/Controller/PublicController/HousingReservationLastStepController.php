<?php

    namespace App\Controller\PublicController;

    use App\Entity\Tables\Partners\Reservations;
    use Symfony\Component\HttpFoundation\Response;
    use Symfony\Component\HttpFoundation\Request;
    use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
    use Symfony\Component\Routing\Annotation\Route;
    use Symfony\Component\HttpFoundation\Session\SessionInterface;
    use Doctrine\ORM\EntityManagerInterface;
    use App\Forms\Fields\Public\Housing\HousingReservationLastStepFields;
    use App\Forms\Types\Public\Housing\HousingReservationLastStepTypes;

    class HousingReservationLastStepController extends AbstractController
    {
        #[Route(path: '/reservation/{housing_id}/last-step', name: 'reservation_last_step')]
        public function reservationLastStep(int $housing_id, SessionInterface $session, EntityManagerInterface $entityManager, Request $request): Response
        {
            $reservationLastStepFields = new HousingReservationLastStepFields();
            $reservationLastStepTypes = $this->createForm(HousingReservationLastStepTypes::class, $reservationLastStepFields);

            $reservationEntity = new Reservations();

            $housingId = $session->get('housing_id');
            $housingChoices = $session->get('housing_choice');
            $housingName = $session->get('housing_name');
            $housingTown = $session->get('housing_town');
            $housingAddress = $session->get('housing_address');
            $housingPrice = $session->get('housing_price');
            $clientFirstName = $session->get('client_first_name');
            $clientLastName = $session->get('client_last_name');
            $reservationNumber = $session->get('reservation_number');
            $partner = $session->get('partner');

            $reservationLastStepTypes->handleRequest($request);

            if($reservationLastStepTypes->isSubmitted() && $reservationLastStepTypes->isValid()) {

                $reservationEntity->setHousingId($housingId);
                $reservationEntity->setHousingChoice($housingChoices);
                $reservationEntity->setHousingName($housingName);
                $reservationEntity->setHousingTown($housingTown);
                $reservationEntity->setHousingAddress($housingAddress);
                $reservationEntity->setHousingPrice($housingPrice);
                $reservationEntity->setClientFirstName($clientFirstName);
                $reservationEntity->setClientLastName($clientLastName);
                $reservationEntity->setReservationNumber($reservationNumber);
                $reservationEntity->setPartner($partner);
                $reservationEntity->setReservationDate(new \DateTime());

                $entityManager->persist($reservationEntity);
                $entityManager->flush();

                //get reservation id after the flush
                $reservationId = $entityManager->getRepository(Reservations::class)->findOneBy([
                    'housingId' => $housing_id,
                ]);

                return $this->redirectToRoute('reservation_confirmation', [
                    'housing_id' => $housingId,
                    'reservation_id' => $reservationId->getId(),
                ]);
            }

            return $this->render('public/housingReservationLastStep.html.twig', [
                'reservationLastStepForm' => $reservationLastStepTypes->createView(),
            ]);
        }
    }