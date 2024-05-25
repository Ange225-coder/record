<?php

    namespace App\Forms\Types\Partners\Housing\Adding\Apartments\Configurations;

    use Symfony\Component\Form\AbstractType;
    use Symfony\Component\Form\Extension\Core\Type\IntegerType;
    use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
    use Symfony\Component\Form\FormBuilderInterface;
    use Symfony\Component\OptionsResolver\OptionsResolver;
    use App\Forms\Fields\Partners\Housing\Adding\Apartments\Configurations\ApartmentInfoFields;

    class ApartmentInfoTypes extends AbstractType
    {
        public function buildForm(FormBuilderInterface $builder, array $options): void
        {
            $builder
                ->add('whereToSleep', ChoiceType::class, [
                    'label' => 'Ou les client peuvent-ils dormir ?',
                    'choices' => [
                        'Chambre' => 'chambre',
                        'Salon' => 'salon',
                        'Canapé lit' => 'canapé lit'
                    ],
                    'expanded' => true,
                    'multiple' => false
                ])

                ->add('peopleCanStay', IntegerType::class, [
                    'label' => 'Combien de personnes peuvent séjourner ?',
                    'attr' => [
                        'min' => 1,
                        'value' => 1,
                    ]
                ])

                ->add('numberOfBathroom', IntegerType::class, [
                    'label' => 'Combien y\'a t-il de salle de bain ?',
                    'attr' => [
                        'min' => 1,
                        'value' => 1,
                    ]
                ])

                ->add('kidsIsAccept', ChoiceType::class, [
                    'label' => 'Acceptez-vous les enfants ?',
                    'choices' => [
                        'Oui' => 'oui',
                        'Non' => 'non'
                    ],
                    'expanded' => true,
                    'multiple' => false
                ])

                ->add('babyBed', ChoiceType::class, [
                    'label' => 'Proposez-vous des lits de bébés ?',
                    'choices' => [
                        'Oui' => 'oui',
                        'Non' => 'non'
                    ],
                    'expanded' => true,
                    'multiple' => false
                ])

                ->add('housingArea', IntegerType::class, [
                    'label' => 'Superficie de l\'appartement',
                ])
            ;
        }


        public function configureOptions(OptionsResolver $resolver): void
        {
            $resolver->setDefaults([
                'data_class' => ApartmentInfoFields::class,
            ]);
        }
    }