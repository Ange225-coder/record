<?php

    namespace App\Forms\Types\Partners\Registration;

    use Symfony\Component\Form\AbstractType;
    use Symfony\Component\Form\Extension\Core\Type\PasswordType;
    use App\Forms\Fields\Partners\Registration\RegistrationPwdFields;
    use Symfony\Component\Form\FormBuilderInterface;
    use Symfony\Component\OptionsResolver\OptionsResolver;

    class RegistrationPwdTypes extends AbstractType
    {
        public function buildForm(FormBuilderInterface $builder, array $options): void
        {
            $builder
                ->add('password', PasswordType::class, [
                    'label' => 'Mot de passe',
                    'attr' => ['placeholder' => 'Saisissez un mot de passe']
                ])

                ->add('confirmPwd', PasswordType::class, [
                    'label' => 'Confirmer le mot de passe',
                    'attr' => ['placeholder' => 'Confirmer votre mot de passe']
                ])
            ;
        }


        public function configureOptions(OptionsResolver $resolver): void
        {
            $resolver->setDefaults([
                'data_class' => RegistrationPwdFields::class,
            ]);
        }
    }