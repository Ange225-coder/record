<?php

    namespace App\Controller\PartnerController\HousingController\Adding\Apartments\GeneralInfos;

    use App\Forms\Fields\Partners\Housing\Adding\Apartments\GeneralInfos\ApartmentNameFields;
    use App\Forms\Types\Partners\Housing\Adding\Apartments\GeneralInfos\ApartmentNameTypes;
    use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
    use Symfony\Component\HttpFoundation\Request;
    use Symfony\Component\HttpFoundation\Response;
    use Symfony\Component\HttpFoundation\Session\Session;
    use Symfony\Component\Routing\Annotation\Route;

    class ApartmentNameController extends AbstractController
    {
        #[Route(path: '/partner/add/apartment-name', name: 'apartment_name')]
        public function apartmentName(Request $request, Session $session): Response
        {
            $apartmentNameFields = new ApartmentNameFields();

            $apartmentNameTypes = $this->createForm(ApartmentNameTypes::class, $apartmentNameFields);

            $apartmentNameTypes->handleRequest($request);

            if($apartmentNameTypes->isSubmitted() && $apartmentNameTypes->isValid()) {

                $session->set('apartmentName', $apartmentNameFields->getApartmentName());

                return $this->redirectToRoute('apartment_place');
            }

            return $this->render('partners/housing/adding/apartments/generalInfos/apartmentName.html.twig', [
                'apartmentNameForm' => $apartmentNameTypes->createView(),
            ]);
        }
    }