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

            $housingSave = $entityManager->getRepository(HousingGeneralInfo::class)->findBy(
                [
                    'partner' => $this->getUser()->getUserIdentifier()
                ]
            );

            //get the teaser pic for each housing
            $allHousings = $entityManager->getRepository(HousingGeneralInfo::class)->findAll();

            $allPictures = [];
            foreach ($allHousings as $house) {

                $pictures = $entityManager->getRepository(HousingPictures::class)->findBy([
                    'housingGeneralInfo' => $house->getHousingId(),
                ]);
                $allPictures[$house->getHousingId()] = $pictures;
            }

            return $this->render('partners/housing/admin/housingDetails.html.twig', [
                'housing_name' => $housing->getHousingName(),
                'housing_id' => $housing->getHousingId(),
                'housing_save' => $housingSave,
                'housing_pictures' => $allPictures,
            ]);
        }
    }