<?php

    namespace App\Controller\PublicController;

    use App\Entity\Tables\Housing\HousingConfigurations;
    use App\Entity\Tables\Housing\HousingGeneralInfo;
    use App\Entity\Tables\Housing\HousingPictures;
    use App\Entity\Tables\Housing\HousingPriceAndSchedule;
    use Symfony\Component\HttpFoundation\Response;
    use Symfony\Component\HttpFoundation\Request;
    use Symfony\Component\Routing\Annotation\Route;
    use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
    use Symfony\Component\HttpFoundation\Session\SessionInterface;
    use App\Forms\Fields\Public\Housing\SearchesHousingFields;
    use App\Forms\Types\Public\Housing\SearchesHousingTypes;
    use Doctrine\ORM\EntityManagerInterface;

    class HousingSearchingResultsController extends AbstractController
    {
        #[Route(path: '/searching-results', name: 'searching_results')]
        public function housingSearchingResults(SessionInterface $session, Request $request, EntityManagerInterface $entityManager): Response
        {
            //check if request from this controller
            $referer = $request->headers->get('referer');
            if ($referer && str_contains($referer, $request->getSchemeAndHttpHost() . '/searching-results')) {
                //remove sessions data if research is made from here
                $session->remove('housingGeneralInfo');
                $session->remove('housingConfiguration');
                $session->remove('housingPictures');
                $session->remove('reservation_price');

            }

            $housingConfigurationSess = $session->get('housingConfiguration', []);
            $housingGeneralInfoSess = $session->get('housingGeneralInfo', []);
            $housingPicturesSess = $session->get('housingPictures', []);
            $pricePerNightSess = $session->get('reservation_price', []);

            $searchHousingFields = new SearchesHousingFields();

            //pre-file this field with current value of town
            if($request->query->get('town')) {
                $searchHousingFields->setTown($request->query->get('town'));
            }

            $searchHousingTypes = $this->createForm(SearchesHousingTypes::class, $searchHousingFields);
            $searchHousingTypes->handleRequest($request);

            /**
             * housing searching
             */
            $housingGeneralInfo = [];
            $housingConfiguration = [];
            $housingPictures = [];
            $reservationPrices = [];

            if ($searchHousingTypes->isSubmitted() && $searchHousingTypes->isValid()) {
                /**
                 * form builder with HousingGeneralInfo::class for research town
                 */
                if (!empty($searchHousingFields->getTown())) {
                    $townQueryBuilder = $entityManager->createQueryBuilder();
                    $townQueryBuilder
                        ->select('hg')
                        ->from(HousingGeneralInfo::class, 'hg')
                        ->where('hg.housingTown = :town')
                        ->setParameter('town', $searchHousingFields->getTown());
                    $housingGeneralInfo = $townQueryBuilder->getQuery()->getResult();
                }

                /**
                 * form builder with HousingConfiguration for research values of kidsIsAccept and peopleCanStay
                 */
                if (!empty($housingGeneralInfo)) {
                    $generalInfoIds = array_map(fn($info) => $info->getHousingId(), $housingGeneralInfo);

                    $queryBuilderForPersons = $entityManager->createQueryBuilder();
                    $queryBuilderForPersons
                        ->select('hc')
                        ->from(HousingConfigurations::class, 'hc')
                        ->leftJoin('hc.housingGeneralInfo', 'hgi')
                        ->where('hgi.housingId IN (:generalInfoIds)')
                        ->setParameter('generalInfoIds', $generalInfoIds);

                    if (!empty($searchHousingFields->getPeopleCanStay())) {
                        $queryBuilderForPersons->andWhere('hc.peopleCanStay >= :peopleCanStay')
                            ->setParameter('peopleCanStay', $searchHousingFields->getPeopleCanStay());
                    }
                    if (!empty($searchHousingFields->getKidIsAccept())) {
                        $queryBuilderForPersons->andWhere('hc.kidsIsAccept = :kidsIsAccept')
                            ->setParameter('kidsIsAccept', $searchHousingFields->getKidIsAccept());
                    }

                    $housingConfiguration = $queryBuilderForPersons->getQuery()->getResult();

                    // Get pictures for each housing configuration
                    if (!empty($housingConfiguration)) {
                        $picturesQueryBuilder = $entityManager->createQueryBuilder();
                        $picturesQueryBuilder
                            ->select('hp')
                            ->from(HousingPictures::class, 'hp')
                            ->where('hp.housingGeneralInfo IN (:generalInfoIds)')
                            ->setParameter('generalInfoIds', $generalInfoIds);
                        $housingPictures = $picturesQueryBuilder->getQuery()->getResult();
                    }

                    //get pricing for each housingConfiguration
                    if(!empty($housingConfiguration)) {
                        $priceQueryBuilder = $entityManager->createQueryBuilder();
                        $priceQueryBuilder
                            ->select('IDENTITY(ppn.housingGeneralInfo) AS housingGeneralInfoId, ppn.pricePerNight')
                            ->from(HousingPriceAndSchedule::class, 'ppn')
                            ->where('ppn.housingGeneralInfo IN (:generalInfoIds)')
                            ->setParameter('generalInfoIds', $generalInfoIds);
                        $pricePerNight = $priceQueryBuilder->getQuery()->getResult();

                        foreach ($pricePerNight as $reservationPrice) {
                            $reservationPrices[$reservationPrice['housingGeneralInfoId']] = $reservationPrice['pricePerNight'];
                        }
                    }

                    $this->redirectToRoute('searching_results', ['town' => $searchHousingFields->getTown()]);
                }
            }

            //get popular destination result
            $popularDestinationResult = $this->popularDestinationsResults($entityManager, $request, $session);
            $town = $request->query->get('town');

            return $this->render('public/housingSearchingResults.html.twig', [
                'searchingForm' => $searchHousingTypes->createView(),
                'housingGeneralInfo' => $housingGeneralInfo,
                'housingConfiguration' => $housingConfiguration,
                'housingPictures' => $housingPictures,
                'reservationPrice' => $reservationPrices,
                'housingConfigurationSess' => $housingConfigurationSess,
                'housingGeneralInfoSess' => $housingGeneralInfoSess,
                'housingPicturesSess' => $housingPicturesSess,
                'pricePerNightSess' => $pricePerNightSess,
                'popularDestinationResult' => $popularDestinationResult,
                'town' => $town,
            ]);
        }


        /**
         * this function manage only popular destinations
         */
        private function popularDestinationsResults(EntityManagerInterface $entityManager, Request $request, SessionInterface $session): array
        {
            $session->remove('housingGeneralInfo');
            $session->remove('housingConfiguration');

            $town = $request->query->get('town');

            $popularDestination = $entityManager->getRepository(HousingGeneralInfo::class)->findBy(
                ['housingTown' => $town],
            );

            //for each popular destination, get associated picture
            foreach ($popularDestination as $destination) {
                // Récupérer les images associées à cette destination
                $pictures = $entityManager->getRepository(HousingPictures::class)->findBy(
                    ['housingGeneralInfo' => $destination]
                );

                foreach ($pictures as $picture) {
                    $destination->addPicture($picture);
                }
            }

            //for each popular destination, get the price per night associated
            foreach ($popularDestination as $destination) {
                $prices = $entityManager->getRepository(HousingPriceAndSchedule::class)->findBy(
                    ['housingGeneralInfo' => $destination]
                );

                foreach ($prices as $price) {
                    $destination->addPriceAndSchedule($price);
                }
            }

            return $popularDestination;
        }
    }