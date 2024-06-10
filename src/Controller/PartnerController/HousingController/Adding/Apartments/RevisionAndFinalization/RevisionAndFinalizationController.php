<?php

    namespace App\Controller\PartnerController\HousingController\Adding\Apartments\RevisionAndFinalization;

    use App\Entity\Tables\Housing\HousingForCommercialEntity;
    use App\Entity\Tables\Housing\HousingForIndividuals;
    use App\Entity\Tables\Housing\HousingGeneralInfo;
    use App\Forms\Fields\Partners\Housing\Adding\Apartments\RevisionAndFinalization\HousingForCommercialEntityFields;
    use App\Forms\Types\Partners\Housing\Adding\Apartments\RevisionAndFinalization\HousingForCommercialEntityTypes;
    use Symfony\Component\HttpFoundation\Response;
    use Symfony\Component\HttpFoundation\Request;
    use Symfony\Component\Routing\Annotation\Route;
    use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
    use Doctrine\ORM\EntityManagerInterface;
    use App\Forms\Fields\Partners\Housing\Adding\Apartments\RevisionAndFinalization\HousingForIndividualsFields;
    use App\Forms\Types\Partners\Housing\Adding\Apartments\RevisionAndFinalization\HousingForIndividualsTypes;

    class RevisionAndFinalizationController extends AbstractController
    {
        #[Route(path: '/partner/add/apartment/rev-final/{housing_id}', name: 'revision_and_finalization')]
        public function revisionAndFinalization(int $housing_id, Request $request, EntityManagerInterface $entityManager): Response
        {
            $housingId = $entityManager->getRepository(HousingGeneralInfo::class)->find($housing_id);

            $forIndividualsFields = new HousingForIndividualsFields();
            $forCommercialEntityFields = new HousingForCommercialEntityFields();

            $forIndividualsEntity = new HousingForIndividuals();
            $forCommercialEntity_entity = new HousingForCommercialEntity();

            $forIndividualsTypes = $this->createForm(HousingForIndividualsTypes::class, $forIndividualsFields);
            $forCommercialEntityTypes = $this->createForm(HousingForCommercialEntityTypes::class, $forCommercialEntityFields);

            $forIndividualsTypes->handleRequest($request);

            //for individuals manager
            if($forIndividualsTypes->isSubmitted() && $forIndividualsTypes->isValid()) {

                $forIndividualsEntity->setHousingGeneralInfo($housingId);
                $forIndividualsEntity->setFirstName($forIndividualsFields->getFirstName());
                $forIndividualsEntity->setOtherFirstName($forIndividualsFields->getOtherFirstName());
                $forIndividualsEntity->setLastName($forIndividualsFields->getLastName());
                $forIndividualsEntity->setEmail($forIndividualsFields->getEmail());
                $forIndividualsEntity->setPhone($forIndividualsFields->getPhone());
                $forIndividualsEntity->setLocation($forIndividualsFields->getLocation());
                $forIndividualsEntity->setFirstAddress($forIndividualsFields->getFirstAddress());
                $forIndividualsEntity->setSecondAddress($forIndividualsFields->getSecondAddress());
                $forIndividualsEntity->setTown($forIndividualsFields->getTown());
                $forIndividualsEntity->setPostalCode($forIndividualsFields->getPostalCode());

                $entityManager->persist($forIndividualsEntity);
                $entityManager->flush();

                //cette redirection est momentanée
                //après, il faut rediriger vers les details de l herbergement courant en fonction de son identifiant
                return $this->redirectToRoute('partner_admin_housing_details', ['housing_id' => $housingId->getHousingId()]);
            }

            return $this->render('partners/housing/adding/apartments/RevisionAndFinalization/revisionAndFinalization.html.twig', [
                'individualsForm' => $forIndividualsTypes->createView(),
                'commercialEntityForm' => $forCommercialEntityTypes->createView(),
            ]);
        }
    }