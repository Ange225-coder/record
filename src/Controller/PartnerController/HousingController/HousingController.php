<?php

    namespace App\Controller\PartnerController\HousingController;

    use Symfony\Component\HttpFoundation\Response;
    use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
    use Symfony\Component\Routing\Annotation\Route;

    class HousingController extends AbstractController
    {
        #[Route(path: '/partner/housing', name: 'partner_housing')]
        public function housing(): Response
        {
            return $this->render('partners/housing/housing.html.twig');
        }
    }