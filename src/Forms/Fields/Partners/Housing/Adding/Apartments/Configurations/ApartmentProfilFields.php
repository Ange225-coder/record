<?php

    namespace App\Forms\Fields\Partners\Housing\Adding\Apartments\Configurations;

    class ApartmentProfilFields
    {
        private ?string $apartmentProfil;
        private ?string $areaProfil;
        private null $noComment;

        //setters
        public function setApartmentProfil(?string $apartmentProfil): void
        {
            $this->apartmentProfil = $apartmentProfil;
        }

        public function setAreaProfil(?string $areaProfil): void
        {
            $this->areaProfil = $areaProfil;
        }

        public function setNoComment(null $noComment): void
        {
            $this->noComment = $noComment;
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

        public function getNoComment(): null
        {
            return $this->noComment;
        }
    }