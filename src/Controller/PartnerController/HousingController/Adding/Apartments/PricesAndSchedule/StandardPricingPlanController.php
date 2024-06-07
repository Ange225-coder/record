<?php

    namespace App\Controller\PartnerController\HousingController\Adding\Apartments\PricesAndSchedule;

    use App\Entity\Tables\Housing\HousingGeneralInfo;
    use App\Entity\Tables\Housing\HousingPriceAndSchedule;
    use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
    use Symfony\Component\HttpFoundation\Response;
    use Symfony\Component\Routing\Annotation\Route;
    use Doctrine\ORM\EntityManagerInterface;

    class StandardPricingPlanController extends AbstractController
    {
        #[Route(path: '/partner/add/apartment/standard-plan/{housing_id}', name: 'standard_pricing_plan')]
        public function standardPricing(int $housing_id, EntityManagerInterface $entityManager): Response
        {
            $id = $entityManager->getRepository(HousingGeneralInfo::class)->find($housing_id);
            $housing_id = $id->getHousingId();

            return $this->render('partners/housing/adding/apartments/pricesAndSchedule/standardPricingPlan.html.twig', [
                'id' => $housing_id,
            ]);
        }
    }