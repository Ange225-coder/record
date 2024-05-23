<?php

    namespace App\Controller\PartnerController\HousingController\Adding\Apartments;

    use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
    use Symfony\Component\HttpFoundation\Response;
    use Symfony\Component\HttpFoundation\Request;
    use Symfony\Component\Routing\Annotation\Route;
    use App\Forms\Fields\Partners\Housing\Adding\Apartments\NumberOfApartmentsFields;
    use App\Forms\Types\Partners\Housing\Adding\Apartments\NumberOfApartmentsTypes;
    use Symfony\Component\HttpFoundation\Session\Session;

    class NumbersOfApartmentsController extends AbstractController
    {
        #[Route(path: '/partner/add/apartment', name: 'partner_add_apartment')]
        public function numbersOfApartments(Request $request, Session $session): Response
        {
            $numberOfApartmentsFields = new NumberOfApartmentsFields();

            $numberOfApartmentsTypes = $this->createForm(NumberOfApartmentsTypes::class, $numberOfApartmentsFields);

            $numberOfApartmentsTypes->handleRequest($request);

            if($numberOfApartmentsTypes->isSubmitted() && $numberOfApartmentsTypes->isValid()) {

                if($numberOfApartmentsFields->getNumberOfApartment() === '1 appartement') {
                    $session->set('an_apartment', $numberOfApartmentsFields->getNumberOfApartment());

                    return $this->redirectToRoute('an_apartment_confirmation');
                }

                //if($numberOfApartmentsFields->getNumberOfApartment() === 'plu')
            }

            return $this->render('partners/housing/adding/apartments/numberOfApartment.html.twig', [
                'apartmentChoiceForm' => $numberOfApartmentsTypes->createView(),
            ]);
        }
    }