<?php

    namespace App\Controller\PartnerController\HousingController\Adding\Apartments\Configurations;

    use App\Forms\Fields\Partners\Housing\Adding\Apartments\Configurations\ApartmentRulesFields;
    use App\Forms\Types\Partners\Housing\Adding\Apartments\Configurations\ApartmentRulesTypes;
    use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
    use Symfony\Component\HttpFoundation\Response;
    use Symfony\Component\HttpFoundation\Request;
    use Symfony\Component\Routing\Annotation\Route;
    use Symfony\Component\HttpFoundation\Session\Session;

    class ApartmentRulesController extends AbstractController
    {
        #[Route(path: '/partner/add/apartment-rules/{housing_id}', name: 'apartment_rules')]
        public function apartmentRules(int $housing_id, Session $session, Request $request): Response
        {
            $apartmentRulesFields = new ApartmentRulesFields();

            $apartmentRulesTypes = $this->createForm(ApartmentRulesTypes::class, $apartmentRulesFields);

            $apartmentRulesTypes->handleRequest($request);

            if($apartmentRulesTypes->isSubmitted() && $apartmentRulesTypes->isValid()) {

                $session->set('smoker', $apartmentRulesFields->getSmoker());
                $session->set('animal_is_accept', $apartmentRulesFields->getAnimalIsAccept());
                $session->set('party_is_accept', $apartmentRulesFields->getPartyIsAccept());

                return $this->redirectToRoute('apartment_profil', ['housing_id' => $housing_id]);
            }

            return $this->render('partners/housing/adding/apartments/configurations/apartmentRules.html.twig', [
                'apartmentRulesForm' => $apartmentRulesTypes->createView(),
            ]);
        }
    }