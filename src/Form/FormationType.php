<?php

namespace App\Form;

use App\Entity\Formation;
use Symfony\Component\Form\FormEvent;
use Symfony\Component\Form\FormEvents;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;

class FormationType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('nom')
            ->add('prenom')
            ->add('numero')
            ->add('email')
            ->add('choix', ChoiceType::class, [
                'label' => 'Choix de formation :',
                'choices' => [
                    'Ressources Humaines' => 'Ressources Humaines',
                    'Paie' => 'Paie',
                    'Comptabilité' => 'Comptabilité',
                    'Malette du Dirigeant' => 'Malette du Dirigeant',
                    'Fiscalité' => 'Fiscalité',
                    'Bureautique' => 'Bureautique',
                    'TECHNIQUE DE RECHERCHE EMPLOI' =>
                        'TECHNIQUE DE RECHERCHE EMPLOI',
                    'EBP' => 'EBP',
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
            ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Formation::class,
        ]);
    }
}
