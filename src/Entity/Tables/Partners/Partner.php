<?php

    namespace App\Entity\Tables\Partners;

    use Doctrine\ORM\Mapping as ORM;
    use Symfony\Component\Security\Core\User\UserInterface;
    use Symfony\Component\Security\Core\User\PasswordAuthenticatedUserInterface;

    #[ORM\Entity]
    #[ORM\Table(name: 'partners')]
    class Partner implements UserInterface, PasswordAuthenticatedUserInterface
    {
        #[ORM\Id]
        #[ORM\GeneratedValue(strategy: 'AUTO')]
        #[ORM\Column(type: 'integer')]
        private int $id;

        #[ORM\Column(type: 'string', length: 55, unique: true)]
        private string $email;

        #[ORM\Column(type: 'string', length: 55)]
        private string $firstName;

        #[ORM\Column(type: 'string', length: 25)]
        private string $lastName;

        #[ORM\Column(type: 'string', length: 128)]
        private string $contact;

        #[ORM\Column(type: 'string')]
        private string $password;

        #[ORM\Column]
        private array $roles = [];


        //setters
        public function setId(int $id): void
        {
            $this->id = $id;
        }

        public function setEmail(string $email): void
        {
            $this->email = $email;
        }

        public function setFirstName(string $firstName): void
        {
            $this->firstName = $firstName;
        }

        public function setLastName(string $lastName): void
        {
            $this->lastName = $lastName;
        }

        public function setContact(string $contact): void
        {
            $this->contact = $contact;
        }

        public function setPassword(string $password): void
        {
            $this->password = $password;
        }

        public function setRoles(array $roles): void
        {
            $this->roles = $roles;
        }



        //getters
        public function getId(): int
        {
            return $this->id;
        }

        public function getEmail(): string
        {
            return $this->email;
        }

        public function getFirstName(): string
        {
            return $this->firstName;
        }

        public function getLastName(): string
        {
            return $this->lastName;
        }

        public function getContact(): string
        {
            return $this->contact;
        }

        public function getPassword(): ?string
        {
            return $this->password;
        }

        public function getRoles(): array
        {
            $roles = $this->roles;

            if(!in_array('ROLE_PARTNER', $roles)) {
                $roles[] = 'ROLE_PARTNER';
            }

            return $roles;
        }

        public function getUserIdentifier(): string
        {
            return $this->email;
        }

        public function eraseCredentials(): void
        {
        }
    }