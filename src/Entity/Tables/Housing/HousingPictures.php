<?php

    namespace App\Entity\Tables\Housing;

    use Doctrine\ORM\Mapping as ORM;

    #[ORM\Entity]
    #[ORM\Table(name: 'housing_pictures')]
    class HousingPictures
    {
        #[ORM\Id]
        #[ORM\GeneratedValue(strategy: 'AUTO')]
        #[ORM\Column(type: 'integer')]
        private int $id;

        #[ORM\Column(type: 'string', nullable: false)]
        private string $teaserPic;

        #[ORM\Column(type: 'string', nullable: true)]
        private string $picTwo;

        #[ORM\Column(type: 'string', nullable: true)]
        private string $picThree;

        #[ORM\Column(type: 'string', nullable: true)]
        private string $picFor;

        #[ORM\Column(type: 'string', nullable: true)]
        private string $picFive;

        #[ORM\Column(type: 'string', nullable: true)]
        private string $picSix;

        #[ORM\ManyToOne(targetEntity: HousingGeneralInfo::class, inversedBy: 'pictures')]
        #[ORM\JoinColumn(name: 'housing_id', referencedColumnName: 'housing_id', nullable: false)]
        private ?HousingGeneralInfo $housingGeneralInfo;


        //setters
        public function setId(int $id): void
        {
            $this->id = $id;
        }

        public function setTeaserPic(string $teaserPic): void
        {
            $this->teaserPic = $teaserPic;
        }

        public function setPicTwo(string $picTwo): void
        {
            $this->picTwo = $picTwo;
        }

        public function setPicThree(string $picThree): void
        {
            $this->picThree = $picThree;
        }

        public function setPicFor(string $picFor): void
        {
            $this->picFor = $picFor;
        }

        public function setPicFive(string $picFive): void
        {
            $this->picFive = $picFive;
        }

        public function setPicSix(string $picSix): void
        {
            $this->picSix = $picSix;
        }

        public function setHousingGeneralInfo(?HousingGeneralInfo $housingGeneralInfo): void
        {
            $this->housingGeneralInfo = $housingGeneralInfo;
        }


        //getters
        public function getId(): int
        {
            return $this->id;
        }

        public function getTeaserPic(): string
        {
            return $this->teaserPic;
        }

        public function getPicTwo(): string
        {
            return $this->picTwo;
        }

        public function getPicThree(): string
        {
            return $this->picThree;
        }

        public function getPicFor(): string
        {
            return $this->picFor;
        }

        public function getPicFive(): string
        {
            return $this->picFive;
        }

        public function getPicSix(): string
        {
            return $this->picSix;
        }

        public function getHousingGeneralInfo(): ?HousingGeneralInfo
        {
            return $this->housingGeneralInfo;
        }
    }