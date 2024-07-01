<?php

    namespace App\Controller\PartnerController\HousingController\Adding\Apartments\Configurations;

    use Symfony\Component\HttpFoundation\Response;
    use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
    use Symfony\Component\Routing\Annotation\Route;
    use Symfony\Component\HttpFoundation\Session\Session;
    use Symfony\Component\HttpFoundation\Request;
    use App\Forms\Fields\Partners\Housing\Adding\Apartments\Configurations\ApartmentServicesFields;
    use App\Forms\Types\Partners\Housing\Adding\Apartments\Configurations\ApartmentServicesTypes;

    class ApartmentServicesController extends AbstractController
    {
        #[Route(path: '/partner/add/apartment-services/{housing_id}', name: 'apartment_services')]
        public function apartmentServices(int $housing_id, Session $session, Request $request): Response
        {
            /**
             * how to get session which contain array in this 2nd option
             *
             * $equipments = $session->get('equipments', []);
             */
            $apartmentServicesFields = new ApartmentServicesFields();

            $apartmentServicesTypes = $this->createForm(ApartmentServicesTypes::class, $apartmentServicesFields);

            $apartmentServicesTypes->handleRequest($request);

            if($apartmentServicesTypes->isSubmitted() && $apartmentServicesTypes->isValid()) {

                $session->set('lunch', $apartmentServicesFields->getLunch());
                $session->set('car_park', $apartmentServicesFields->getCarPark());

                return $this->redirectToRoute('languages', ['housing_id' => $housing_id]);
            }

            return $this->render('partners/housing/adding/apartments/configurations/apartmentServices.html.twig', [
                'apartmentServicesForm' => $apartmentServicesTypes->createView(),
            ]);
        }
    }