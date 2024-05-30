<?php

    namespace App\Forms\Fields\Partners\Housing\Adding\Apartments\Configurations;

    use Symfony\Component\Validator\Constraints as Assert;

    class ApartmentRulesFields
    {
        #[Assert\NotBlank(message: 'Veuillez choisir une option')]
        private string $smoker;

        #[Assert\NotBlank(message: 'Veuillez choisir une option')]
        private string $animalIsAccept;

        #[Assert\NotBlank(message: 'Veuillez choisir une option')]
        private string $partyIsAccept;


        //setters
        public function setSmoker(string $smoker): void
        {
            $this->smoker = $smoker;
        }

        public function setAnimalIsAccept(string $animalIsAccept): void
        {
            $this->animalIsAccept = $animalIsAccept;
        }

        public function setPartyIsAccept(string $partyIsAccept): void
        {
            $this->partyIsAccept = $partyIsAccept;
        }


        //getters
        public function getSmoker(): string
        {
            return $this->smoker;
        }

        public function getAnimalIsAccept(): string
        {
            return $this->animalIsAccept;
        }

        public function getPartyIsAccept(): string
        {
            return $this->partyIsAccept;
        }
    }