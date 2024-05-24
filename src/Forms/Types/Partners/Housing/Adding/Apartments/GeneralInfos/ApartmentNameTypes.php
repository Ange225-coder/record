<?php

    namespace App\Forms\Types\Partners\Housing\Adding\Apartments\GeneralInfos;

    use Symfony\Component\Form\AbstractType;
    use Symfony\Component\Form\Extension\Core\Type\TextType;
    use Symfony\Component\Form\FormBuilderInterface;
    use Symfony\Component\OptionsResolver\OptionsResolver;

    class ApartmentNameTypes extends AbstractType
    {
        public function buildForm(FormBuilderInterface $builder, array $options): void
        {
            $builder->add('apartmentName', TextType::class, [
                'label' => 'Nom de l\'hébergement',
            ]);
        }


        public function configureOptions(OptionsResolver $resolver): void
        {
            $resolver->setDefaults([
                'data_class' => \App\Forms\Fields\Partners\Housing\Adding\Apartments\GeneralInfos\ApartmentNameFields::class,
            ]);
        }
    }