<?php

    namespace App\Controller\PublicController;

    use App\Entity\Tables\Housing\HousingConfigurations;
    use App\Entity\Tables\Housing\HousingGeneralInfo;
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
            // Vérifier si la requête provient directement de ce contrôleur
            $referer = $request->headers->get('referer');
            if ($referer && str_contains($referer, $request->getSchemeAndHttpHost() . '/searching-results')) {
                // Supprimer les données de session existantes seulement si la recherche est effectuée ici
                $session->remove('housingGeneralInfo');
                $session->remove('housingConfiguration');
            }

            $housingConfigurationSess = $session->get('housingConfiguration', []);
            $housingGeneralInfoSess = $session->get('housingGeneralInfo', []);

            $searchHousingFields = new SearchesHousingFields();

            //pre-file this field with current value of town
            $searchHousingFields->setTown($request->query->get('town'));

            $searchHousingTypes = $this->createForm(SearchesHousingTypes::class, $searchHousingFields);
            $searchHousingTypes->handleRequest($request);

            /**
             * housing searching
             */
            $housingGeneralInfo = [];
            $housingConfiguration = [];

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
                        //->andWhere('hc.peopleCanStay >= :peopleCanStay')
                        //->setParameter('kidsIsAccept', $searchHousingFields->getKidIsAccept())
                        //->setParameter('peopleCanStay', $searchHousingFields->getPeopleCanStay())
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
                }

                $this->redirectToRoute('searching_results', ['town' => $searchHousingFields->getTown()]);
            }

            //if sessions exist, display infos inside it
            //if($housingGeneralInfoSess  && $housingConfigurationSess) {

            //}

            //get housing searching results from index
            //$session->get('housingGeneralInfo', []);
            //$session->get('housingConfiguration', []);

            return $this->render('public/housingSearchingResults.html.twig', [
                'searchingForm' => $searchHousingTypes->createView(),
                'housingGeneralInfo' => $housingGeneralInfo,
                'housingConfiguration' => $housingConfiguration,
                'housingConfigurationSess' => $housingConfigurationSess,
                'housingGeneralInfoSess' => $housingGeneralInfoSess,
            ]);
        }
    }