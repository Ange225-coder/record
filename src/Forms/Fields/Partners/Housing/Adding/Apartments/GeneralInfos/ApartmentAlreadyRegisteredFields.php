<?php

    namespace App\Forms\Fields\Partners\Housing\Adding\Apartments\GeneralInfos;

    use Symfony\Component\Validator\Constraints as Assert;

    class ApartmentAlreadyRegisteredFields
    {
        #[Assert\NotBlank(message: 'Veuillez sélectionner un choix')]
        private array $whereApartmentIsAlreadyRegistered;


        public function setWhereApartmentIsAlreadyRegistered(array $whereApartmentIsAlreadyRegistered): void
        {
            $this->whereApartmentIsAlreadyRegistered = $whereApartmentIsAlreadyRegistered;
        }

        public function getWhereApartmentIsAlreadyRegistered(): array
        {
            return $this->whereApartmentIsAlreadyRegistered;
        }

    }