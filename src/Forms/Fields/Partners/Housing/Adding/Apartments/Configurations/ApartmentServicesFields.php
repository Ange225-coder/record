<?php

    namespace App\Forms\Fields\Partners\Housing\Adding\Apartments\Configurations;

    use Symfony\Component\Validator\Constraints as Assert;

    class ApartmentServicesFields
    {
        #[Assert\NotBlank(message: 'Veuillez choisir une option')]
        private string $lunch;

        #[Assert\NotBlank(message: 'Veuillez choisir une option')]
        private string $carPark;


        //setters
        public function setLunch(string $lunch): void
        {
            $this->lunch = $lunch;
        }

        public function setCarPark(string $carPark): void
        {
            $this->carPark = $carPark;
        }


        //getters
        public function getLunch(): string
        {
            return $this->lunch;
        }

        public function getCarPark(): string
        {
            return $this->carPark;
        }
    }