<?php

    namespace App\Entity\Tables\Housing;

    use Doctrine\ORM\Mapping as ORM;

    #[ORM\Entity]
    #[ORM\Table(name: 'housing_finalization')]
    class HousingFinalization
    {
        #[ORM\Id]
        #[ORM\GeneratedValue(strategy: 'AUTO')]
        #[ORM\Column(type: 'integer')]
        private int $id;

        #[ORM\Column(type: 'string', length: 125, nullable: true)]
        private ?string $social_reason;

        #[ORM\Column(type: 'string', length: 125)]
        private string $first_name;

        #[ORM\Column(type: 'string', length: 125, nullable: true)]
        private ?string $other_first_name;

        #[ORM\Column(type: 'string', length: 55)]
        private string $last_name;

        #[ORM\Column(type: 'string', length: 128)]
        private string $email;

        #[ORM\Column(type: 'string', length: 55)]
        private string $phone;

        #[ORM\Column(type: 'string', length: 125)]
        private string $location;

        #[ORM\Column(type: 'string', length: 120)]
        private string $first_address;

        #[ORM\Column(type: 'string', length: 120, nullable: true)]
        private ?string $second_address;

        #[ORM\Column(type: 'string', length: 55)]
        private string $town;

        #[ORM\Column(type: 'string', length: 120, nullable: true)]
        private ?string $postal_code;

        #[ORM\Column(type: 'string', length: 55)]
        private string $status = 'ouvert';

        #[ORM\Column(type: 'string', length: 55)]
        private string $partner;

        #[ORM\ManyToOne(targetEntity: HousingGeneralInfo::class, inversedBy: 'housingFinalization')]
        #[ORM\JoinColumn(name: 'housing_id', referencedColumnName: 'housing_id', nullable: false)]
        private ?HousingGeneralInfo $housingGeneralInfo;


        //setters
        public function setId(int $id): void
        {
            $this->id = $id;
        }

        public function setSocialReason(?string $social_reason): void
        {
            $this->social_reason = $social_reason;
        }

        public function setFirstName(string $first_name): void
        {
            $this->first_name = $first_name;
        }

        public function setOtherFirstName(?string $other_first_name): void
        {
            $this->other_first_name = $other_first_name;
        }

        public function setLastName(string $last_name): void
        {
            $this->last_name = $last_name;
        }

        public function setEmail(string $email): void
        {
            $this->email = $email;
        }

        public function setPhone(string $phone): void
        {
            $this->phone = $phone;
        }

        public function setTown(string $town): void
        {
            $this->town = $town;
        }

        public function setStatus(string $status): void
        {
            $this->status = $status;
        }

        public function setFirstAddress(string $first_address): void
        {
            $this->first_address = $first_address;
        }

        public function setLocation(string $location): void
        {
            $this->location = $location;
        }

        public function setPostalCode(?string $postal_code): void
        {
            $this->postal_code = $postal_code;
        }

        public function setSecondAddress(?string $second_address): void
        {
            $this->second_address = $second_address;
        }

        public function setPartner(string $partner): void
        {
            $this->partner = $partner;
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


        public function getSocialReason(): ?string
        {
            return $this->social_reason;
        }

        public function getPostalCode(): ?string
        {
            return $this->postal_code;
        }

        public function getTown(): string
        {
            return $this->town;
        }

        public function getLastName(): string
        {
            return $this->last_name;
        }

        public function getFirstName(): string
        {
            return $this->first_name;
        }

        public function getEmail(): string
        {
            return $this->email;
        }

        public function getFirstAddress(): string
        {
            return $this->first_address;
        }

        public function getLocation(): string
        {
            return $this->location;
        }

        public function getOtherFirstName(): ?string
        {
            return $this->other_first_name;
        }

        public function getStatus(): string
        {
            return $this->status;
        }

        public function getPhone(): string
        {
            return $this->phone;
        }

        public function getSecondAddress(): ?string
        {
            return $this->second_address;
        }

        public function getPartner(): string
        {
            return $this->partner;
        }

        public function getHousingGeneralInfo(): ?HousingGeneralInfo
        {
            return $this->housingGeneralInfo;
        }
    }