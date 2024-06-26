<?php

    namespace App\Forms\Types\Partners\Housing\Adding\Apartments\GeneralInfos;

    use App\Forms\Fields\Partners\Housing\Adding\Apartments\GeneralInfos\ApartmentAlreadyRegisteredFields;
    use Symfony\Component\Form\AbstractType;
    use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
    use Symfony\Component\Form\FormBuilderInterface;
    use Symfony\Component\OptionsResolver\OptionsResolver;

    class ApartmentAlreadyRegisteredTypes extends AbstractType
    {
        public function buildForm(FormBuilderInterface $builder, array $options): void
        {
            $builder
                ->add('whereApartmentIsAlreadyRegistered', ChoiceType::class, [
                    'choices' => [
                        'Airbnb' => 'Airbnb',
                        'TripAdvisor' => 'TripAdvisor',
                        'Vrbo' => 'Vrbo',
                        'Autre' => 'autre',
                        'Mon hébergement n\'est inscrit sur aucun autre site internet' => 'Nothing'
                    ],
                    'expanded' => true,
                    'multiple' => true,
                ])
            ;
        }



        public function configureOptions(OptionsResolver $resolver): void
        {
            $resolver->setDefaults([
                'data_class' => ApartmentAlreadyRegisteredFields::class,
            ]);
        }
    }