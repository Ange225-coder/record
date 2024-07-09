<?php

    namespace App\Forms\Fields\Public\Housing;

    use Symfony\Component\Validator\Constraints as Assert;

    class HousingReservationMyInfosFields
    {
        #[Assert\NotBlank(message: 'Veuillez indiquer votre prénom')]
        private string $firstName;

        #[Assert\NotBlank(message: 'Veuillez indiquer votre nom de famille')]
        private string $lastName;

        #[Assert\NotBlank(message: 'Veuillez indiquer votre adresse e-mail')]
        #[Assert\Email(message: 'Entrez un format d\'e-mail correct')]
        private string $email;
        private string $location;

        #[Assert\NotBlank(message: 'Veuillez indiquer votre numéro de téléphone')]
        #[Assert\Regex(
            pattern:'#(01|05|07)[0-9]{8}$#',
            message: 'Veuillez indiquer votre numéro de téléphone'
        )]
        private string $phone;

        //setters
        public function setEmail(string $email): void
        {
            $this->email = $email;
        }

        public function setPhone(string $phone): void
        {
            $this->phone = $phone;
        }

        public function setLocation(string $location): void
        {
            $this->location = $location;
        }

        public function setLastName(string $lastName): void
        {
            $this->lastName = $lastName;
        }

        public function setFirstName(string $firstName): void
        {
            $this->firstName = $firstName;
        }


        //getters
        public function getEmail(): string
        {
            return $this->email;
        }

        public function getPhone(): string
        {
            return $this->phone;
        }

        public function getLocation(): string
        {
            return $this->location;
        }

        public function getFirstName(): string
        {
            return $this->firstName;
        }

        public function getLastName(): string
        {
            return $this->lastName;
        }
    }