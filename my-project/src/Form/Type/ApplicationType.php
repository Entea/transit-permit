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
use Karser\Recaptcha3Bundle\Form\Recaptcha3Type;
use Karser\Recaptcha3Bundle\Validator\Constraints\Recaptcha3;

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
            ->add('save', SubmitType::class, ['label' => 'Отправить форму'])
            ->add('captcha', Recaptcha3Type::class, [
                'constraints' => new Recaptcha3(),
                'action_name' => 'application',
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Application::class,
        ]);
    }
}
