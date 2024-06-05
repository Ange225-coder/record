<?php

    namespace App\Forms\Fields\Partners\Housing\Adding\Apartments\PricesAndSchedule;

    use Symfony\Component\Validator\Constraints as Assert;

    class PricePerNightFields
    {
        #[Assert\NotBlank(message: 'Veuillez entrer un montant')]
        #[Assert\Positive(message: 'Le montant doit être un nombre positif')]
        private int $pricePerNight;


        public function setPricePerNight(int $pricePerNight): void
        {
            $this->pricePerNight = $pricePerNight;
        }

        public function getPricePerNight(): int
        {
            return $this->pricePerNight;
        }
    }