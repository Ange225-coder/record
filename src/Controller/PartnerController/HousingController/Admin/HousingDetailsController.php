<?php

    namespace App\Controller\PartnerController\HousingController\Admin;

    use App\Entity\Tables\Housing\HousingFinalization;
    use App\Entity\Tables\Housing\HousingGeneralInfo;
    use App\Entity\Tables\Housing\HousingPictures;
    use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
    use Symfony\Component\HttpFoundation\Response;
    use Symfony\Component\Routing\Annotation\Route;
    use Doctrine\ORM\EntityManagerInterface;

    class HousingDetailsController extends AbstractController
    {
        #[Route(path: '/partner/admin/housing-details/{housing_id}', name: 'partner_admin_housing_details')]
        public function housingDetails(int $housing_id, EntityManagerInterface $entityManager): Response
        {
            $housing = $entityManager->getRepository(HousingGeneralInfo::class)->find($housing_id);

            //$allHousing

            $housingSave = $entityManager->getRepository(HousingFinalization::class)->findBy(
                [
                    'housingGeneralInfo' => $housing,
                    'partner' => $this->getUser()->getUserIdentifier()
                ]
            );

            $picturesSaves = $entityManager->getRepository(HousingPictures::class)->findBy([
                'housingGeneralInfo' => $housing,
            ]);

            return $this->render('partners/housing/admin/housingDetails.html.twig', [
                'housing_name' => $housing->getHousingName(),
                'housing_id' => $housing->getHousingId(),
                'housing_save' => $housingSave,
                'housing_pictures' => $picturesSaves,
            ]);
        }
    }