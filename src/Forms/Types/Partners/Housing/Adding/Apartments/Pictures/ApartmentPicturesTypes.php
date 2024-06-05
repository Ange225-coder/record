<?php

    namespace App\Forms\Types\Partners\Housing\Adding\Apartments\Pictures;

    use Symfony\Component\Form\AbstractType;
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
                    'label' => 'Photo d\'accroche *',
                ])

                ->add('picTwo', FileType::class, [
                    'label' => 'Photo 2'
                ])

                ->add('picThree', FileType::class, [
                    'label' => 'Photo 3'
                ])

                ->add('picFor', FileType::class, [
                    'label' => 'Photo 4'
                ])

                ->add('picFive', FileType::class, [
                    'label' => 'Photo 5'
                ])

                ->add('picSix', FileType::class, [
                    'label' => 'Photo 6'
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