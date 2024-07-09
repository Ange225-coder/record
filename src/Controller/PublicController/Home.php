<?php

    namespace App\Controller\PublicController;

    use App\Entity\Tables\Housing\HousingConfigurations;
    use App\Entity\Tables\Housing\HousingGeneralInfo;
    use App\Entity\Tables\Housing\HousingPictures;
    use App\Entity\Tables\Housing\HousingPriceAndSchedule;
    use Symfony\Component\HttpFoundation\Response;
    use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
    use Symfony\Component\Routing\Annotation\Route;
    use Symfony\Component\HttpFoundation\Request;
    use Doctrine\ORM\EntityManagerInterface;
    use App\Forms\Fields\Public\Housing\SearchesHousingFields;
    use App\Forms\Types\Public\Housing\SearchesHousingTypes;
    use Symfony\Component\HttpFoundation\Session\SessionInterface;

    class Home extends AbstractController
    {
        #[Route(path: '/', name: 'home')]
        public function index(Request $request, EntityManagerInterface $entityManager, SessionInterface $session): Response
        {
            $searchHousingFields = new SearchesHousingFields();

            $searchHousingTypes = $this->createForm(SearchesHousingTypes::class, $searchHousingFields);

            $searchHousingTypes->handleRequest($request);

            /**
             * housing searching
             */
            $housingGeneralInfo = [];
            $housingConfiguration = [];
            $pictures = [];
            $prices = [];

            if($searchHousingTypes->isSubmitted() && $searchHousingTypes->isValid()) {

                /**
                 * form builder with HousingGeneralInfo::class for research town
                 */
                if(!empty($searchHousingFields->getTown())) {
                    $townQueryBuilder = $entityManager->createQueryBuilder();
                    $townQueryBuilder
                        ->select('hg')
                        ->from(HousingGeneralInfo::class, 'hg')
                        ->where('hg.housingTown = :town')
                        ->setParameter('town', $searchHousingFields->getTown())
                    ;
                    $housingGeneralInfo = $townQueryBuilder->getQuery()->getResult();

                    //if there are no town, display message
                    if(empty($housingGeneralInfo)) {
                        $this->addFlash('warning', 'Aucune ville trouvée pour cette recherche');
                        return $this->redirectToRoute('home');
                    }
                }


                /**
                 * form builder with HousingConfiguration for research values of kidsIsAccept and peopleCanStay
                 */
                if(!empty($housingGeneralInfo)) {
                    $generalInfoIds = array_map(fn($info) => $info->getHousingId(), $housingGeneralInfo);

                    $queryBuilderForPersons = $entityManager->createQueryBuilder();
                    $queryBuilderForPersons
                        ->select('hc')
                        ->from(HousingConfigurations::class, 'hc')
                        ->leftJoin('hc.housingGeneralInfo', 'hgi')
                        ->where('hgi.housingId IN (:generalInfoIds)')
                        ->setParameter('generalInfoIds', $generalInfoIds)
                    ;

                    if (!empty($searchHousingFields->getPeopleCanStay())) {
                        $queryBuilderForPersons->andWhere('hc.peopleCanStay >= :peopleCanStay')
                            ->setParameter('peopleCanStay', $searchHousingFields->getPeopleCanStay());
                    }
                    if (!empty($searchHousingFields->getKidIsAccept())) {
                        $queryBuilderForPersons->andWhere('hc.kidsIsAccept = :kidsIsAccept')
                            ->setParameter('kidsIsAccept', $searchHousingFields->getKidIsAccept());
                    }

                    $housingConfiguration = $queryBuilderForPersons->getQuery()->getResult();

                    if(empty($housingConfiguration)) {
                        $this->addFlash('warning-conf', 'Aucune configuration correspondante pour cette recherche');
                        return $this->redirectToRoute('home');
                    }
                }


                //get pictures for each housing configuration
                if(!empty($housingGeneralInfo) && !empty($housingConfiguration)) {
                    $generalInfoIds = array_map(fn($info) => $info->getHousingId(), $housingGeneralInfo);

                    $picturesQueryBuilder = $entityManager->createQueryBuilder();
                    $picturesQueryBuilder
                        ->select('hp')
                        ->from(HousingPictures::class, 'hp')
                        ->where('hp.housingGeneralInfo IN (:generalInfoIds)')
                        ->setParameter('generalInfoIds', $generalInfoIds);
                    $pictures = $picturesQueryBuilder->getQuery()->getResult();
                }


                //get price per night for each housing configuration
                if(!empty($housingGeneralInfo) && !empty($housingConfiguration)) {
                    $generalInfoIds = array_map(fn($info) => $info->getHousingId(), $housingGeneralInfo);

                    $priceQueryBuilder = $entityManager->createQueryBuilder();
                    $priceQueryBuilder
                        ->select('IDENTITY(ppn.housingGeneralInfo) AS housingGeneralInfoId, ppn.pricePerNight')
                        ->from(HousingPriceAndSchedule::class, 'ppn')
                        ->where('ppn.housingGeneralInfo IN (:generalInfoIds)')
                        ->setParameter('generalInfoIds', $generalInfoIds);
                    $pricePerNight = $priceQueryBuilder->getQuery()->getResult();

                    foreach ($pricePerNight as $price) {
                        $prices[$price['housingGeneralInfoId']] = $price['pricePerNight'];
                    }
                }

                //clean sessions before redirections
                $session->remove('housingGeneralInfo');
                $session->remove('housingConfiguration');
                $session->remove('housingPictures');
                $session->remove('reservation_price');

                $session->set('housingGeneralInfo', $housingGeneralInfo);
                $session->set('housingConfiguration', $housingConfiguration);
                $session->set('housingPictures', $pictures);
                $session->set('reservation_price', $prices);

                return $this->redirectToRoute('searching_results', ['town' => $searchHousingFields->getTown()]);
            }

            //get infos for popular destination
            $popularDestination = $this->popularDestination($entityManager);

            return $this->render('public/index.html.twig', [
                'searchingForm' => $searchHousingTypes->createView(),
                'housingGeneralInfo' => $housingGeneralInfo,
                'housingConfiguration' => $housingConfiguration,
                'pictures' => $pictures,
                'reservation_price' => $prices,
                'popularDestination' => $popularDestination,
            ]);
        }


        private function popularDestination(EntityManagerInterface $entityManager): array
        {
            $destinations = $entityManager->getRepository(HousingGeneralInfo::class)->findAll();

            $towns = [];
            foreach ($destinations as $destination) {
                $town = $destination->getHousingTown();
                if(!in_array($town, $towns)) {
                    $towns[] = $town;
                }
            }
            return $towns;
        }
    }