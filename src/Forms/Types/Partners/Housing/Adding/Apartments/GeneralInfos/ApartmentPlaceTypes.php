<?php

    namespace App\Forms\Types\Partners\Housing\Adding\Apartments\GeneralInfos;

    use App\Forms\Fields\Partners\Housing\Adding\Apartments\GeneralInfos\ApartmentPlaceFields;
    use Symfony\Component\Form\AbstractType;
    use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
    use Symfony\Component\Form\Extension\Core\Type\TextType;
    use Symfony\Component\Form\FormBuilderInterface;
    use Symfony\Component\OptionsResolver\OptionsResolver;

    class ApartmentPlaceTypes extends AbstractType
    {
        public function buildForm(FormBuilderInterface $builder, array $options): void
        {
            $builder
                ->add('country', ChoiceType::class, [
                    'label' => 'Pays/région',
                    'choices' => [
                        'Afrique du Sud' => 'Afrique du Sud',
                        'Ghana' => 'Ghana',
                        'Liberia' => 'Liberia',
                        'Serra Leone' => 'Serra Leone',
                        'Côte d\'Ivoire' => 'Côte d\'Ivoire'
                    ],
                    'multiple' => false,
                ])

                ->add('address', TextType::class, [
                    'label' => 'Nom et numéro de la rue',
                    'attr' => ['placeholder' => 'Commencer à saisir votre adresse']
                ])

                ->add('postalCode', TextType::class, [
                    'label' => 'Code postal',
                    'help' => 'Souhaitez-vous ajouter un code postal ?'
                ])

                ->add('town', TextType::class, [
                    'label' => 'Ville',
                    'attr' => ['value' => 'Abidjan']
                ])
            ;
        }


        public function configureOptions(OptionsResolver $resolver): void
        {
            $resolver->setDefaults([
                'data_class' => ApartmentPlaceFields::class,
            ]);
        }
    }