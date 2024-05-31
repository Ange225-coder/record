<?php

    namespace App\Forms\Types\Partners\Housing\Adding\Apartments\Configurations;

    use Symfony\Component\Form\AbstractType;
    use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
    use App\Forms\Fields\Partners\Housing\Adding\Apartments\Configurations\ApartmentProfilFields;
    use Symfony\Component\Form\Extension\Core\Type\TextareaType;
    use Symfony\Component\Form\FormBuilderInterface;
    use Symfony\Component\OptionsResolver\OptionsResolver;

    class ApartmentProfilTypes extends AbstractType
    {
        public function buildForm(FormBuilderInterface $builder, array $options): void
        {
            //form groups for each option
            $housing = [
                'L\'hébergement' => 'hebergement',
            ];

            $area = [
                'Le quartier' => 'quartier',
            ];

            $nothing = [
                'aucun' => null
            ];


            //build forms
            $builder
                ->add('apartmentProfil', ChoiceType::class, [
                    'label' => 'profil de l\'appartement',
                    'choices' => $housing,
                    'expanded' => true,
                    'multiple' => true,
                    'mapped' => false,
                ])

                ->add('apartmentDetails', TextareaType::class, [
                    'label' => 'A propos de l\'hébergement',
                    'required' => false,
                    'attr' => [
                        'class' => 'apartment-details',
                        'style' => 'display: none;',
                        'placeholder' => 'En quoi votre hébergement est-il unique ?',
                    ]
                ])

                ->add('areaProfil', ChoiceType::class, [
                    'label' => 'profil du quartier',
                    'choices' => $area,
                    'expanded' => true,
                    'multiple' => true,
                    'mapped' => false,
                ])

                ->add('areaDetails', TextareaType::class, [
                    'label' => 'A propos du quartier',
                    'required' => false,
                    'attr' => [
                        'class' => 'area-details',
                        'style' => 'display: none;',
                        'placeholder' => 'A quoi ressemble les environs ?',
                    ]
                ])

                ->add('noComment', ChoiceType::class, [
                    'choices' => $nothing,
                    'expanded' => true,
                    'multiple' => true,
                ])
            ;
        }


        public function configureOptions(OptionsResolver $resolver): void
        {
            $resolver->setDefaults([
                'data_class' => ApartmentProfilFields::class,
            ]);
        }
    }