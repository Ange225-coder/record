<?php

    namespace App\Forms\Types\Partners\Housing\Adding\Apartments\Configurations;

    use Symfony\Component\Form\AbstractType;
    use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
    use Symfony\Component\Form\FormBuilderInterface;
    use Symfony\Component\OptionsResolver\OptionsResolver;
    use App\Forms\Fields\Partners\Housing\Adding\Apartments\Configurations\ApartmentEquipmentsFields;

    class ApartmentEquipmentsTypes extends AbstractType
    {
        public function buildForm(FormBuilderInterface $builder, array $options): void
        {
            //form groups
            $generalEquipments = [
                'Climatisation' => 'climatisation',
                'Chauffage' => 'chauffage',
                'Connexion Wi-Fi gratuite' => 'connexion Wi-Fi gratuite',
            ];

            $kitchenAndCleaning = [
                'cuisine' => 'cuisine',
                'lave-linge' => 'lave-linge',
            ];

            $entertainment = [
                'Piscine' => 'piscine',
                'Minibar' => 'minibar',
                'Sauna' => 'sauna',
            ];

            $outdoorView = [
                'Balcon' => 'balcon',
                'Vue sur le jardin' => 'vue sur le jardin',
                'Terrasse' => 'terrasse',
            ];


            //build forms groups
            $builder
                ->add('generalEquipments', ChoiceType::class, [
                    'choices' => $generalEquipments,
                    'expanded' =>  true,
                    'multiple' => true,
                ])

                ->add('kitchenAndCleaning', ChoiceType::class, [
                    'choices' => $kitchenAndCleaning,
                    'expanded' => true,
                    'multiple' => true,
                ])

                ->add('entertainment', ChoiceType::class, [
                    'choices' => $entertainment,
                    'expanded' => true,
                    'multiple' => true,
                ])

                ->add('outdoorView', ChoiceType::class, [
                    'choices' => $outdoorView,
                    'expanded' => true,
                    'multiple' => true,
                ])
            ;
        }


        public function configureOptions(OptionsResolver $resolver): void
        {
            $resolver->setDefaults([
                'data_class' => ApartmentEquipmentsFields::class,
            ]);
        }
    }