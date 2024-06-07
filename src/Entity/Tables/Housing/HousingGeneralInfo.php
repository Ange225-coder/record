<?php

    namespace App\Entity\Tables\Housing;

    use Doctrine\Common\Collections\Collection;
    use Doctrine\Common\Collections\ArrayCollection;
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

        #[ORM\OneToMany(targetEntity: HousingConfigurations::class, mappedBy: 'housingGeneralInfo')]
        private Collection $configurations;

        #[ORM\OneToMany(targetEntity: HousingPictures::class, mappedBy: 'housingGeneralInfo')]
        private Collection $pictures;

        #[ORM\OneToMany(targetEntity: HousingPriceAndSchedule::class, mappedBy: 'housingGeneralInfo')]
        private Collection $priceAndSchedule;

        #[ORM\OneToMany(targetEntity: HousingForIndividuals::class, mappedBy: 'housingGeneralInfo')]
        private Collection $housingForIndividuals;

        #[ORM\OneToMany(targetEntity: HousingForCommercialEntity::class, mappedBy: 'housingGeneralInfo')]
        private Collection $housingForCommercialEntity;

        public function __construct()
        {
            $this->configurations = new ArrayCollection();
            $this->pictures = new ArrayCollection();
            $this->priceAndSchedule = new ArrayCollection();
            $this->housingForIndividuals = new ArrayCollection();
            $this->housingForCommercialEntity = new ArrayCollection();
        }


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

        public function addConfiguration(HousingConfigurations $configurations): void
        {
            if(!$this->configurations->contains($configurations)) {
                $this->configurations->add($configurations);
                $configurations->setHousingGeneralInfo($this);
            }
        }

        public function removeConfiguration(HousingConfigurations $configurations): void
        {
            if($this->configurations->removeElement($configurations)) {
                if($configurations->getHousingGeneralInfo() === $this) {
                    $configurations->setHousingGeneralInfo(null);
                }
            }
        }

        public function addPicture(HousingPictures $pictures): void
        {
            if(!$this->pictures->contains($pictures)) {
                $this->pictures->add($pictures);
                $pictures->setHousingGeneralInfo($this);
            }
        }

        public function removePicture(HousingPictures $pictures): void
        {
            if($this->pictures->removeElement($pictures)) {
                if($pictures->getHousingGeneralInfo() === $this) {
                    $pictures->setHousingGeneralInfo(null);
                }
            }
        }

        public function addPriceAndSchedule(HousingPriceAndSchedule $priceAndSchedule): void
        {
            if(!$this->priceAndSchedule->contains($priceAndSchedule)) {
                $this->priceAndSchedule->add($priceAndSchedule);
                $priceAndSchedule->setHousingGeneralInfo($this);
            }
        }

        public function removePriceAndSchedule(HousingPriceAndSchedule $priceAndSchedule): void
        {
            if($this->priceAndSchedule->removeElement($priceAndSchedule)) {
                if($priceAndSchedule->getHousingGeneralInfo() === $this) {
                    $priceAndSchedule->setHousingGeneralInfo(null);
                }
            }
        }

        public function addHousingForIndividuals(HousingForIndividuals $housingForIndividuals): void
        {
            if(!$this->housingForIndividuals->contains($housingForIndividuals)) {
                $this->housingForIndividuals->add($housingForIndividuals);
                $housingForIndividuals->setHousingGeneralInfo($this);
            }
        }

        public function removeHousingForIndividuals(HousingForIndividuals $housingForIndividuals): void
        {
            if($this->housingForIndividuals->removeElement($housingForIndividuals)) {
                if($housingForIndividuals->getHousingGeneralInfo() === $this) {
                    $housingForIndividuals->setHousingGeneralInfo(null);
                }
            }
        }

        public function addHousingForCommercialEntity(HousingForCommercialEntity $housingForCommercialEntity): void
        {
            if(!$this->housingForCommercialEntity->contains($housingForCommercialEntity)) {
                $this->housingForCommercialEntity->add($housingForCommercialEntity);
                $housingForCommercialEntity->setHousingGeneralInfo($this);
            }
        }

        public function removeHousingForCommercialEntity(HousingForCommercialEntity $housingForCommercialEntity): void
        {
            if($this->housingForCommercialEntity->removeElement($housingForCommercialEntity)) {
                if($housingForCommercialEntity->getHousingGeneralInfo() === $this) {
                    $housingForCommercialEntity->setHousingGeneralInfo(null);
                }
            }
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

        public function getConfigurations(): Collection
        {
            return $this->configurations;
        }

        public function getPictures(): Collection
        {
            return $this->pictures;
        }

        public function getPriceAndSchedule(): Collection
        {
            return $this->priceAndSchedule;
        }

        public function getHousingForIndividuals(): Collection
        {
            return $this->housingForIndividuals;
        }

        public function getHousingForCommercialEntity(): Collection
        {
            return $this->housingForCommercialEntity;
        }
    }