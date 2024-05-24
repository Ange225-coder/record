<?php

    namespace App\Forms\Fields\Partners\Housing\Adding\Apartments\GeneralInfos;

    use Symfony\Component\Validator\Constraints as Assert;

    class ApartmentPlaceFields
    {
        private string $country;

        #[Assert\NotBlank(message: 'Veuillez entrer le nom et le numéro de la rue d\'ou se situe l\'appartement')]
        private string $address;
        private ?string $postalCode = null;

        #[Assert\NotBlank(message: 'Veuillez entrer la ville ou se situe l\'appartement')]
        private string $town;

        //setters
        public function setCountry(string $country): void
        {
            $this->country = $country;
        }

        public function setAddress(string $address): void
        {
            $this->address = $address;
        }

        public function setPostalCode(?string $postalCode): void
        {
            $this->postalCode = $postalCode;
        }

        public function setTown(string $town): void
        {
            $this->town = $town;
        }


        //getters
        public function getCountry(): string
        {
            return $this->country;
        }

        public function getAddress(): string
        {
            return $this->address;
        }

        public function getPostalCode(): ?string
        {
            return $this->postalCode;
        }

        public function getTown(): string
        {
            return $this->town;
        }
    }