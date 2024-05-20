<?php

    namespace App\Forms\Fields\Users\Registration;

    use Symfony\Component\Validator\Constraints as Assert;

    class RegistrationFieldsEmailForm
    {
        #[Assert\NotBlank(message: 'Veuillez saisir votre adresse email')]
        #[Assert\Email(message: 'Verifier que l\'adresse email que vous avez choisi est correct')]
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