<?php

    namespace App\Forms\Types\Partners\Housing\Adding\Apartments\RevisionAndFinalization;

    use Symfony\Component\Form\AbstractType;
    use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
    use Symfony\Component\Form\FormBuilderInterface;
    use Symfony\Component\OptionsResolver\OptionsResolver;
    use App\Forms\Fields\Partners\Housing\Adding\Apartments\RevisionAndFinalization\HousingChoiceFields;

    class HousingChoiceTypes extends AbstractType
    {
        public function buildForm(FormBuilderInterface $builder, array $options): void
        {
            $builder->add('housingChoice', ChoiceType::class, [
                'label' => 'Votre réponse à cette question permettra d\'inclure toutes les informations nécessaires dans votre contract',
                'choices' => [
                    'Particulier' => 'individuals',
                    'Entité commercial' => 'commercial_entity'
                ],
                'expanded' => true,
                'multiple' => false,
                'mapped' => false
            ]);
        }


        public function configureOptions(OptionsResolver $resolver): void
        {
            $resolver->setDefaults([
                'data_class' => HousingChoiceFields::class,
            ]);
        }
    }