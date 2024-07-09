<?php

    namespace  App\Forms\Fields\Public\Housing;

    class HousingReservationLastStepFields
    {
        private array $privacyPolicy;


        public function setPrivacyPolicy(array $privacyPolicy): void
        {
            $this->privacyPolicy = $privacyPolicy;
        }

        public function getPrivacyPolicy(): array
        {
            return $this->privacyPolicy;
        }
    }