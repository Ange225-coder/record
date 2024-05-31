<?php

    namespace App\Forms\Fields\Partners\Housing\Adding\Apartments\Configurations;

    class ApartmentProfilFields
    {
        //datas of these fields won't go into the database
        private ?string $apartmentProfil;
        private ?string $areaProfil;
        private ?array $noComment;

        //fields for textarea
        //datas of these fields will go into the database
        private ?string $apartmentDetails = null;
        private ?string $areaDetails = null;

        //setters
        public function setApartmentProfil(?string $apartmentProfil): void
        {
            $this->apartmentProfil = $apartmentProfil;
        }

        public function setAreaProfil(?string $areaProfil): void
        {
            $this->areaProfil = $areaProfil;
        }

        public function setNoComment(?array $noComment): void
        {
            $this->noComment = $noComment;
        }

        public function setApartmentDetails(?string $apartmentDetails): void
        {
            $this->apartmentDetails = $apartmentDetails;
        }

        public function setAreaDetails(?string $areaDetails): void
        {
            $this->areaDetails = $areaDetails;
        }


        //getters
        public function getApartmentProfil(): ?string
        {
            return $this->apartmentProfil;
        }

        public function getAreaProfil(): ?string
        {
            return $this->areaProfil;
        }

        public function getNoComment(): ?array
        {
            return $this->noComment;
        }

        public function getApartmentDetails(): ?string
        {
            return $this->apartmentDetails;
        }

        public function getAreaDetails(): ?string
        {
            return $this->areaDetails;
        }
    }