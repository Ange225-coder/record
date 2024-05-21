<?php

    namespace App\Forms\Fields\Partners\Registration;

    use Symfony\Component\Validator\Constraints as Assert;

    class RegistrationPwdFields
    {
        #[Assert\NotBlank(message: 'Veuillez saisir votre nouveau mot de passe')]
        private string $password;

        #[Assert\NotBlank(message: 'Merci de confirmer votre nouveau mot de passe')]
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