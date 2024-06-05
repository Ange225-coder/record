<?php

    namespace App\Controller\PartnerController\HousingController\Adding\Apartments\PricesAndSchedule;

    use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
    use Symfony\Component\HttpFoundation\Response;
    use Symfony\Component\HttpFoundation\Request;
    use Symfony\Component\HttpFoundation\Session\SessionInterface;
    use Symfony\Component\Routing\Annotation\Route;
    use App\Forms\Fields\Partners\Housing\Adding\Apartments\PricesAndSchedule\PricePerNightFields;
    use App\Forms\Types\Partners\Housing\Adding\Apartments\PricesAndSchedule\PricePerNightTypes;

    class PricePerNightController extends AbstractController
    {
        #[Route(path: '/partner/add/apartment/p-p-n/{housing_id}', name: 'price_per_night')]
        public function pricePerNight(int $housing_id, SessionInterface $session, Request $request): Response
        {
            $pricePerNightFields = new PricePerNightFields();

            $pricePerNightTypes = $this->createForm(PricePerNightTypes::class, $pricePerNightFields);

            $pricePerNightTypes->handleRequest($request);

            if($pricePerNightTypes->isSubmitted() && $pricePerNightTypes->isValid()) {

                $session->set('price_per_night', $pricePerNightFields->getPricePerNight());

                return $this->redirectToRoute('standard_pricing_plan');
            }

            return $this->render('partners/housing/adding/apartments/pricesAndSchedule/pricePerNight.html.twig', [
                'pricePerNightForm' => $pricePerNightTypes->createView(),
            ]);
        }
    }