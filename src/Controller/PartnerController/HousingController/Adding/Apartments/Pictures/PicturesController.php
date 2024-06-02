<?php

    namespace App\Controller\PartnerController\HousingController\Adding\Apartments\Pictures;

    use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
    use Symfony\Component\HttpFoundation\Response;
    use Symfony\Component\Routing\Annotation\Route;
    use Symfony\Component\HttpFoundation\Session\Session;
    use App\Forms\Fields\Partners\Housing\Adding\Apartments\Pictures\ApartmentPicturesFields;
    use App\Forms\Types\Partners\Housing\Adding\Apartments\Pictures\ApartmentPicturesTypes;

    class PicturesController extends AbstractController
    {
        #[Route(path: '/partner/add/apartment-pictures/{housing_id}', name: 'pictures')]
        public function pictures(Session $session): Response
        {
            $picturesFields = new ApartmentPicturesFields();

            $picturesTypes = $this->createForm(ApartmentPicturesTypes::class, $picturesFields);

            return $this->render('partners/housing/adding/apartments/pictures/pictures.html.twig', [
                'apartmentPictureForm' => $picturesTypes->createView(),
            ]);
        }
    }