<?php

    namespace App\Forms\Types\Partners\Housing\Adding\Apartments\RevisionAndFinalization;

    use Symfony\Component\Form\AbstractType;
    use App\Forms\Fields\Partners\Housing\Adding\Apartments\RevisionAndFinalization\HousingGeneralsConditionsFields;
    use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
    use Symfony\Component\Form\FormBuilderInterface;
    use Symfony\Component\OptionsResolver\OptionsResolver;

    class HousingGeneralsConditionsTypes extends AbstractType
    {
        public function buildForm(FormBuilderInterface $builder, array $options): void
        {
            $builder->add('generalsConditions', ChoiceType::class, [
                'label' => 'Conditions générales',
                'choices' => [
                    'j\'ai lu et j\'accepte les conditions générales.' => 'J\'accepte les conditions générales.',
                ],
                'expanded' => true,
                'multiple' => true,
            ]);
        }


        public function configureOptions(OptionsResolver $resolver): void
        {
            $resolver->setDefaults([
                'data_class' => HousingGeneralsConditionsFields::class,
            ]);
        }
    }