<?php

    namespace App\Forms\Types\Public\Housing;

    use Symfony\Component\Form\AbstractType;
    use Symfony\Component\Form\Extension\Core\Type\IntegerType;
    use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
    use Symfony\Component\Form\Extension\Core\Type\TextType;
    use Symfony\Component\Form\FormBuilderInterface;
    use Symfony\Component\OptionsResolver\OptionsResolver;
    use App\Forms\Fields\Public\Housing\SearchesHousingFields;

    class SearchesHousingTypes extends AbstractType
    {
        public function buildForm(FormBuilderInterface $builder, array $options): void
        {
            $builder
                ->add('town', TextType::class, [
                    'attr' => ['placeholder' => 'Ou allez-vous ?']
                ])

                ->add('peopleCanStay', IntegerType::class, [
                    'attr' => [
                        'min' => 1,
                        'max' => 30,
                        'value' => 1
                    ]
                ])

                ->add('kidIsAccept', ChoiceType::class, [
                    'choices' => [
                        'Oui' => 'oui',
                        'Non' => 'non'
                    ],
                    'expanded' => true,
                    'multiple' => false,
                    'data' => 'oui'
                ])
            ;
        }


        public function configureOptions(OptionsResolver $resolver): void
        {
            $resolver->setDefaults([
                'data_class' => SearchesHousingFields::class
            ]);
        }
    }