<?php

    namespace App\Forms\Types\Partners\Housing\Adding\Apartments\PricesAndSchedule;

    use Symfony\Component\Form\AbstractType;
    use Symfony\Component\Form\Extension\Core\Type\NumberType;
    use Symfony\Component\Form\FormBuilderInterface;
    use Symfony\Component\OptionsResolver\OptionsResolver;
    use App\Forms\Fields\Partners\Housing\Adding\Apartments\PricesAndSchedule\PricePerNightFields;

    class PricePerNightTypes extends AbstractType
    {
        public function buildForm(FormBuilderInterface $builder, array $options): void
        {
            $builder->add('pricePerNight', NumberType::class, [
                'label' => 'Tarif payé par les clients',
            ]);
        }


        public function configureOptions(OptionsResolver $resolver): void
        {
            $resolver->setDefaults([
                'data_class' => PricePerNightFields::class,
            ]);
        }
    }