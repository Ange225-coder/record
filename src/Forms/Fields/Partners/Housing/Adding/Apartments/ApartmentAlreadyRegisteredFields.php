<?php

    namespace App\Forms\Fields\Partners\Housing\Adding\Apartments;

    use Symfony\Component\Validator\Constraints as Assert;

    class ApartmentAlreadyRegisteredFields
    {
        #[Assert\NotBlank(message: 'Veuillez sélectionner un choix')]
        private string $whereApartmentIsAlreadyRegistered;


        public function setWhereApartmentIsAlreadyRegistered(string $whereApartmentIsAlreadyRegistered): void
        {
            $this->whereApartmentIsAlreadyRegistered = $whereApartmentIsAlreadyRegistered;
        }

        public function getWhereApartmentIsAlreadyRegistered(): string
        {
            return $this->whereApartmentIsAlreadyRegistered;
        }

    }