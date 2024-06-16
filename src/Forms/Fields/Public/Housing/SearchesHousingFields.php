<?php

    namespace App\Forms\Fields\Public\Housing;

    use Symfony\Component\Validator\Constraints as Assert;

    class SearchesHousingFields
    {
        #[Assert\NotBlank(message: 'Veuillez indiquer une destination pour lancer la recherche')]
        private string $town;
        private int $peopleCanStay;
        private string $kidIsAccept;

        //setters
        public function setTown(string $town): void
        {
            $this->town = $town;
        }

        public function setPeopleCanStay(int $peopleCanStay): void
        {
            $this->peopleCanStay = $peopleCanStay;
        }

        public function setKidIsAccept(string $kidIsAccept): void
        {
            $this->kidIsAccept = $kidIsAccept;
        }



        //getters
        public function getTown(): string
        {
            return $this->town;
        }

        public function getPeopleCanStay(): int
        {
            return $this->peopleCanStay;
        }

        public function getKidIsAccept(): string
        {
            return $this->kidIsAccept;
        }
    }