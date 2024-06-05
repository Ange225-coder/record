<?php

    namespace App\Controller\PartnerController\HousingController\Adding\Apartments\PricesAndSchedule;

    use Symfony\Component\HttpFoundation\Response;
    use Symfony\Component\HttpFoundation\Request;
    use Symfony\Component\HttpFoundation\Session\SessionInterface;
    use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
    use Symfony\Component\Routing\Annotation\Route;
    use App\Forms\Fields\Partners\Housing\Adding\Apartments\PricesAndSchedule\HowToReserveFields;
    use App\Forms\Types\Partners\Housing\Adding\Apartments\PricesAndSchedule\HowToReserveTypes;

    class HowToReserveController extends AbstractController
    {
        #[Route(path: '/partner/add/apartment-rec-res/{housing_id}', name: 'how_receive_reservation')]
        public function howToReserve(int $housing_id, SessionInterface $session, Request $request): Response
        {
            $howReserveFields = new HowToReserveFields();

            $howReserveTypes = $this->createForm(HowToReserveTypes::class, $howReserveFields);

            $howReserveTypes->handleRequest($request);

            if($howReserveTypes->isSubmitted() && $howReserveTypes->isValid()) {

                $session->set('how_to_reserve', $howReserveFields->getHowToReserve());

                return $this->redirectToRoute('price_per_night', ['housing_id' => $housing_id]);
            }

            return $this->render('partners/housing/adding/apartments/pricesAndSchedule/howToReserve.html.twig', [
                'howToReserveForm' => $howReserveTypes->createView(),
            ]);
        }
    }