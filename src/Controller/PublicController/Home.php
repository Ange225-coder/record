<?php

    namespace App\Controller\PublicController;

    use App\Entity\Tables\Housing\HousingConfigurations;
    use App\Entity\Tables\Housing\HousingGeneralInfo;
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

                $session->set('housingGeneralInfo', $housingGeneralInfo);
                $session->set('housingConfiguration', $housingConfiguration);

                return $this->redirectToRoute('searching_results', ['town' => $searchHousingFields->getTown()]);
            }

            return $this->render('public/index.html.twig', [
                'searchingForm' => $searchHousingTypes->createView(),
                'housingGeneralInfo' => $housingGeneralInfo,
                'housingConfiguration' => $housingConfiguration,
            ]);
        }
    }