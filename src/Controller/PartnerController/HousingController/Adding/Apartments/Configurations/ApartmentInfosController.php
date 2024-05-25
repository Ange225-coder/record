<?php

    namespace App\Controller\PartnerController\HousingController\Adding\Apartments\Configurations;

    use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
    use Symfony\Component\Form\FormError;
    use Symfony\Component\HttpFoundation\Response;
    use Symfony\Component\Routing\Annotation\Route;
    use App\Forms\Fields\Partners\Housing\Adding\Apartments\Configurations\ApartmentInfoFields;
    use App\Forms\Types\Partners\Housing\Adding\Apartments\Configurations\ApartmentInfoTypes;
    use Symfony\Component\HttpFoundation\Session\Session;
    use Symfony\Component\HttpFoundation\Request;

    class ApartmentInfosController extends AbstractController
    {
        #[Route(path: '/partner/add/apartment-info', name: 'apartment_info')]
        public function apartmentInfos(Request $request, Session $session): Response
        {
            $apartmentInfoFields = new ApartmentInfoFields();
            $apartmentInfoFields->setHousingArea(null);

            $apartmentInfoTypes = $this->createForm(ApartmentInfoTypes::class, $apartmentInfoFields);

            $apartmentInfoTypes->handleRequest($request);

            if($apartmentInfoTypes->isSubmitted() && $apartmentInfoTypes->isValid()) {

                if($apartmentInfoFields->getHousingArea() >= 1 || $apartmentInfoFields->getHousingArea() === null) {
                    $session->set('where_to_sleep', $apartmentInfoFields->getWhereToSleep());
                    $session->set('people_can_stay', $apartmentInfoFields->getPeopleCanStay());
                    $session->set('number_of_bathroom', $apartmentInfoFields->getNumberOfBathroom());
                    $session->set('kids_is_accept', $apartmentInfoFields->getKidsIsAccept());
                    $session->set('baby_bed', $apartmentInfoFields->getBabyBed());
                    $session->set('housing_area', $apartmentInfoFields->getHousingArea());
                }
                else {
                    $apartmentInfoTypes->get('housingArea')->addError(new FormError('Veuillez indiquer la superficie de l\'hébergement'));
                }

                return $this->redirectToRoute('apartment_equipments');
            }

            return $this->render('/partners/housing/adding/apartments/configurations/apartmentInfo.html.twig', [
                'apartmentInfoForm' => $apartmentInfoTypes->createView(),
            ]);
        }
    }