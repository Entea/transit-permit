<?php

namespace App\Form\Type;

use App\Entity\ApplicationCar;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class ApplicationCarType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('driverFullName', TextType::class, ['label' => 'ФИО сотрудника'])
            ->add('carIdentifier', TextareaType::class, ['label' => 'Марка авто и госномер', 'attr' => ['placeholder' => 'пример: Toyota Ist, 01KG111ABC']])
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => ApplicationCar::class,
        ]);
    }
}
