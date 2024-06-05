<?php

    namespace App\Entity\Tables\Housing;

    use Doctrine\ORM\Mapping as ORM;

    #[ORM\Entity]
    #[ORM\Table(name: 'housing_price_and_schedule')]
    class HousingPriceAndSchedule
    {
        #[ORM\Id]
        #[ORM\GeneratedValue(strategy: 'AUTO')]
        #[ORM\Column(type: 'integer')]
        private int $id;

        #[ORM\Column(type: 'string', length: 55)]
        private string $howToReserve;

        #[ORM\Column(type: 'integer')]
        private int $pricePerNight;

        #[ORM\Column(type: 'string', length: 55)]
        private string $arrivalDate;

        #[ORM\Column(type: 'string', length: 55)]
        private string $avalaibilitySynchronisation;

        #[ORM\Column(type: 'string', length: 55)]
        private string $stayOfMoreThanThirtyNights;

        #[ORM\ManyToOne(targetEntity: HousingGeneralInfo::class, inversedBy: 'priceAndSchedule')]
        #[ORM\JoinColumn(name: 'housing_id', referencedColumnName: 'housing_id', nullable: false)]
        private ?HousingGeneralInfo $housingGeneralInfo;


        //setters
        public function setId(int $id): void
        {
            $this->id = $id;
        }

        public function setHowToReserve(string $howToReserve): void
        {
            $this->howToReserve = $howToReserve;
        }

        public function setPricePerNight(int $pricePerNight): void
        {
            $this->pricePerNight = $pricePerNight;
        }

        public function setArrivalDate(string $arrivalDate): void
        {
            $this->arrivalDate = $arrivalDate;
        }

        public function setAvalaibilitySynchronisation(string $avalaibilitySynchronisation): void
        {
            $this->avalaibilitySynchronisation = $avalaibilitySynchronisation;
        }

        public function setStayOfMoreThanThirtyNights(string $stayOfMoreThanThirtyNights): void
        {
            $this->stayOfMoreThanThirtyNights = $stayOfMoreThanThirtyNights;
        }

        public function setHousingGeneralInfo(?HousingGeneralInfo $housingGeneralInfo): void
        {
            $this->housingGeneralInfo = $housingGeneralInfo;
        }



        //getters
        public function getId(): int
        {
            return $this->id;
        }

        public function getHowToReserve(): string
        {
            return $this->howToReserve;
        }

        public function getPricePerNight(): int
        {
            return $this->pricePerNight;
        }

        public function getArrivalDate(): string
        {
            return $this->arrivalDate;
        }

        public function getAvalaibilitySynchronisation(): string
        {
            return $this->avalaibilitySynchronisation;
        }

        public function getStayOfMoreThanThirtyNights(): string
        {
            return $this->stayOfMoreThanThirtyNights;
        }

        public function getHousingGeneralInfo(): ?HousingGeneralInfo
        {
            return $this->housingGeneralInfo;
        }
    }