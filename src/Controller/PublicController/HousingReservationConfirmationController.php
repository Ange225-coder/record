<?php

     namespace App\Controller\PublicController;

     use App\Entity\Tables\Partners\Reservations;
     use Symfony\Component\HttpFoundation\Response;
     use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
     use Symfony\Component\Routing\Annotation\Route;
     use Doctrine\ORM\EntityManagerInterface;

     class HousingReservationConfirmationController extends AbstractController
     {
         #[Route(path: '/reservation/{housing_id}/{reservation_id}/confirmation', name: 'reservation_confirmation')]
         public function reservationConfirmation(int $housing_id, int $reservation_id, EntityManagerInterface $entityManager): Response
         {
             $reservation = $entityManager->getRepository(Reservations::class)->findOneBy([
                 'housingId' => $housing_id,
             ]);


             return $this->render('public/housingReservationConfirmation.html.twig', [
                 'reservation' => $reservation,
             ]);
         }
     }