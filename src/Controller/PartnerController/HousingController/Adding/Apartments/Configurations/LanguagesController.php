<?php

    namespace App\Controller\PartnerController\HousingController\Adding\Apartments\Configurations;

    use Symfony\Component\HttpFoundation\Response;
    use Symfony\Component\HttpFoundation\Session\Session;
    use Symfony\Component\HttpFoundation\Request;
    use Symfony\Component\Routing\Annotation\Route;
    use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
    use App\Forms\Fields\Partners\Housing\Adding\Apartments\Configurations\LanguagesFields;
    use App\Forms\Types\Partners\Housing\Adding\Apartments\Configurations\LanguagesTypes;

    class LanguagesController extends AbstractController
    {
        #[Route(path: '/partner/add/apartment/languages/{housing_id}', name: 'languages')]
        public function languages(int $housing_id, Session $session, Request $request): Response
        {
            $languagesFields = new LanguagesFields();

            $languagesTypes = $this->createForm(LanguagesTypes::class, $languagesFields);

            $languagesTypes->handleRequest($request);

            if($languagesTypes->isSubmitted() && $languagesTypes->isValid()) {

                $session->set('languages', $languagesFields->getLanguages());

                return $this->redirectToRoute('apartment_rules', ['housing_id' => $housing_id]);
            }

            return $this->render('partners/housing/adding/apartments/configurations/languages.html.twig', [
                'languagesForm' => $languagesTypes->createView(),
            ]);
        }
    }