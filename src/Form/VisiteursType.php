<?php

namespace App\Form;

use App\Entity\Visiteurs;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class VisiteursType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('email')
            ->add('password')
            ->add('vis_nom')
            ->add('vis_prenom')
            ->add('vis_tel')
            ->add('vis_dateEmbauche')
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Visiteurs::class,
        ]);
    }
}
