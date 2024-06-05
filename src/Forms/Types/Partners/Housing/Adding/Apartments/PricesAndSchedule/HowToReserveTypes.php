<?php

    namespace App\Forms\Types\Partners\Housing\Adding\Apartments\PricesAndSchedule;

    use Symfony\Component\Form\AbstractType;
    use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
    use Symfony\Component\Form\FormBuilderInterface;
    use Symfony\Component\OptionsResolver\OptionsResolver;
    use App\Forms\Fields\Partners\Housing\Adding\Apartments\PricesAndSchedule\HowToReserveFields;

    class HowToReserveTypes extends AbstractType
    {
        public function buildForm(FormBuilderInterface $builder, array $options): void
        {
            $builder->add('howToReserve', ChoiceType::class, [
                'label' => 'Comment les clients peuvent-ils réserver votre appartement ? ',
                'choices' => [
                    'Tous les clients peuvent réserver instantanément' => 'réserver instantanément',
                    'Tous les clients doivent envoyer une demande de réservation' => 'envoyer demande'
                ],
                'multiple' => false,
                'expanded' => true,
                'data' => 'réserver instantanément'
            ]);
        }


        public function configureOptions(OptionsResolver $resolver): void
        {
            $resolver->setDefaults([
                'data_class' => HowToReserveFields::class,
            ]);
        }
    }