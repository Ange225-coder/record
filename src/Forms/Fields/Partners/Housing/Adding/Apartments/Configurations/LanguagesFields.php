<?php

    namespace App\Forms\Fields\Partners\Housing\Adding\Apartments\Configurations;

    class LanguagesFields
    {
        private ?array $languages;


        public function setLanguages(?array $languages): void
        {
            $this->languages = $languages;
        }


        public function getLanguages(): ?array
        {
            return $this->languages;
        }
    }