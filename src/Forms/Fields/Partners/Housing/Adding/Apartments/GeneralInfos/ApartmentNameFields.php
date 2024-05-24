<?php

    namespace App\Forms\Fields\Partners\Housing\Adding\Apartments\GeneralInfos;

    use Symfony\Component\Validator\Constraints as Assert;

    class ApartmentNameFields
    {
        #[Assert\NotBlank(message: 'Veuillez renseigner un nom pour votre établissement')]
        private string $apartmentName;


        public function setApartmentName(string $apartmentName): void
        {
            $this->apartmentName = $apartmentName;
        }

        public function getApartmentName(): string
        {
            return $this->apartmentName;
        }
    }