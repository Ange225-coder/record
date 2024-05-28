<?php

    namespace App\Forms\Fields\Partners\Housing\Adding\Apartments\Configurations;

    use Symfony\Component\Validator\Constraints as Assert;

    class ApartmentEquipmentsFields
    {
        private array $generalEquipments;
        private array $kitchenAndCleaning;
        private array $entertainment;
        private array  $outdoorView;

        //setters
        public function setGeneralEquipments(array $generalEquipments): void
        {
            $this->generalEquipments = $generalEquipments;
        }

        public function setKitchenAndCleaning(array $kitchenAndCleaning): void
        {
            $this->kitchenAndCleaning = $kitchenAndCleaning;
        }

        public function setEntertainment(array $entertainment): void
        {
            $this->entertainment = $entertainment;
        }

        public function setOutdoorView(array $outdoorView): void
        {
            $this->outdoorView = $outdoorView;
        }



        //getters
        public function getGeneralEquipments(): array
        {
            return $this->generalEquipments;
        }

        public function getKitchenAndCleaning(): array
        {
            return $this->kitchenAndCleaning;
        }

        public function getEntertainment(): array
        {
            return $this->entertainment;
        }

        public function getOutdoorView(): array
        {
            return $this->outdoorView;
        }

    }