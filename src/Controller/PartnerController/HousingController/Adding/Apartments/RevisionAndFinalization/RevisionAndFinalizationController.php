<?php

    namespace App\Controller\PartnerController\HousingController\Adding\Apartments\RevisionAndFinalization;

    use App\Entity\Tables\Housing\HousingFinalization;
    use App\Entity\Tables\Housing\HousingGeneralInfo;
    use Symfony\Component\HttpFoundation\Response;
    use Symfony\Component\HttpFoundation\Request;
    use Symfony\Component\Routing\Annotation\Route;
    use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
    use Doctrine\ORM\EntityManagerInterface;
    use App\Forms\Fields\Partners\Housing\Adding\Apartments\RevisionAndFinalization\HousingFinalizationFields;
    use App\Forms\Types\Partners\Housing\Adding\Apartments\RevisionAndFinalization\HousingFinalizationTypes;
    use App\Forms\Fields\Partners\Housing\Adding\Apartments\RevisionAndFinalization\HousingGeneralsConditionsFields;
    use App\Forms\Types\Partners\Housing\Adding\Apartments\RevisionAndFinalization\HousingGeneralsConditionsTypes;

    class RevisionAndFinalizationController extends AbstractController
    {
        #[Route(path: '/partner/add/apartment/rev-final/{housing_id}', name: 'revision_and_finalization')]
        public function revisionAndFinalization(int $housing_id, Request $request, EntityManagerInterface $entityManager): Response
        {
            $housingId = $entityManager->getRepository(HousingGeneralInfo::class)->find($housing_id);

            //get partner to check if it already exists in HousingFinalization table
            $getPartner = $entityManager->getRepository(HousingFinalization::class)->findOneBy([
                'partner' => $this->getUser()->getUserIdentifier(),
            ]);
            $partner = null;

            if($getPartner !== null) {
                $partner = $getPartner->getPartner();
            }

            $housingFinalizationEntity = new HousingFinalization();

            $housingFinalizationFields = new HousingFinalizationFields();
            $housingGeneralsConditionsFields = new HousingGeneralsConditionsFields();

            $housingFinalizationTypes = $this->createForm(HousingFinalizationTypes::class, $housingFinalizationFields);
            $housingGeneralsConditionsTypes = $this->createForm(HousingGeneralsConditionsTypes::class, $housingGeneralsConditionsFields);

            $housingFinalizationTypes->handleRequest($request);
            $housingGeneralsConditionsTypes->handleRequest($request);

            //form if partner does not exist
            if($housingFinalizationTypes->isSubmitted() && $housingFinalizationTypes->isValid()) {

                if($housingFinalizationFields->getHousingChoices() === 'individual') {
                    $housingFinalizationEntity->setSocialReason(null);
                }
                elseif($housingFinalizationFields->getHousingChoices() == 'commercial_entity') {
                    $housingFinalizationEntity->setSocialReason($housingFinalizationFields->getSocialReason());
                }

                $housingFinalizationEntity->setHousingGeneralInfo($housingId);
                $housingFinalizationEntity->setFirstName($housingFinalizationFields->getFirstName());
                $housingFinalizationEntity->setOtherFirstName($housingFinalizationFields->getOtherFirstName());
                $housingFinalizationEntity->setLastName($housingFinalizationFields->getLastName());
                $housingFinalizationEntity->setEmail($housingFinalizationFields->getEmail());
                $housingFinalizationEntity->setLocation($housingFinalizationFields->getLocation());
                $housingFinalizationEntity->setFirstAddress($housingFinalizationFields->getFirstAddress());
                $housingFinalizationEntity->setSecondAddress($housingFinalizationFields->getSecondAddress());
                $housingFinalizationEntity->setTown($housingFinalizationFields->getTown());
                $housingFinalizationEntity->setPostalCode($housingFinalizationFields->getPostalCode());
                $housingFinalizationEntity->setPhone($housingFinalizationFields->getPhone());
                $housingFinalizationEntity->setPartner($this->getUser()->getUserIdentifier());

                $entityManager->persist($housingFinalizationEntity);
                $entityManager->flush();

                return $this->redirectToRoute('partner_admin_housing_details', ['housing_id' => $housingId->getHousingId()]);
            }


            //form if partner already exist
            if($housingGeneralsConditionsTypes->isSubmitted() && $housingGeneralsConditionsTypes->isValid()) {

                $housingFinalizationEntity->setHousingGeneralInfo($housingId);
                $housingFinalizationEntity->setFirstName($getPartner->getFirstName());
                $housingFinalizationEntity->setLastName($getPartner->getLastName());
                $housingFinalizationEntity->setEmail($getPartner->getEmail());
                $housingFinalizationEntity->setPhone($getPartner->getPhone());
                $housingFinalizationEntity->setLocation($getPartner->getLocation());
                $housingFinalizationEntity->setFirstAddress($getPartner->getFirstAddress());
                $housingFinalizationEntity->setTown($getPartner->getTown());
                $housingFinalizationEntity->setPartner($getPartner->getPartner());

                $entityManager->persist($housingFinalizationEntity);
                $entityManager->flush();

                return $this->redirectToRoute('partner_admin_housing_details', ['housing_id' => $housingId->getHousingId()]);
            }

            return $this->render('partners/housing/adding/apartments/RevisionAndFinalization/revisionAndFinalization.html.twig', [
                'finalizationForm' => $housingFinalizationTypes->createView(),
                'generalsConditionsForm' => $housingGeneralsConditionsTypes->createView(),
                'partner' => $partner,
            ]);
        }
    }