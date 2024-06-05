<?php

    namespace App\Forms\Fields\Partners\Housing\Adding\Apartments\PricesAndSchedule;

    use Symfony\Component\Validator\Constraints as Assert;

    class HowToReserveFields
    {
        #[Assert\NotBlank(message: 'Veuillez sélectionner un mode de reservation')]
        private string $howToReserve;


        public function setHowToReserve(string $howToReserve): void
        {
            $this->howToReserve = $howToReserve;
        }


        public function getHowToReserve(): string
        {
            return $this->howToReserve;
        }
    }