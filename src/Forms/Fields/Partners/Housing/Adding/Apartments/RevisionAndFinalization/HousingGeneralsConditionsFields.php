<?php

    namespace App\Forms\Fields\Partners\Housing\Adding\Apartments\RevisionAndFinalization;

    use Symfony\Component\Validator\Constraints as Assert;

    class HousingGeneralsConditionsFields
    {
        #[Assert\NotBlank(message: 'Pour continuer, confirmez qu\'il s\'agit bien d\'une activité d\'hébergement légale disposant de tous les justificatifs nécessaires.')]
        private array $generalsConditions;


        public function setGeneralsConditions(array $generalsConditions): void
        {
            $this->generalsConditions = $generalsConditions;
        }

        public function getGeneralsConditions(): array
        {
            return $this->generalsConditions;
        }
    }