<?php

    namespace App\Controller\PartnerController\HousingController\Adding\Apartments\Configurations;

    use App\Forms\Fields\Partners\Housing\Adding\Apartments\Configurations\ApartmentProfilFields;
    use App\Forms\Types\Partners\Housing\Adding\Apartments\Configurations\ApartmentProfilTypes;
    use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
    use Symfony\Component\HttpFoundation\Response;
    use Symfony\Component\Routing\Annotation\Route;
    use Symfony\Component\HttpFoundation\Request;
    use Symfony\Component\HttpFoundation\Session\Session;

    class ApartmentProfilController extends AbstractController
    {
        #[Route(path: '/partner/add/apartment-profil/{housing_id}', name: 'apartment_profil')]
        public function apartmentProfil(int $housing_id, Session $session, Request $request): Response
        {
            $apartmentProfilFields = new ApartmentProfilFields();

            $apartmentProfilTypes = $this->createForm(ApartmentProfilTypes::class, $apartmentProfilFields);

            $apartmentProfilTypes->handleRequest($request);

            if($apartmentProfilTypes->isSubmitted() && $apartmentProfilTypes->isValid()) {

                $session->set('apartment_profil', $apartmentProfilFields->getProfil());

                return $this->redirectToRoute('pictures', ['housing_id' => $housing_id]);
            }

            return $this->render('partners/housing/adding/apartments/configurations/apartmentProfil.html.twig', [
                'apartmentProfilForm' => $apartmentProfilTypes->createView(),
            ]);
        }
    }