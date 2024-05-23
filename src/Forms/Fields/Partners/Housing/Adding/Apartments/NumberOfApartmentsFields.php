<?php

    namespace App\Forms\Fields\Partners\Housing\Adding\Apartments;

    use Symfony\Component\Validator\Constraints as Assert;

    class NumberOfApartmentsFields
    {
        #[Assert\NotBlank(message: 'Veuillez choisir un type d\'appartement')]
        private string $numberOfApartment;


        public function setNumberOfApartment(string $numberOfApartment): void
        {
            $this->numberOfApartment = $numberOfApartment;
        }

        public function getNumberOfApartment(): string
        {
            return $this->numberOfApartment;
        }
    }