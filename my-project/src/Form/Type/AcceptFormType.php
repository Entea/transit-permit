<?php

namespace App\Form\Type;

use App\Entity\Application;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class AcceptFormType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('externalId', TextType::class, ['label' => 'Номер заявления'])
            ->add('officerFullName', TextType::class, ['label' => 'ФИО проверяющего'])
            ->add('status', ChoiceType::class, [
                'label' => 'Статус',
                'choices'  => [
                    'Принято' => Application::STATUS_ACCEPTED,
                    'Отклонено' => Application::STATUS_DECLINED,
                ],
            ])
            ->add('declinedReason', TextareaType::class, ['label' => 'Причина отклонения'])
            ->add('save', SubmitType::class, ['label' => 'Отправить'])
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Application::class,
        ]);
    }
}
