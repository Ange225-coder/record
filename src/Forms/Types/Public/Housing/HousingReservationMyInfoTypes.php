<?php

    namespace App\Forms\Types\Public\Housing;

    use Symfony\Component\Form\AbstractType;
    use Symfony\Component\Form\Extension\Core\Type\EmailType;
    use Symfony\Component\Form\Extension\Core\Type\TextType;
    use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
    use App\Forms\Fields\Public\Housing\HousingReservationMyInfosFields;
    use Symfony\Component\Form\FormBuilderInterface;
    use Symfony\Component\OptionsResolver\OptionsResolver;

    class HousingReservationMyInfoTypes extends AbstractType
    {
        public function buildForm(FormBuilderInterface $builder, array $options): void
        {
            $builder
                ->add('firstName', TextType::class)
                ->add('lastName', TextType::class)
                ->add('email', EmailType::class, [
                    'attr' => ['placeholder' => 'Attention aux fautes de frappe']
                ])
                ->add('location', ChoiceType::class, [
                    'choices' => [
                        'Ghana' => 'Ghana',
                        'Côte d\'ivoire' => 'Côte d\'ivoire',
                        'Nigeria' => 'Nigeria'
                    ],
                    'expanded' => false,
                    'data' => 'Côte d\'ivoire'
                ])
                ->add('phone', TextType::class, [
                    'data' => '+225',
                ]);
        }


        public function configureOptions(OptionsResolver $resolver): void
        {
            $resolver->setDefaults([
                'data_class' => HousingReservationMyInfosFields::class,
            ]);
        }
    }