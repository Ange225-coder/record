<?php

    namespace App\Entity\Tables\Housing;

    use Doctrine\ORM\Mapping as ORM;

    #[ORM\Entity]
    #[ORM\Table(name: 'housing_general_info')]
    class HousingGeneralInfo
    {
        #[ORM\Id]
        #[ORM\GeneratedValue(strategy: 'AUTO')]
        #[ORM\Column(type: 'integer')]
        private int $housingId;

        #[ORM\Column(type: 'string', length: 55, nullable: true)]
        private ?string $housingChoice;

        #[ORM\Column(type: 'json', length: 55, nullable: true)]
        private ?array $housingAlreadyRegistered = [];

        #[ORM\Column(type: 'string', length: 55, nullable: true)]
        private ?string $housingName;

        #[ORM\Column(type: 'string', length: 55, nullable: true)]
        private ?string $housingCountry;

        #[ORM\Column(type: 'string', length: 55, nullable: true)]
        private ?string $housingAddress;

        #[ORM\Column(type: 'string', length: 55, nullable: true)]
        private ?string $postalCode;

        #[ORM\Column(type: 'string', length: 55, nullable: true)]
        private ?string $housingTown;

        #[ORM\Column(type: 'string', length: 55, nullable: true)]
        private ?string $partner;


        //setters
        public function setHousingId(int $housingId): void
        {
            $this->housingId = $housingId;
        }

        public function setHousingChoice(string $housingChoice): void
        {
            $this->housingChoice = $housingChoice;
        }

        public function setHousingAlreadyRegistered(?array $housingAlreadyRegistered): void
        {
            $this->housingAlreadyRegistered = $housingAlreadyRegistered;
        }

        public function setHousingName(string $housingName): void
        {
            $this->housingName = $housingName;
        }

        public function setHousingCountry(string $housingCountry): void
        {
            $this->housingCountry = $housingCountry;
        }

        public function setHousingAddress(string $housingAddress): void
        {
            $this->housingAddress = $housingAddress;
        }

        public function setPostalCode(string $postalCode): void
        {
            $this->postalCode = $postalCode;
        }

        public function setHousingTown(string $housingTown): void
        {
            $this->housingTown = $housingTown;
        }

        public function setPartner(string $partner): void
        {
            $this->partner = $partner;
        }


        //getters
        public function getHousingId(): int
        {
            return $this->housingId;
        }

        public function getHousingChoice(): string
        {
            return $this->housingChoice;
        }

        public function getHousingAlreadyRegistered(): ?array
        {
            return $this->housingAlreadyRegistered;
        }

        public function getHousingName(): string
        {
            return $this->housingName;
        }

        public function getHousingCountry(): string
        {
            return $this->housingCountry;
        }

        public function getHousingAddress(): string
        {
            return $this->housingAddress;
        }

        public function getPostalCode(): string
        {
            return $this->postalCode;
        }

        public function getHousingTown(): string
        {
            return $this->housingTown;
        }

        public function getPartner(): string
        {
            return $this->partner;
        }
    }