<?php

    namespace App\Controller\PartnerController\HousingController\Adding\Apartments\Configurations;

    use Symfony\Component\HttpFoundation\Response;
    use Symfony\Component\HttpFoundation\Session\Session;
    use Symfony\Component\HttpFoundation\Request;
    use Symfony\Component\Routing\Annotation\Route;
    use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

    class LanguagesController extends AbstractController
    {
        #[Route(path: '/partner/add/apartment/languages/{housing_id}', name: 'languages')]
        public function languages(int $housing_id, Session $session, Request $request): Response
        {
            return $this->render('partners/housing/adding/apartments/configurations/languages.html.twig');
        }
    }