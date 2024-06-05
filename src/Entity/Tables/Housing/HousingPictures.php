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

        #[ORM\Column(type: 'json', nullable: true)]
        private ?array $optionalPics = [];

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

        public function setOptionalPics(?array $optionalPics): void
        {
            $this->optionalPics = $optionalPics;
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

        public function getOptionalPics(): ?array
        {
            return $this->optionalPics;
        }

        public function getHousingGeneralInfo(): ?HousingGeneralInfo
        {
            return $this->housingGeneralInfo;
        }
    }