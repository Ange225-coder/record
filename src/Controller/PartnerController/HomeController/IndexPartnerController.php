<?php

    namespace App\Controller\PartnerController\HomeController;

    use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
    use Symfony\Component\HttpFoundation\Response;
    use Symfony\Component\Routing\Annotation\Route;

    class IndexPartnerController extends AbstractController
    {
        #[Route(path: '/partner', name: 'partner_home')]
        public function indexPartner(): Response
        {
            return $this->render('partners/indexPartner.html.twig');
        }
    }