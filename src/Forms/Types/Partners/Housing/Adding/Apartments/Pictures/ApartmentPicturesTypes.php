<?php

    namespace App\Forms\Types\Partners\Housing\Adding\Apartments\Pictures;

    use Symfony\Component\Form\AbstractType;
    use Symfony\Component\Form\Extension\Core\Type\FileType;
    use Symfony\Component\Form\FormBuilderInterface;
    use Symfony\Component\OptionsResolver\OptionsResolver;
    //use App\Forms\Fields\Partners\Housing\Adding\Apartments\Pictures\ApartmentPicturesFields;


    class ApartmentPicturesTypes extends AbstractType
    {
        public function buildForm(FormBuilderInterface $builder, array $options): void
        {
            $builder->add('pictures', FileType::class, [
                'multiple' => true,
            ]);
        }


        public function configureOptions(OptionsResolver $resolver): void
        {
            $resolver->setDefaults([
                'data_class' => 'App\Forms\Fields\Partners\Housing\Adding\Apartments\Pictures\ApartmentPicturesFields',
            ]);
        }
    }