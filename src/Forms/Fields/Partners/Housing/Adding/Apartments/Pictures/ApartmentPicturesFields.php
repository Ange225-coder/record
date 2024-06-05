<?php

    namespace App\Forms\Fields\Partners\Housing\Adding\Apartments\Pictures;

    use Symfony\Component\Validator\Constraints as Assert;
    use Symfony\Component\HttpFoundation\File\UploadedFile;

    class ApartmentPicturesFields
    {
        #[Assert\NotBlank(message: 'Entrez au moins une photo d\'accroche')]
        #[Assert\File(
            maxSize: '2M',
            mimeTypes: ["image/jpeg", "image/png", "image/jpg"],
            maxSizeMessage: 'Les fichiers ne doivent pas dépasser 2 Mo',
            mimeTypesMessage: 'Les fichiers doivent être au format jpg, jpeg ou png',
        )]
        private UploadedFile $teaserPic;

        #[Assert\All(
            new Assert\File(
                maxSize: '2M',
                mimeTypes: ["image/jpeg", "image/png", "image/jpg", /*"image/jfif"*/],
                maxSizeMessage: 'Les fichiers ne doivent pas dépasser 2 Mo',
                mimeTypesMessage: 'Les fichiers doivent être au format jpg, jpeg ou png',
            )
        )]
        private ?array $optionalPics;


        //setters
        public function setTeaserPic(UploadedFile $teaserPic): void
        {
            $this->teaserPic = $teaserPic;
        }

        public function setOptionalPics(?array $optionalPics): void
        {
            $this->optionalPics = $optionalPics;
        }



        //getters
        public function getTeaserPic(): UploadedFile
        {
            return $this->teaserPic;
        }

        public function getOptionalPics(): ?array
        {
            return $this->optionalPics;
        }

    }