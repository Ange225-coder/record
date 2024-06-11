<?php

    namespace App\Forms\Types\Partners\Housing\Adding\Apartments\RevisionAndFinalization;

    use Symfony\Component\Form\AbstractType;
    use Symfony\Component\Form\Extension\Core\Type\TextType;
    use Symfony\Component\Form\Extension\Core\Type\EmailType;
    use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
    use Symfony\Component\Form\FormBuilderInterface;
    use Symfony\Component\OptionsResolver\OptionsResolver;
    use App\Forms\Fields\Partners\Housing\Adding\Apartments\RevisionAndFinalization\HousingFinalizationFields;

    class HousingFinalizationTypes extends AbstractType
    {
        public function buildForm(FormBuilderInterface $builder, array $options): void
        {
            $builder
                ->add('housing_choices', ChoiceType::class, [
                    'choices' => [
                        'Particulier' => 'individual',
                        'Entité commerciale' => 'commercial_entity'
                    ],
                    'expanded' => true,
                    'multiple' => false
                ])

                ->add('social_reason', TextType::class, [
                    'label' => 'Raison sociale'
                ])

                ->add('first_name', TextType::class, [
                    'label' => 'Prénom'
                ])

                ->add('other_first_name', TextType::class, [
                    'label' => 'Autres prénom',
                    'required' => false,
                ])

                ->add('last_name', TextType::class, [
                    'label' => 'Nom',
                ])

                ->add('email', EmailType::class, [
                    'label' => 'Adresse e-mail',
                ])

                ->add('phone', TextType::class, [
                    'label' => 'Numéro de téléphone',
                ])

                ->add('location', ChoiceType::class, [
                    'label' => 'Pays/région',
                    'choices' => [
                        'Ghana' => 'Ghana',
                        'Liberia' => 'Liberia',
                        'Côte d\'Ivoire' => 'Côte d\'Ivoire',
                    ],
                    'expanded' => false
                ])

                ->add('first_address', TextType::class, [
                    'label' => 'Adresse (ligne 1)',
                ])

                ->add('second_address', TextType::class, [
                    'label' => 'Adresse (ligne 2)'
                ])

                ->add('town', TextType::class, [
                    'label' => 'Ville',
                ])

                ->add('postal_code', TextType::class, [
                    'label' => 'Code postal'
                ])

                ->add('generalConditions', ChoiceType::class, [
                    //'label' => 'j\'ai lu et j\'accepte les conditions générales.',
                    'choices' => [
                        'j\'ai lu et j\'accepte les conditions générales.' => 'J\'accepte les conditions générales.',
                    ],
                    'expanded' => true,
                    'mapped' => true,
                    'multiple' => true,
                ])
            ;
        }


        public function configureOptions(OptionsResolver $resolver): void
        {
            $resolver->setDefaults([
                'data_class' => HousingFinalizationFields::class,
            ]);
        }
    }