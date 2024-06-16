<?php

    namespace App\Controller\PartnerController\HousingController\Admin;

    use App\Entity\Tables\Housing\HousingFinalization;
    use App\Entity\Tables\Housing\HousingGeneralInfo;
    use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
    use Symfony\Component\HttpFoundation\Response;
    use Symfony\Component\Routing\Annotation\Route;
    use Doctrine\ORM\EntityManagerInterface;

    class PartnerAdminDashboardController extends AbstractController
    {
        #[Route(path: '/partner/admin/home', name: 'partner_admin_home')]
        public function partnerAdminDashboard(EntityManagerInterface $entityManager): Response
        {
            $allHousing = $entityManager->getRepository(HousingGeneralInfo::class)->findBy(
                ['partner' => $this->getUser()->getUserIdentifier()],
                ['housingId' => 'DESC'],
            );

            $allHousingStatus = [];
            foreach ($allHousing as $housing_status) {

                $status = $entityManager->getRepository(HousingFinalization::class)->findBy(
                    ['housingGeneralInfo' => $housing_status->getHousingId()],
                );
                $allHousingStatus[$housing_status->getHousingId()] = $status;
            }

            return $this->render('partners/housing/admin/partnerAdminDashboard.html.twig', [
                'all_housing' => $allHousing,
                'housing_status' => $allHousingStatus,
            ]);
        }
    }