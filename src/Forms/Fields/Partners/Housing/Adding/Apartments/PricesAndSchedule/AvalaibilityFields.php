<?php

    namespace App\Forms\Fields\Partners\Housing\Adding\Apartments\PricesAndSchedule;

    use Symfony\Component\Validator\Constraints as Assert;

    class AvalaibilityFields
    {
        #[Assert\NotBlank(message: 'Veuillez sélectionner une option')]
        private string $arrivalDate;

        #[Assert\NotBlank(message: 'Veuillez sélectionner une option')]
        private string $avalaibilitySynchronisation;

        #[Assert\NotBlank(message: 'Veuillez sélectionner une option')]
        private string $stayOfMoreThanThirtyNights;


        //setters
        public function setArrivalDate(string $arrivalDate): void
        {
            $this->arrivalDate = $arrivalDate;
        }

        public function setAvalaibilitySynchronisation(string $avalaibilitySynchronisation): void
        {
            $this->avalaibilitySynchronisation = $avalaibilitySynchronisation;
        }

        public function setStayOfMoreThanThirtyNights(string $stayOfMoreThanThirtyNights): void
        {
            $this->stayOfMoreThanThirtyNights = $stayOfMoreThanThirtyNights;
        }


        //getters
        public function getArrivalDate(): string
        {
            return $this->arrivalDate;
        }

        public function getAvalaibilitySynchronisation(): string
        {
            return $this->avalaibilitySynchronisation;
        }

        public function getStayOfMoreThanThirtyNights(): string
        {
            return $this->stayOfMoreThanThirtyNights;
        }
    }