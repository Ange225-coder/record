<?php

    namespace App\Controller\PartnerController\HousingController\Admin;

    use App\Entity\Tables\Partners\Reservations;
    use Symfony\Component\HttpFoundation\Response;
    use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
    use Symfony\Component\Routing\Annotation\Route;
    use Doctrine\ORM\EntityManagerInterface;

    class PartnerReservationController extends AbstractController
    {
        #[Route(path: '/partner/admin/reservation', name: 'partner_admin_reservation')]
        public function partnerReservation(EntityManagerInterface $entityManager): Response
        {
            $reservations = $entityManager->getRepository(Reservations::class)->findBy(
                ['partner' => $this->getUser()->getUserIdentifier()],
                ['reservationDate' => 'DESC']
            );

            return $this->render('partners/housing/admin/partnerReservation.html.twig', [
                'reservations' => $reservations,
            ]);
        }
    }