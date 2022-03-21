<?php

namespace App\Form;

use App\Entity\Praticiens;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class PraticiensType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('pra_nom')
            ->add('pra_prenom')
            ->add('pra_tel')
            ->add('pra_mail')
            ->add('pra_rue')
            ->add('pra_codePostal')
            ->add('pra_ville')
            ->add('pra_coefNotoriete')
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Praticiens::class,
        ]);
    }
}
