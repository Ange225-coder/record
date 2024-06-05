<?php

    namespace App\Forms\Types\Partners\Housing\Adding\Apartments\Pictures;

    use Symfony\Component\Form\AbstractType;
    use Symfony\Component\Form\Extension\Core\Type\CollectionType;
    use Symfony\Component\Form\Extension\Core\Type\FileType;
    use App\Forms\Fields\Partners\Housing\Adding\Apartments\Pictures\ApartmentPicturesFields;
    use Symfony\Component\Form\FormBuilderInterface;
    use Symfony\Component\OptionsResolver\OptionsResolver;

    class ApartmentPicturesTypes extends AbstractType
    {
        public function buildForm(FormBuilderInterface $builder, array $options): void
        {
            $builder
                ->add('teaserPic', FileType::class, [
                    'label' => 'Photo d\'accroche',
                ])

                ->add('optionalPics', CollectionType::class, [
                    'label' => 'Image optionnelle',
                    'entry_type' => FileType::class,
                    'entry_options' => [
                        'label' => false,
                        'required' => false,
                    ],
                    'allow_add' => true,
                    'allow_delete' => true,
                    'prototype' => true,
                    'by_reference' => false
                ])
            ;
        }


        public function configureOptions(OptionsResolver $resolver): void
        {
            $resolver->setDefaults([
                'data_class' => ApartmentPicturesFields::class,
            ]);
        }
    }