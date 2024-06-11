<?php

    namespace App\Forms\Fields\Partners\Housing\Adding\Apartments\RevisionAndFinalization;

    use Symfony\Component\Validator\Constraints as Assert;
    use Symfony\Component\Validator\Context\ExecutionContextInterface;

    class HousingFinalizationFields
    {
        #[Assert\NotBlank(message: 'Veuillez sélectionner une option')]
        private string $housing_choices;

        private ?string $social_reason = null;

        #[Assert\NotBlank(message: 'Ajouter le prénom de la partie contractante tel qu\'indiqué sur sa piece d\'identité.')]
        private string $first_name;

        private ?string $other_first_name = null;

        #[Assert\NotBlank(message: 'Ajouter nom de la partie contractante tel qu\'indiqué sur sa piece d\'identité.')]
        private string $last_name;

        #[Assert\NotBlank(message: 'Ajouter l\'adresse email de la partie contractante')]
        #[Assert\Email(message: 'Il semble que l\' adresse e-mail ne soit pas correct. Veuillez réessayer.')]
        private string $email;

        #[Assert\NotBlank(message: 'Ajouter le numéro de la partie contractante')]
        #[Assert\Regex(
            pattern:'#^225(01|05|07)[0-9]{8}$#',
            message: 'Il semble que le numéro de téléphone ne soit pas correct. Veuillez réessayer.'
        )]
        private string $phone;

        #[Assert\NotBlank(message: 'Ajoutez le pays de résidence principale de la partie contractante')]
        private string $location;

        #[Assert\NotBlank(message: 'Ajoutez l\'adresse (ligne 1) de la résidence de la partie contractante.')]
        private string $first_address;

        private ?string $second_address = null;

        #[Assert\NotBlank(message: 'Ajoutez la ville de résidence principale de la partie contractante')]
        private string $town;

        private ?string $postal_code = null;

        #[Assert\NotBlank(message: 'Pour continuer, confirmez qu\'il s\'agit bien d\'une activité d\'hébergement légale disposant de tous les justificatifs nécessaires.')]
        private array $generalConditions;

        /**
         * this function make the field social_reason required when the field commercial_entity is selected
         */
        #[Assert\Callback]
        public function validate(ExecutionContextInterface $context): void
        {
            if($this->housing_choices === 'commercial_entity' && empty($this->social_reason)) {
                $context->buildViolation('Ajouter une raison sociales')
                    ->atPath('social_reason')
                    ->addViolation()
                ;
            }
        }

        //setters
        public function setHousingChoices(string $housing_choices): void
        {
            $this->housing_choices = $housing_choices;
        }
        public function setSocialReason(?string $social_reason): void
        {
            $this->social_reason = $social_reason;
        }
        public function setFirstName(string $first_name): void
        {
            $this->first_name = $first_name;
        }

        public function setOtherFirstName(?string $other_first_name): void
        {
            $this->other_first_name = $other_first_name;
        }

        public function setLastName(string $last_name): void
        {
            $this->last_name = $last_name;
        }

        public function setEmail(string $email): void
        {
            $this->email = $email;
        }

        public function setPhone(string $phone): void
        {
            $this->phone = $phone;
        }

        public function setTown(string $town): void
        {
            $this->town = $town;
        }

        public function setFirstAddress(string $first_address): void
        {
            $this->first_address = $first_address;
        }

        public function setLocation(string $location): void
        {
            $this->location = $location;
        }

        public function setPostalCode(?string $postal_code): void
        {
            $this->postal_code = $postal_code;
        }

        public function setSecondAddress(?string $second_address): void
        {
            $this->second_address = $second_address;
        }

        public function setGeneralConditions(array $generalConditions): void
        {
            $this->generalConditions = $generalConditions;
        }




        //getters
        public function getHousingChoices(): string
        {
            return $this->housing_choices;
        }
        public function getSocialReason(): ?string
        {
            return $this->social_reason;
        }
        public function getPostalCode(): ?string
        {
            return $this->postal_code;
        }

        public function getTown(): string
        {
            return $this->town;
        }

        public function getLastName(): string
        {
            return $this->last_name;
        }

        public function getFirstName(): string
        {
            return $this->first_name;
        }

        public function getEmail(): string
        {
            return $this->email;
        }

        public function getFirstAddress(): string
        {
            return $this->first_address;
        }

        public function getLocation(): string
        {
            return $this->location;
        }

        public function getOtherFirstName(): ?string
        {
            return $this->other_first_name;
        }

        public function getPhone(): string
        {
            return $this->phone;
        }

        public function getSecondAddress(): ?string
        {
            return $this->second_address;
        }

        public function getGeneralConditions(): array
        {
            return $this->generalConditions;
        }
    }