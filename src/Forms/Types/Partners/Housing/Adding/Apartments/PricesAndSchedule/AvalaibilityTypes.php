<?php

    namespace App\Forms\Types\Partners\Housing\Adding\Apartments\PricesAndSchedule;

    use Symfony\Component\Form\AbstractType;
    use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
    use Symfony\Component\Form\FormBuilderInterface;
    use Symfony\Component\OptionsResolver\OptionsResolver;
    use App\Forms\Fields\Partners\Housing\Adding\Apartments\PricesAndSchedule\AvalaibilityFields;

    class AvalaibilityTypes extends AbstractType
    {
        public function buildForm(FormBuilderInterface $builder, array $options): void
        {
            //forms group for each input
            $arrivalDate = [
                'Dès que possible' => 'dès que possible',
                 'À partir d\'une date precise' => 'À partir d\'une date precise'
            ];

            $avalaibilitySynchronisation = [
                'Oui, je vais importer les dates indisponibles depuis un autre site' => 'importer les dates depuis un autre site',
                'Oui, je vais les connecter avec mon Channel Manager' => 'Connecté avec Chanel Manager',
                'Non, je ne souhaite pas synchroniser mes disponibilités.' => 'Ne pas synchroniser'
            ];


            $stayOfMoreThanThirtyNights = [
                'Oui' => 'oui',
                'Non' => 'non'
            ];

            $builder
                ->add('arrivalDate', ChoiceType::class, [
                    'label' => 'À partir de quelle date les clients peuvent-ils arriver dans votre hébergement ?',
                    'choices' => $arrivalDate,
                    'expanded' => true,
                    'data' => 'dès que possible',
                ])

                ->add('avalaibilitySynchronisation', ChoiceType::class, [
                    'label' => 'Souhaitez-vous synchroniser vos disponibilités avec un autre site ?',
                    'choices' => $avalaibilitySynchronisation,
                    'expanded' => true,
                ])

                ->add('stayOfMoreThanThirtyNights', ChoiceType::class, [
                    'label' => 'Souhaitez-vous autoriser les séjours de plus de 30 nuits ?',
                    'choices' => $stayOfMoreThanThirtyNights,
                    'expanded' => true,
                ])
            ;
        }


        public function configureOptions(OptionsResolver $resolver): void
        {
            $resolver->setDefaults([
                'data_class' => AvalaibilityFields::class,
            ]);
        }
    }