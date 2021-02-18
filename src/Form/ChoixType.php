<?php

namespace App\Form;

use App\Entity\Choix;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;

class ChoixType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('nom')
            ->add('prenom')
            ->add('numero')
            ->add('email')
            ->add('choix', ChoiceType::class, ['label' => 'Choix de formation :', 'choices'=>[
                'CCP Secrétaire comptable' => 'CCP Secrétaire comptable',
                'CCP ARH'=>'CCP ARH'
            ],'multiple'=>false, 'attr' => ['class' => 'form-control']])
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Choix::class,
        ]);
    }
}
