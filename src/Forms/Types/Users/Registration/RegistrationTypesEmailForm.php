<?php

    namespace App\Forms\Types\Users\Registration;

    use App\Forms\Fields\Users\Registration\RegistrationFieldsEmailForm;
    use Symfony\Component\Form\AbstractType;
    use Symfony\Component\Form\Extension\Core\Type\EmailType;
    use Symfony\Component\Form\FormBuilderInterface;
    use Symfony\Component\OptionsResolver\OptionsResolver;

    class RegistrationTypesEmailForm extends AbstractType
    {
        public function buildForm(FormBuilderInterface $builder, array $options): void
        {
            $builder->add('email', EmailType::class, [
                'label' => 'Adresses e-mail',
                'attr' => ['placeholder' => 'Veuillez saisir votre adresse e-mail']
            ]);
        }


        public function configureOptions(OptionsResolver $resolver): void
        {
            $resolver->setDefaults([
                'data_class' => RegistrationFieldsEmailForm::class
            ]);
        }
    }