<?php

    namespace App\Controller\PartnerController\HousingController\Adding\Apartments\Pictures;

    use App\Entity\Tables\Housing\HousingPictures;
    use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
    use Symfony\Component\HttpFoundation\Response;
    use Symfony\Component\HttpFoundation\Request;
    use App\Forms\Fields\Partners\Housing\Adding\Apartments\Pictures\ApartmentPicturesFields;
    use App\Forms\Types\Partners\Housing\Adding\Apartments\Pictures\ApartmentPicturesTypes;
    use Doctrine\ORM\EntityManagerInterface;
    use Symfony\Component\Routing\Annotation\Route;

    class PicturesController extends AbstractController
    {
        #[Route(path: '/partner/add/apartment-pictures/{housing_id}', name: 'pictures')]
        public function pictures(int $housing_id, Request $request, EntityManagerInterface $entityManager): Response
        {
            $pictureFields = new ApartmentPicturesFields();
            $picturesEntity = new HousingPictures();

            $pictureTypes = $this->createForm(ApartmentPicturesTypes::class, $pictureFields);

            $pictureTypes->handleRequest($request);

            if($pictureTypes->isSubmitted() && $pictureTypes->isValid()) {

                /**
                 * manage teaser pic
                 */
                $teaserPic = $pictureFields->getTeaserPic();
                $teaserPicName = md5(uniqid()) . '.' . $teaserPic->guessExtension();
                $teaserPic->move(
                    $this->getParameter('apartments/adding/pictures'),
                    $teaserPicName
                );

                $picturesEntity->setTeaserPic($this->getParameter('apartments/adding/pictures') . '/' . $teaserPicName);

                /**
                 * manager other pics
                 */

            }

            return $this->render('partners/housing/adding/apartments/pictures/pictures.html.twig', [
                'pictureForm' => $pictureTypes->createView(),
            ]);
        }
    }