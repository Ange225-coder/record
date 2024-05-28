<?php

    namespace App\Controller\PartnerController\HousingController\Adding\Apartments\Configurations;

    use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
    use Symfony\Component\HttpFoundation\Response;
    use Symfony\Component\HttpFoundation\Request;
    use Symfony\Component\Routing\Annotation\Route;
    use Symfony\Component\HttpFoundation\Session\Session;
    use App\Forms\Fields\Partners\Housing\Adding\Apartments\Configurations\ApartmentEquipmentsFields;
    use App\Forms\Types\Partners\Housing\Adding\Apartments\Configurations\ApartmentEquipmentsTypes;

    class ApartmentEquipmentsController extends AbstractController
    {
        #[Route(path: '/partner/add/apartment-equipment/{housing_id}', name: 'apartment_equipments')]
        public function apartmentEquipments(int $housing_id, Session $session, Request $request): Response
        {
            $equipmentFields = new ApartmentEquipmentsFields();

            $equipmentType = $this->createForm(ApartmentEquipmentsTypes::class, $equipmentFields);

            $equipmentType->handleRequest($request);

            if($equipmentType->isSubmitted() && $equipmentType->isValid()) {

                $session->set('equipments', [
                    'generalEquipment' => $equipmentFields->getGeneralEquipments(),
                    'kitchenEquipment' => $equipmentFields->getKitchenAndCleaning(),
                    'entertainment' => $equipmentFields->getEntertainment(),
                    'outdoorView' => $equipmentFields->getOutdoorView(),
                ]);

                return $this->redirectToRoute('apartment_services', ['housing_id' => $housing_id]);
            }

            return $this->render('partners/housing/adding/apartments/configurations/apartmentEquipments.html.twig', [
                'equipmentForm' => $equipmentType->createView(),
            ]);
        }
    }