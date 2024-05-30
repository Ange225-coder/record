<?php

    namespace App\Forms\Types\Partners\Housing\Adding\Apartments\Configurations;

    use Symfony\Component\Form\AbstractType;
    use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
    use App\Forms\Fields\Partners\Housing\Adding\Apartments\Configurations\ApartmentRulesFields;
    use Symfony\Component\Form\FormBuilderInterface;
    use Symfony\Component\OptionsResolver\OptionsResolver;

    class ApartmentRulesTypes extends AbstractType
    {
        public function buildForm(FormBuilderInterface $builder, array $options): void
        {
            $builder
                ->add('smoker', ChoiceType::class, [
                    'label' => 'Hébergement fumeur',
                    'choices' => [
                        'Oui' => 'oui',
                        'Non' => 'Non'
                    ],
                    'expanded' => true,
                    'multiple' => false,
                ])

                ->add('animalIsAccept', ChoiceType::class, [
                    'label' => 'Animaux domestiques admis',
                    'choices' => [
                        'Oui' => 'oui',
                        'Non' => 'non'
                    ],
                    'expanded' => true,
                    'multiple' => false
                ])


                ->add('partyIsAccept', ChoiceType::class, [
                    'label' => 'Fêtes/événement autorisé',
                    'choices' => [
                        'Oui' => 'oui',
                        'Non' => 'non'
                    ],
                    'expanded' => true,
                    'multiple' => false
                ])
            ;
        }


        public function configureOptions(OptionsResolver $resolver): void
        {
            $resolver->setDefaults([
                'data_class' => ApartmentRulesFields::class,
            ]);
        }
    }