<?php

    namespace App\Forms\Fields\Partners\Housing\Adding\Apartments\RevisionAndFinalization;

    use Symfony\Component\Validator\Constraints as Assert;

    class HousingChoiceFields
    {
        #[Assert\NotBlank(message: 'Veuillez sélectionner une option')]
        private string $housingChoice;


        public function setHousingChoice(string $housingChoice): void
        {
            $this->housingChoice = $housingChoice;
        }

        public function getHousingChoice(): string
        {
            return $this->housingChoice;
        }
    }