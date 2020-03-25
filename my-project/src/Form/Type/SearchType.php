<?php

namespace App\Form\Type;

use App\Entity\Application;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\CollectionType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class SearchType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('status', ChoiceType::class, [
                'label' => 'Статус',
                'choices'  => [
                    'Все' => -1,
                    'В очереди' => Application::STATUS_IN_QUEUED,
                    'Принято' => Application::STATUS_ACCEPTED,
                    'Отклонено' => Application::STATUS_DECLINED,
                ],
                'data' => Application::STATUS_IN_QUEUED,
                'required' => false
            ])
            ->add('directorFullName', TextType::class, ['label' => 'ФИО директора', 'required' => false])
            ->add('companyIin', TextType::class, ['label' => 'ИИН компании', 'required' => false])
            ->add('companyName', TextType::class, ['label' => 'Наименование компании', 'required' => false])
            ->add('driverFullName', TextType::class, ['label' => 'ФИО сотрудника', 'required' => false])
            ->add('carIdentifier', TextType::class, ['label' => 'Марка авто и госномер', 'required' => false])
            ->add('save', SubmitType::class, ['label' => 'Отправить'])
        ;
    }
}
