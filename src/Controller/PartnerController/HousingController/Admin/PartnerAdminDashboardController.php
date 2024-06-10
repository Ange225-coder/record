<?php

    namespace App\Controller\PartnerController\HousingController\Admin;

    use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
    use Symfony\Component\HttpFoundation\Response;
    use Symfony\Component\Routing\Annotation\Route;

    class PartnerAdminDashboardController extends AbstractController
    {
        #[Route(path: '/partner/admin/home', name: 'partner_admin_home')]
        public function partnerAdminDashboard(): Response
        {
            return $this->render('partners/housing/admin/partnerAdminDashboard.html.twig');
        }
    }