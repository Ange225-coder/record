<?php

    namespace App\Controller\PartnerController\HousingController\Adding\Apartments\RevisionAndFinalization;

    use App\Forms\Fields\Partners\Housing\Adding\Apartments\RevisionAndFinalization\HousingForCommercialEntityFields;
    use App\Forms\Types\Partners\Housing\Adding\Apartments\RevisionAndFinalization\HousingForCommercialEntityTypes;
    use Symfony\Component\HttpFoundation\Response;
    use Symfony\Component\HttpFoundation\Request;
    use Symfony\Component\Routing\Annotation\Route;
    use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
    use App\Forms\Fields\Partners\Housing\Adding\Apartments\RevisionAndFinalization\HousingChoiceFields;
    use App\Forms\Types\Partners\Housing\Adding\Apartments\RevisionAndFinalization\HousingChoiceTypes;
    use App\Forms\Fields\Partners\Housing\Adding\Apartments\RevisionAndFinalization\HousingForIndividualsFields;
    use App\Forms\Types\Partners\Housing\Adding\Apartments\RevisionAndFinalization\HousingForIndividualsTypes;

    class RevisionAndFinalizationController extends AbstractController
    {
        #[Route(path: '/partner/add/apartment/rev-final/{housing_id}', name: 'revision_and_finalization')]
        public function revisionAndFinalization(int $housing_id, Request $request): Response
        {


            return $this->render('partners/housing/adding/apartments/RevisionAndFinalization/revisionAndFinalization.html.twig', [

            ]);
        }
    }