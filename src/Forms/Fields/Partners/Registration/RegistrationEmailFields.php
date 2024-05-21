<?php

    namespace App\Forms\Fields\Partners\Registration;

    use Symfony\Component\Validator\Constraints as Assert;

    class RegistrationEmailFields
    {
        #[Assert\NotBlank(message: 'Veuillez saisir votre adresse e-mail.')]
        #[Assert\Email(message: 'Vérifier que l\'adresse e-mail que vous avez choisi est correcte')]
        private string $email;


        public function setEmail(string $email): void
        {
            $this->email = $email;
        }

        public function getEmail(): string
        {
            return $this->email;
        }
    }