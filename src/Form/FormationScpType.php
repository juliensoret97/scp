<?php

namespace App\Form;

use App\Entity\FormationScp;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Validator\Constraints\File;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\FileType;

class FormationScpType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('titre')
            ->add('info')
            ->add('plaquette', FileType::class, [
                'label' => 'Insérez la plaquette:',
                'mapped' => false,
                'attr' => ['class' => 'form-control'],
                'required' => false,])
            ->add('image', FileType::class, [
                'label' => 'image formation :',
                'mapped' => false,
                'attr' => ['class' => 'form-control'],
                'required' => false,
                'constraints' => [
                    new File([
                        'maxSize' => '1024k',
                        'mimeTypes' => ['image/jpeg', 'image/png'],
                        'mimeTypesMessage' =>
                            'Veuillez sélectionner une image png ou jpeg',
                    ]),
                ],
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => FormationScp::class,
        ]);
    }
}
