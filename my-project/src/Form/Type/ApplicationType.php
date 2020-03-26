<?php

namespace App\Form\Type;

use App\Entity\Application;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\CollectionType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class ApplicationType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('directorFullName', TextType::class, ['label' => 'ФИО директора'])
            ->add('companyIin', TextType::class, ['label' => 'ИИН компании'])
            ->add('companyName', TextType::class, ['label' => 'Наименование компании'])
            ->add('phoneNumber', TextType::class, ['label' => 'Номер телефона'])
            ->add('movementArea', TextareaType::class, ['label' => 'Район планируемых перемещений'])
            ->add('email', TextareaType::class, ['label' => 'Email для получения подтверждения'])
            ->add('cars', CollectionType::class, [
                'label' => false,
                'entry_type' => ApplicationCarType::class,
                'entry_options' => ['label' => false],
                'allow_add' => true,
                'allow_delete' => true,
            ])
            ->add('save', SubmitType::class, ['label' => 'Отправить форму'])
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Application::class,
        ]);
    }
}
