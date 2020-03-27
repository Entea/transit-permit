<?php

namespace App\Form\Type;

use App\Entity\Application;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\CollectionType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use EWZ\Bundle\RecaptchaBundle\Form\Type\EWZRecaptchaType;
use EWZ\Bundle\RecaptchaBundle\Validator\Constraints\IsTrue as RecaptchaTrue;

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
            ->add('email', EmailType::class, ['label' => 'Email для получения подтверждения'])
            ->add('cars', CollectionType::class, [
                'label' => false,
                'entry_type' => ApplicationCarType::class,
                'entry_options' => ['label' => false],
                'allow_add' => true,
                'allow_delete' => true,
                'error_bubbling' => true
            ])
            ->add('recaptcha', EWZRecaptchaType::class, [
                'label' => 'Защита от автоматических отправок',
                'attr'        => [
                    'options' => [
                        'theme' => 'light',
                        'type'  => 'image',
                        'size'  => 'normal'
                    ]
                ],
                'mapped'      => false,
                'constraints' => [
                    new RecaptchaTrue()
                ]
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
