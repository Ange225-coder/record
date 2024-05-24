<?php

    namespace App\Controller\PartnerController\HousingController\Adding\Apartments\GeneralInfos;

    use App\Entity\Tables\Housing\HousingGeneralInfo;
    use Doctrine\ORM\EntityManagerInterface;
    use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
    use Symfony\Component\HttpFoundation\Response;
    use Symfony\Component\HttpFoundation\Session\Session;
    use Symfony\Component\Routing\Annotation\Route;

    class ApartmentMapController extends AbstractController
    {
        #[Route(path: '/partner/add/apartment-map', name: 'apartment_map')]
        public function apartmentMap(Session $session): Response
        {
            return $this->render('partners/housing/adding/apartments/generalInfos/apartmentMap.html.twig');
        }


        #[Route(path: '/partner/save/apartment', name: 'save_apartment', methods: ['POST'])]
        public function saveApartmentInfo(EntityManagerInterface $entityManager, Session $session): Response
        {
            $numberOfApartment = $session->get('an_apartment');
            $apartmentAlreadyRegistered = $session->get('apartment_already_registered', []);
            $apartmentName = $session->get('apartmentName');
            $country = $session->get('apartment_country');
            $address = $session->get('apartment_address');
            $postalCode = $session->get('apartment_postalCode');
            $town = $session->get('apartment_town');
            $partner = $this->getUser()->getUserIdentifier();

            $apartmentInfo = new HousingGeneralInfo();

            $apartmentInfo->setHousingChoice($numberOfApartment);
            $apartmentInfo->setHousingAlreadyRegistered($apartmentAlreadyRegistered);
            $apartmentInfo->setHousingName($apartmentName);
            $apartmentInfo->setHousingCountry($country);
            $apartmentInfo->setHousingAddress($address);
            if($postalCode !== null) {
                $apartmentInfo->setPostalCode($postalCode);
            }

            $apartmentInfo->setHousingTown($town);
            $apartmentInfo->setPartner($partner);

            $entityManager->persist($apartmentInfo);
            $entityManager->flush();

            return $this->redirectToRoute('apartment_info');
        }
    }