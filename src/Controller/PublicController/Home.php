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

    class Home extends AbstractController
    {
        #[Route(path: '/', name: 'home')]
        public function index(Request $request, EntityManagerInterface $entityManager): Response
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
                if(!empty($searchHousingFields->getPeopleCanStay()) && !empty($searchHousingFields->getKidIsAccept())) {
                    $queryBuilderForPersons = $entityManager->createQueryBuilder();
                    $queryBuilderForPersons
                        ->select('hc')
                        ->from(HousingConfigurations::class, 'hc')
                        ->leftJoin('hc.housingGeneralInfo', 'hgi')
                        ->where('hc.kidsIsAccept = :kidsIsAccept')
                        ->andWhere('hc.peopleCanStay >= :peopleCanStay')
                        ->setParameter('kidsIsAccept', $searchHousingFields->getKidIsAccept())
                        ->setParameter('peopleCanStay', $searchHousingFields->getPeopleCanStay())
                    ;
                    $housingConfiguration = $queryBuilderForPersons->getQuery()->getResult();
                }

            }

            return $this->render('index.html.twig', [
                'searchingForm' => $searchHousingTypes->createView(),
                'housingGeneralInfo' => $housingGeneralInfo,
                'housingConfiguration' => $housingConfiguration,
            ]);
        }
    }