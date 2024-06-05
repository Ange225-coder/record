<?php

    namespace App\Controller\PartnerController\HousingController\Adding\Apartments\PricesAndSchedule;

    use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
    use Symfony\Component\HttpFoundation\Response;
    use Symfony\Component\HttpFoundation\Request;
    use Symfony\Component\HttpFoundation\Session\SessionInterface;
    use Symfony\Component\Routing\Annotation\Route;

    class StandardPricingPlanController extends AbstractController
    {
        #[Route(path: '/partner/add/apartment/standard-plan', name: 'standard_pricing_plan')]
        public function standardPricing(SessionInterface $session, Request $request): Response
        {
            return $this->render('partners/housing/adding/apartments/pricesAndSchedule/standardPricingPlan.html.twig');
        }
    }