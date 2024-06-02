<?php

    namespace App\Forms\Fields\Partners\Housing\Adding\Apartments\Pictures;

    use Symfony\Component\Validator\Constraints as Assert;

    class ApartmentPicturesFields
    {
        #[Assert\All(
            new Assert\File(
                maxSize: '47MB',
                mimeTypes: ["image/jpg", "image/jpeg", "image/png"],
                maxSizeMessage: 'Ne dépassez pas 47 MB par fichier',
                mimeTypesMessage: 'Les fichiers doivent être au format jpg, jpeg, ou png'
            )
        )]

        private null|array $pictures;


        public function setPictures(array|null $pictures): void
        {
            $this->pictures = $pictures;
        }

        public function getPictures(): array|null
        {
            return $this->pictures;
        }
    }