<?php

    namespace App\Controller\PartnerController\HousingController\Admin;

    use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
    use Symfony\Component\HttpFoundation\Response;
    use Symfony\Component\Routing\Annotation\Route;

    class HousingDetailsController extends AbstractController
    {
        #[Route(path: '/partner/admin/housing-details/{housing_id}', name: 'partner_admin_housing_details')]
        public function housingDetails(int $housing_id): Response
        {
            return $this->render('partners/housing/admin/housingDetails.html.twig');
        }
    }