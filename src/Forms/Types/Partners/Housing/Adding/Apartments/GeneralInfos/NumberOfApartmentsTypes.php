<?php

    namespace App\Forms\Types\Partners\Housing\Adding\Apartments\GeneralInfos;

    use App\Forms\Fields\Partners\Housing\Adding\Apartments\GeneralInfos\NumberOfApartmentsFields;
    use Symfony\Component\Form\AbstractType;
    use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
    use Symfony\Component\Form\FormBuilderInterface;
    use Symfony\Component\OptionsResolver\OptionsResolver;

    class NumberOfApartmentsTypes extends AbstractType
    {
        public function buildForm(FormBuilderInterface $builder, array $options): void
        {
            $builder->add('numberOfApartment', ChoiceType::class, [
                'choices' => [
                    '1 appartement' => '1 appartement',
                    'Plusieurs appartements' => 'plusieurs appartements',
                ],
                'expanded' => true,
            ]);
        }


        public function configureOptions(OptionsResolver $resolver): void
        {
            $resolver->setDefaults([
                'data_class' => NumberOfApartmentsFields::class,
            ]);
        }
    }