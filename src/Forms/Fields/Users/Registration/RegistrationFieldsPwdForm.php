<?php

    namespace App\Forms\Fields\Users\Registration;

    use Symfony\Component\Validator\Constraints as Assert;

    class RegistrationFieldsPwdForm
    {
        #[Assert\NotBlank(message: 'Veuillez saisir votre nouveau mot de passe')]
        #[Assert\Length(
            min: 10,
            minMessage: 'Votre mot de passe doit comporter au moins 10 caractères'
        )]
        private string $password;

        #[Assert\NotBlank(message: 'Merci de confirmer votre mot de passe')]
        private string $confirmPwd;

        //setters
        public function setPassword(string $password): void
        {
            $this->password = $password;
        }

        public function setConfirmPwd(string $confirmPwd): void
        {
            $this->confirmPwd = $confirmPwd;
        }


        //getters
        public function getPassword(): string
        {
            return $this->password;
        }

        public function getConfirmPwd(): string
        {
            return $this->confirmPwd;
        }
    }