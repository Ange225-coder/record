<?php

    namespace App\Entity\Tables\Users;

    use Doctrine\ORM\Mapping as ORM;
    use Symfony\Component\Security\Core\User\UserInterface;
    use Symfony\Component\Security\Core\User\PasswordAuthenticatedUserInterface;

    #[ORM\Entity]
    #[ORM\Table(name: 'users')]
    class Users implements UserInterface, PasswordAuthenticatedUserInterface
    {
        #[ORM\Id]
        #[ORM\GeneratedValue(strategy: 'AUTO')]
        #[ORM\Column(type: 'integer')]
        private int $id;

        #[ORM\Column(type: 'string', length: 25, nullable: true)]
        private ?string $lastName;

        #[ORM\Column(type: 'string', length: 50, nullable: true)]
        private ?string $firstName;

        #[ORM\Column(type: 'string', length: 25, nullable: true)]
        private ?string $publicName;

        #[ORM\Column(type: 'string', length: 128, unique: true)]
        private string $email;

        #[ORM\Column(type: 'string')]
        private string $password;

        #[ORM\Column(type: 'datetime', nullable: true)]
        private ?\DateTime $dateOfBirth;

        #[ORM\Column(type: 'string', length: 25, nullable: true)]
        private ?string $nationality;

        #[ORM\Column(type: 'string', nullable: true)]
        private ?string $gender;

        #[ORM\Column(type: 'string', nullable: true)]
        private ?string $address;

        #[ORM\Column(type: 'string', nullable: true)]
        private ?string $passportDetails;

        #[ORM\Column(type: 'string', nullable: true)]
        private ?string $picture;

        #[ORM\Column]
        private array $roles = [];

        //setters
        public function setId(int $id): void
        {
            $this->id = $id;
        }

        public function setLastName(string $lastName): void
        {
            $this->lastName = $lastName;
        }

        public function setFirstName(string $firstName): void
        {
            $this->firstName = $firstName;
        }

        public function setPublicName(string $publicName): void
        {
            $this->publicName = $publicName;
        }

        public function setEmail(string $email): void
        {
            $this->email = $email;
        }

        public function setPassword(string $password): void
        {
            $this->password = $password;
        }

        public function setDateOfBirth(\DateTime $dateOfBirth): void
        {
            $this->dateOfBirth = $dateOfBirth;
        }

        public function setNationality(string $nationality): void
        {
            $this->nationality = $nationality;
        }

        public function setGender(string $gender): void
        {
            $this->gender = $gender;
        }

        public function setAddress(string $address): void
        {
            $this->address = $address;
        }

        public function setPassportDetails(string $passportDetails): void
        {
            $this->passportDetails = $passportDetails;
        }

        public function setPicture(string $picture): void
        {
            $this->picture = $picture;
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

        public function getLastName(): string
        {
            return $this->lastName;
        }

        public function getFirstName(): string
        {
            return $this->firstName;
        }

        public function getPublicName(): string
        {
            return $this->publicName;
        }

        public function getEmail(): string
        {
            return $this->email;
        }

        public function getPassword(): ?string
        {
            return $this->password;
        }

        public function getDateOfBirth(): \DateTime
        {
            return $this->dateOfBirth;
        }

        public function getNationality(): string
        {
            return $this->nationality;
        }

        public function getGender(): string
        {
            return $this->gender;
        }

        public function getAddress(): string
        {
            return $this->address;
        }

        public function getPassportDetails(): string
        {
            return $this->passportDetails;
        }

        public function getPicture(): string
        {
            return $this->picture;
        }

        public function getRoles(): array
        {
            $roles = $this->roles;

            if(!in_array('ROLE_USER', $roles)) {
                $roles[] = 'ROLE_USER';
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