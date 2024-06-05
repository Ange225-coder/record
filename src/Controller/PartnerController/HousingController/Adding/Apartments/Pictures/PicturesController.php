<?php

    namespace App\Controller\PartnerController\HousingController\Adding\Apartments\Pictures;

    use App\Entity\Tables\Housing\HousingGeneralInfo;
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
            //get apartment id
            $apartment_id = $entityManager->getRepository(HousingGeneralInfo::class)->find($housing_id);

            $pictureFields = new ApartmentPicturesFields();
            $picturesEntity = new HousingPictures();

            $pictureTypes = $this->createForm(ApartmentPicturesTypes::class, $pictureFields);

            $pictureTypes->handleRequest($request);

            if($pictureTypes->isSubmitted() && $pictureTypes->isValid()) {

                //manage teaser pic
                $teaserPic = $pictureFields->getTeaserPic();
                $teaserPicName = md5(uniqid()) . '.' . $teaserPic->guessExtension();
                $teaserPic->move(
                    $this->getParameter('apartments/adding/pictures'),
                    $teaserPicName,
                );

                $picturesEntity->setHousingGeneralInfo($apartment_id);
                $picturesEntity->setTeaserPic($this->getParameter('apartments/adding/pictures'). '/' . $teaserPicName);

                //manage optional pics
                $optionalPics = [];
                foreach ($pictureFields->getOptionalPics() as $opt_pic) {
                    if($opt_pic) {
                        $opt_picName = md5(uniqid() . '.' . $opt_pic->guessExtension());
                        $opt_pic->move(
                            $this->getParameter('apartments/adding/pictures'),
                            $opt_picName,
                        );
                        $optionalPics[] = $this->getParameter('apartments/adding/pictures'). '/' . $opt_picName;
                    }
                }

                $picturesEntity->setOptionalPics($optionalPics);

                //persist and flush all datas
                $entityManager->persist($picturesEntity);
                $entityManager->flush();

                return $this->redirectToRoute('how_receive_reservation', ['housing_id' => $housing_id]);
            }

            return $this->render('partners/housing/adding/apartments/pictures/pictures.html.twig', [
                'pictureForm' => $pictureTypes->createView(),
            ]);
        }
    }