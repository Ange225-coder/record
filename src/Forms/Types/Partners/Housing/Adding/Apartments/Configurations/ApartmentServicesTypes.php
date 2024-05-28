<?php

    namespace App\Forms\Types\Partners\Housing\Adding\Apartments\Configurations;

    use Symfony\Component\Form\AbstractType;
    use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
    use App\Forms\Fields\Partners\Housing\Adding\Apartments\Configurations\ApartmentServicesFields;
    use Symfony\Component\Form\FormBuilderInterface;
    use Symfony\Component\OptionsResolver\OptionsResolver;

    class ApartmentServicesTypes extends AbstractType
    {
        public function buildForm(FormBuilderInterface $builder, array $options): void
        {
            //forms groups
            $lunch = [
                'Oui' => 'Oui',
                'Non' => 'Non'
            ];

            $carPark = [
                'Oui, gratuitement' => 'Oui, gratuitement',
                'Oui, moyennant un supplément' => 'Oui, moyennant un supplément',
                'Non' => 'Non'
            ];

            //build form
            $builder
                ->add('lunch', ChoiceType::class, [
                    'label' => 'Le petit déjeuner est il servis dans votre hébergement ?',
                    'choices' => $lunch,
                    'expanded' => true,
                    'multiple' => false,
                ])

                ->add('carPark', ChoiceType::class, [
                    'label' => 'Les clients ont-ils accès à un parking ?',
                    'choices' => $carPark,
                    'expanded' => true,
                    'multiple' => false,
                ])
            ;
        }


        public function configureOptions(OptionsResolver $resolver): void
        {
            $resolver->setDefaults([
                'data_class' => ApartmentServicesFields::class,
            ]);
        }
    }