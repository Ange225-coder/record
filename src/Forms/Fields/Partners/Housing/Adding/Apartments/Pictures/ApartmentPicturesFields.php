<?php

    namespace App\Forms\Fields\Partners\Housing\Adding\Apartments\Pictures;

    use Symfony\Component\Validator\Constraints as Assert;

    class ApartmentPicturesFields
    {
        #[Assert\NotBlank(message: 'Entrez au moins une photo d\'accroche')]
        #[Assert\File(
            maxSize: '2M',
            mimeTypes: ["image/jpeg", "image/png", "image/jpg", /*"image/jfif"*/],
            maxSizeMessage: 'Les fichiers ne doivent pas dépasser 2 Mo',
            mimeTypesMessage: 'Les fichiers doivent être au format jpg, jpeg ou png',
        )]
        private string $teaserPic;

        #[Assert\File(
            maxSize: '2M',
            mimeTypes: ["image/jpeg", "image/png", "image/jpg", /*"image/jfif"*/],
            maxSizeMessage: 'Les fichiers ne doivent pas dépasser 2 Mo',
            mimeTypesMessage: 'Les fichiers doivent être au format jpg, jpeg ou png',
        )]
        private ?string $picTwo;

        #[Assert\File(
            maxSize: '2M',
            mimeTypes: ["image/jpeg", "image/png", "image/jpg", /*"image/jfif"*/],
            maxSizeMessage: 'Les fichiers ne doivent pas dépasser 2 Mo',
            mimeTypesMessage: 'Les fichiers doivent être au format jpg, jpeg ou png',
        )]
        private ?string $picThree;

        #[Assert\File(
            maxSize: '2M',
            mimeTypes: ["image/jpeg", "image/png", "image/jpg", /*"image/jfif"*/],
            maxSizeMessage: 'Les fichiers ne doivent pas dépasser 2 Mo',
            mimeTypesMessage: 'Les fichiers doivent être au format jpg, jpeg ou png',
        )]
        private ?string $picFor;

        #[Assert\File(
            maxSize: '2M',
            mimeTypes: ["image/jpeg", "image/png", "image/jpg", /*"image/jfif"*/],
            maxSizeMessage: 'Les fichiers ne doivent pas dépasser 2 Mo',
            mimeTypesMessage: 'Les fichiers doivent être au format jpg, jpeg ou png',
        )]
        private ?string $picFive;

        #[Assert\File(
            maxSize: '2M',
            mimeTypes: ["image/jpeg", "image/png", "image/jpg", /*"image/jfif"*/],
            maxSizeMessage: 'Les fichiers ne doivent pas dépasser 2 Mo',
            mimeTypesMessage: 'Les fichiers doivent être au format jpg, jpeg ou png',
        )]
        private ?string $picSix;


        //setters
        public function setTeaserPic(string $teaserPic): void
        {
            $this->teaserPic = $teaserPic;
        }

        public function setPicTwo(?string $picTwo): void
        {
            $this->picTwo = $picTwo;
        }

        public function setPicThree(?string $picThree): void
        {
            $this->picThree = $picThree;
        }

        public function setPicFor(?string $picFor): void
        {
            $this->picFor = $picFor;
        }

        public function setPicFive(?string $picFive): void
        {
            $this->picFive = $picFive;
        }

        public function setPicSix(?string $picSix): void
        {
            $this->picSix = $picSix;
        }


        //getters
        public function getTeaserPic(): string
        {
            return $this->teaserPic;
        }

        public function getPicTwo(): ?string
        {
            return $this->picTwo;
        }

        public function getPicThree(): ?string
        {
            return $this->picThree;
        }

        public function getPicFor(): ?string
        {
            return $this->picFor;
        }

        public function getPicFive(): ?string
        {
            return $this->picFive;
        }

        public function getPicSix(): ?string
        {
            return $this->picSix;
        }
    }