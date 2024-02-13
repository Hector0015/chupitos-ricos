<?php

namespace App\Form;

use App\Entity\Combinaciones2;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;


class Combinaciones2FormType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('nombre')
            ->add('alcoholes')
            ->add('mezclas')
            ->add('save', SubmitType::class, array('label' => 'Enviar'));
        
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Combinaciones2::class,
        ]);
    }
}
