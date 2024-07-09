<?php

    namespace App\Forms\Types\Public\Housing;

    use Symfony\Component\Form\AbstractType;
    use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
    use Symfony\Component\Form\FormBuilderInterface;
    use Symfony\Component\OptionsResolver\OptionsResolver;
    use App\Forms\Fields\Public\Housing\HousingReservationLastStepFields;

    class HousingReservationLastStepTypes extends AbstractType
    {
        public function buildForm(FormBuilderInterface $builder, array $options): void
        {
            $builder->add('privacyPolicy', ChoiceType::class, [
                'choices' => [
                    'J’accepte de recevoir des e-mails marketing de la part de Booking.com' => 'J’accepte de recevoir des e-mails marketing de la part de Booking.com',
                    'J’accepte de recevoir des e-mails marketing de la part de Booking.com Transport Limited' => 'J’accepte de recevoir des e-mails marketing de la part de Booking.com Transport Limited'
                ],
                'multiple' => true,
                'expanded' => true,
                'mapped' => false
            ]);
        }


        public function configureOptions(OptionsResolver $resolver): void
        {
            $resolver->setDefaults([
                'data_class' => HousingReservationLastStepFields::class,
            ]);
        }
    }