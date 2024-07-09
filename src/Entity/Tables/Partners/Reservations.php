<?php

    namespace App\Entity\Tables\Partners;

    use Doctrine\ORM\Mapping as ORM;

    #[ORM\Entity]
    #[ORM\Table(name: 'reservations')]
    class Reservations
    {
        #[ORM\Id]
        #[ORM\GeneratedValue(strategy: 'AUTO')]
        #[ORM\Column(type: 'integer')]
        private int $id;

        #[ORM\Column(type: 'integer')]
        private int $housingId;

        #[ORM\Column(type: 'string', length: 55)]
        private string $housingChoice;

        #[ORM\Column(type: 'string', length: 120)]
        private string $housingName;

        #[ORM\Column(type: 'string', length: 55)]
        private string $housingTown;

        #[ORM\Column(type: 'string', length: 120)]
        private string $housingAddress;

        #[ORM\Column(type: 'integer')]
        private int $housingPrice;

        #[ORM\Column(type: 'string', length: 55)]
        private string $clientFirstName;

        #[ORM\Column(type: 'string', length: 55)]
        private string $clientLastName;

        #[ORM\Column(type: 'integer')]
        private int $reservationNumber;

        #[ORM\Column(type: 'string', length: 55)]
        private string $partner;

        #[ORM\Column(type: 'datetime')]
        private \DateTime $reservationDate;


        //setters
        public function setId(int $id): void
        {
            $this->id = $id;
        }

        public function setPartner(string $partner): void
        {
            $this->partner = $partner;
        }

        public function setHousingChoice(string $housingChoice): void
        {
            $this->housingChoice = $housingChoice;
        }

        public function setHousingTown(string $housingTown): void
        {
            $this->housingTown = $housingTown;
        }

        public function setHousingAddress(string $housingAddress): void
        {
            $this->housingAddress = $housingAddress;
        }

        public function setHousingName(string $housingName): void
        {
            $this->housingName = $housingName;
        }

        public function setHousingId(int $housingId): void
        {
            $this->housingId = $housingId;
        }

        public function setClientFirstName(string $clientFirstName): void
        {
            $this->clientFirstName = $clientFirstName;
        }

        public function setClientLastName(string $clientLastName): void
        {
            $this->clientLastName = $clientLastName;
        }

        public function setHousingPrice(int $housingPrice): void
        {
            $this->housingPrice = $housingPrice;
        }

        public function setReservationDate(\DateTime $reservationDate): void
        {
            $this->reservationDate = $reservationDate;
        }

        public function setReservationNumber(int $reservationNumber): void
        {
            $this->reservationNumber = $reservationNumber;
        }


        //getters
        public function getId(): int
        {
            return $this->id;
        }

        public function getPartner(): string
        {
            return $this->partner;
        }

        public function getHousingChoice(): string
        {
            return $this->housingChoice;
        }

        public function getHousingTown(): string
        {
            return $this->housingTown;
        }

        public function getHousingAddress(): string
        {
            return $this->housingAddress;
        }

        public function getHousingName(): string
        {
            return $this->housingName;
        }

        public function getHousingId(): int
        {
            return $this->housingId;
        }

        public function getClientFirstName(): string
        {
            return $this->clientFirstName;
        }

        public function getClientLastName(): string
        {
            return $this->clientLastName;
        }

        public function getHousingPrice(): int
        {
            return $this->housingPrice;
        }

        public function getReservationDate(): \DateTime
        {
            return $this->reservationDate;
        }

        public function getReservationNumber(): int
        {
            return $this->reservationNumber;
        }
    }