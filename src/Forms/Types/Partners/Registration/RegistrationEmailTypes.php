<?php

    namespace App\Forms\Types\Partners\Registration;

    use Symfony\Component\Form\AbstractType;
    use Symfony\Component\Form\Extension\Core\Type\EmailType;
    use Symfony\Component\Form\FormBuilderInterface;
    use Symfony\Component\OptionsResolver\OptionsResolver;
    use App\Forms\Fields\Partners\Registration\RegistrationEmailFields;

    class RegistrationEmailTypes extends AbstractType
    {
        public function buildForm(FormBuilderInterface $builder, array $options): void
        {
            $builder->add('email', EmailType::class, [
                'label' => 'Adresse e-mail',
            ]);
        }


        public function configureOptions(OptionsResolver $resolver): void
        {
            $resolver->setDefaults([
                'data_class' => RegistrationEmailFields::class,
            ]);
        }
    }