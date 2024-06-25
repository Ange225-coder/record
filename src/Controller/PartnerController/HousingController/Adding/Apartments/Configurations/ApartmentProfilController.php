<?php

    namespace App\Controller\PartnerController\HousingController\Adding\Apartments\Configurations;

    use App\Entity\Tables\Housing\HousingConfigurations;
    use App\Entity\Tables\Housing\HousingGeneralInfo;
    use App\Forms\Fields\Partners\Housing\Adding\Apartments\Configurations\ApartmentProfilFields;
    use App\Forms\Types\Partners\Housing\Adding\Apartments\Configurations\ApartmentProfilTypes;
    use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
    use Symfony\Component\HttpFoundation\Response;
    use Symfony\Component\Routing\Annotation\Route;
    use Symfony\Component\HttpFoundation\Request;
    use Symfony\Component\HttpFoundation\Session\Session;
    use Doctrine\ORM\EntityManagerInterface;

    class ApartmentProfilController extends AbstractController
    {
        #[Route(path: '/partner/add/apartment-profil/{housing_id}', name: 'apartment_profil')]
        public function apartmentProfil(int $housing_id, Session $session, Request $request, EntityManagerInterface $entityManager): Response
        {
            /**
             * get current apartment based on his Id
             */
            $apartment_id = $entityManager->getRepository(HousingGeneralInfo::class)->find($housing_id);


            /**
             * get all sessions in the folder Configurations.
             *
             * all sessions from here will go into the database
             */
            $equipments = $session->get('equipments', []);
            $whereToSleep = $session->get('where_to_sleep');
            $peopleCanStay = $session->get('people_can_stay');
            $numberOfBathroom = $session->get('number_of_bathroom');
            $kidsIsAccept = $session->get('kids_is_accept');
            $babyBed = $session->get('baby_bed');
            $housingArea = $session->get('housing_area');
            $smoker = $session->get('smoker');
            $animalIsAccept = $session->get('animal_is_accept');
            $partyIsAccept = $session->get('party_is_accept');
            $lunch = $session->get('lunch');
            $carPark = $session->get('car_park');
            $languages = $session->get('languages', []);

            $apartmentProfilFields = new ApartmentProfilFields();

            $configurationEntity = new HousingConfigurations();

            $apartmentProfilTypes = $this->createForm(ApartmentProfilTypes::class, $apartmentProfilFields);

            $apartmentProfilTypes->handleRequest($request);

            if($apartmentProfilTypes->isSubmitted() && $apartmentProfilTypes->isValid()) {

                if($apartmentProfilFields->getApartmentDetails() !== null) {
                    $session->set('apartment_details', $apartmentProfilFields->getApartmentDetails());
                }
                else {
                    $session->set('apartment_details', null);
                }

                if($apartmentProfilFields->getAreaDetails() !== null) {
                    $session->set('area_details', $apartmentProfilFields->getAreaDetails());
                }
                else {
                    $session->set('area_details', null);
                }

                /**
                 * put values of sessions in database
                 */
                $configurationEntity->setHousingGeneralInfo($apartment_id);
                $configurationEntity->setWhereToSleep($whereToSleep);
                $configurationEntity->setPeopleCanStay($peopleCanStay);
                $configurationEntity->setNumberOfBathroom($numberOfBathroom);
                $configurationEntity->setKidsIsAccept($kidsIsAccept);
                $configurationEntity->setBabyBed($babyBed);
                $configurationEntity->setHousingArea($housingArea);
                $configurationEntity->setHomeEquipment($equipments);
                $configurationEntity->setLunch($lunch);
                $configurationEntity->setCarPark($carPark);
                $configurationEntity->setMyLanguage($languages);
                $configurationEntity->setSmoker($smoker);
                $configurationEntity->setAnimalIsAccept($animalIsAccept);
                $configurationEntity->setPartyIsAccept($partyIsAccept);
                $configurationEntity->setApartmentProfil($session->get('apartment_details'));
                $configurationEntity->setAreaProfil($session->get('area_details'));

                $entityManager->persist($configurationEntity);
                $entityManager->flush();

                return $this->redirectToRoute('pictures', ['housing_id' => $housing_id]);
            }

            return $this->render('partners/housing/adding/apartments/infra/apartmentProfil.html.twig', [
                'apartmentProfilForm' => $apartmentProfilTypes->createView(),
            ]);
        }
    }