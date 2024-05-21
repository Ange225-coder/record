<?php

    namespace App\Forms\Types\Partners\Registration;

    use Symfony\Component\Form\AbstractType;
    use Symfony\Component\Form\Extension\Core\Type\TextType;
    use App\Forms\Fields\Partners\Registration\RegistrationContactDetailsFields;
    use Symfony\Component\Form\FormBuilderInterface;
    use Symfony\Component\OptionsResolver\OptionsResolver;

    class RegistrationContactDetailsTypes extends AbstractType
    {
        public function buildForm(FormBuilderInterface $builder, array $options): void
        {
            $builder
                ->add('firstName', TextType::class, [
                    'label' => 'Prénom'
                ])

                ->add('lastName', TextType::class, [
                    'label' => 'Nom'
                ])

                ->add('contact', TextType::class, [
                    'label' => 'Numéro de téléphone'
                ])
            ;
        }


        public function configureOptions(OptionsResolver $resolver): void
        {
            $resolver->setDefaults([
                'data_class' => RegistrationContactDetailsFields::class,
            ]);
        }
    }