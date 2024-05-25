<?php

    namespace App\Forms\Fields\Partners\Housing\Adding\Apartments\Configurations;

    use Symfony\Component\Validator\Constraints as Assert;

    class ApartmentInfoFields
    {
        #[Assert\NotBlank(message: 'Veuillez choisir une option')]
        private string $whereToSleep;

        #[Assert\Positive(message: 'Ce nombre ne peut pas être négatif')]
        #[Assert\NotBlank(message: 'Veuillez indiquer un nombre de personnes')]
        private int $peopleCanStay;

        #[Assert\Positive(message: 'Ce nombre ne peut pas être négatif')]
        #[Assert\NotBlank(message: 'Veuillez indiquer le nombre de salle de bain')]
        private int $numberOfBathroom;

        #[Assert\NotBlank(message: 'Veuillez choisir une option')]
        private string $kidsIsAccept;

        #[Assert\NotBlank(message: 'Veuillez choisir une option')]
        private string $babyBed;

        #[Assert\Positive(message: 'Ce nombre ne peut pas être négatif')]
        private ?int $housingArea;


        //setters
        public function setWhereToSleep(string $whereToSleep): void
        {
            $this->whereToSleep = $whereToSleep;
        }

        public function setPeopleCanStay(int $peopleCanStay): void
        {
            $this->peopleCanStay = $peopleCanStay;
        }

        public function setNumberOfBathroom(int $numberOfBathroom): void
        {
            $this->numberOfBathroom = $numberOfBathroom;
        }

        public function setKidsIsAccept(string $kidsIsAccept): void
        {
            $this->kidsIsAccept = $kidsIsAccept;
        }

        public function setBabyBed(string $babyBed): void
        {
            $this->babyBed = $babyBed;
        }

        public function setHousingArea(?int $housingArea): void
        {
            $this->housingArea = $housingArea;
        }


        //getters
        public function getWhereToSleep(): string
        {
            return $this->whereToSleep;
        }

        public function getPeopleCanStay(): int
        {
            return $this->peopleCanStay;
        }

        public function getNumberOfBathroom(): int
        {
            return $this->numberOfBathroom;
        }

        public function getKidsIsAccept(): string
        {
            return $this->kidsIsAccept;
        }

        public function getBabyBed(): string
        {
            return $this->babyBed;
        }

        public function getHousingArea(): ?int
        {
            return $this->housingArea;
        }
    }