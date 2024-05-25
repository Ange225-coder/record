<?php

    namespace App\Entity\Tables\Housing;

    use Doctrine\ORM\Mapping as ORM;

    #[ORM\Entity]
    #[ORM\Table(name: 'housing_configurations')]
    class HousingConfigurations
    {
        #[ORM\Id]
        #[ORM\GeneratedValue(strategy: 'AUTO')]
        #[ORM\Column(type: 'integer')]
        private int $id;

        #[ORM\Column(type: 'string', length: 55, nullable: true)]
        private ?string $whereToSleep;

        #[ORM\Column(type: 'integer', nullable: true)]
        private ?int $peopleCanStay;

        #[ORM\Column(type: 'integer', nullable: true)]
        private ?int $numberOfBathroom;

        #[ORM\Column(type: 'string', length: 55, nullable: true)]
        private ?string $kidsIsAccept;

        #[ORM\Column(type: 'string', length: 55, nullable: true)]
        private ?string $babyBed;

        #[ORM\Column(type: 'integer', nullable: true)]
        private ?int $housingArea;

        #[ORM\Column(type: 'string', length: 128, nullable: true)]
        private ?string $homeEquipment;

        #[ORM\Column(type: 'string', length: 55, nullable: true)]
        private ?string $lunch;

        #[ORM\Column(type: 'string', length: 55, nullable: true)]
        private ?string $carPark;

        #[ORM\Column(type: 'string', length: 55, nullable: true)]
        private ?string $myLanguage;

        #[ORM\Column(type: 'string', length: 55, nullable: true)]
        private ?string $smoker;

        #[ORM\Column(type: 'string', length: 55, nullable: true)]
        private ?string $animalIsAccept;

        #[ORM\Column(type: 'string', length: 55, nullable: true)]
        private ?string $partyIsAccept;

        #[ORM\Column(type: 'string', length: 55, nullable: true)]
        private ?string $profil;

        #[ORM\ManyToOne(targetEntity: HousingGeneralInfo::class, inversedBy: 'configurations')]
        #[ORM\JoinColumn(name: 'housing_id', referencedColumnName: 'housing_id', nullable: false)]
        private ?HousingGeneralInfo $housingGeneralInfo;


        //setters
        public function setId(int $id): void
        {
            $this->id = $id;
        }

        public function setWhereToSleep(?string $whereToSleep): void
        {
            $this->whereToSleep = $whereToSleep;
        }

        public function setPeopleCanStay(?int $peopleCanStay): void
        {
            $this->peopleCanStay = $peopleCanStay;
        }

        public function setNumberOfBathroom(?int $numberOfBathroom): void
        {
            $this->numberOfBathroom = $numberOfBathroom;
        }

        public function setKidsIsAccept(?string $kidsIsAccept): void
        {
            $this->kidsIsAccept = $kidsIsAccept;
        }

        public function setBabyBed(?string $babyBed): void
        {
            $this->babyBed = $babyBed;
        }

        public function setHousingArea(?int $housingArea): void
        {
            $this->housingArea = $housingArea;
        }

        public function setHomeEquipment(?string $homeEquipment): void
        {
            $this->homeEquipment = $homeEquipment;
        }

        public function setLunch(?string $lunch): void
        {
            $this->lunch = $lunch;
        }

        public function setCarPark(?string $carPark): void
        {
            $this->carPark = $carPark;
        }

        public function setMyLanguage(?string $myLanguage): void
        {
            $this->myLanguage = $myLanguage;
        }

        public function setSmoker(?string $smoker): void
        {
            $this->smoker = $smoker;
        }

        public function setAnimalIsAccept(?string $animalIsAccept): void
        {
            $this->animalIsAccept = $animalIsAccept;
        }

        public function setPartyIsAccept(?string $partyIsAccept): void
        {
            $this->partyIsAccept = $partyIsAccept;
        }

        public function setProfil(?string $profil): void
        {
            $this->profil = $profil;
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

        public function getWhereToSleep(): ?string
        {
            return $this->whereToSleep;
        }

        public function getPeopleCanStay(): ?int
        {
            return $this->peopleCanStay;
        }

        public function getNumberOfBathroom(): ?int
        {
            return $this->numberOfBathroom;
        }

        public function getKidsIsAccept(): ?string
        {
            return $this->kidsIsAccept;
        }

        public function getBabyBed(): ?string
        {
            return $this->babyBed;
        }

        public function getHousingArea(): ?int
        {
            return $this->housingArea;
        }

        public function getHomeEquipment(): ?string
        {
            return $this->homeEquipment;
        }

        public function getLunch(): ?string
        {
            return $this->lunch;
        }

        public function getCarPark(): ?string
        {
            return $this->carPark;
        }

        public function getMyLanguage(): ?string
        {
            return $this->myLanguage;
        }

        public function getSmoker(): ?string
        {
            return $this->smoker;
        }

        public function getAnimalIsAccept(): ?string
        {
            return $this->animalIsAccept;
        }

        public function getPartyIsAccept(): ?string
        {
            return $this->partyIsAccept;
        }

        public function getProfil(): ?string
        {
            return $this->profil;
        }

        public function getHousingGeneralInfo(): ?HousingGeneralInfo
        {
            return $this->housingGeneralInfo;
        }
    }