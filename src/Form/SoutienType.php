<?php

namespace App\Form;

use App\Entity\Soutien;
use Symfony\Component\Form\FormEvents;
use Symfony\Component\Form\FormEvent;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;

class SoutienType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('nom')
            ->add('prenom')
            ->add('numero')
            ->add('email')
            ->add('choix', ChoiceType::class, [
                'label' => 'Choix de Soutien :',
                'choices' => [
                    'Francais' => 'Francais',
                    'Anglais' => 'Anglais',
                    'Mathematiques' => 'Mathematiques',
                    'Histoire' => 'Histoire',
                    'Geographie' => 'Geographie',
                ],
                'multiple' => false,
                'attr' => ['class' => 'form-control'],
            ])
            ->add('accepter', CheckboxType::class, ['mapped' => false,
                // 'label' => "<a href='{{asset ('pdf/politique.pdf')}}'>Politique de conf</a>",
            ])
            ->addEventListener(FormEvents::PRE_SUBMIT, function (
                FormEvent $event
            ) {
                $personne = $event->getData();
                if (!isset($personne['accepter']) || !$personne['accepter']) {
                    exit();
                }
            });
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Soutien::class,
        ]);
    }
}
