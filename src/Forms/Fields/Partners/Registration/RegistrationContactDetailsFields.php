<?php

    namespace App\Forms\Fields\Partners\Registration;

    use Symfony\Component\Validator\Constraints as Assert;

    class RegistrationContactDetailsFields
    {
        #[Assert\NotBlank(message: 'Veuillez indiquer votre prénom')]
        private string $firstName;

        #[Assert\NotBlank(message: 'Veuillez indiquer votre nom')]
        private string $lastName;

        #[Assert\NotBlank(message: 'Veuillez saisir votre numéro de téléphone')]
        #[Assert\Regex(
            pattern:'#^225(01|05|07)[0-9]{8}$#',
            message: 'Ce numéro de télephone semble incorrect, veuillez entrer un numéro de téléphone ivoirien.'
        )]
        private string $contact;

        //setters
        public function setFirstName(string $firstName): void
        {
            $this->firstName = $firstName;
        }

        public function setLastName(string $lastName): void
        {
            $this->lastName = $lastName;
        }

        public function setContact(string $contact): void
        {
            $this->contact = $contact;
        }


        //getters
        public function getFirstName(): string
        {
            return $this->firstName;
        }

        public function getLastName(): string
        {
            return $this->lastName;
        }

        public function getContact(): string
        {
            return $this->contact;
        }
    }