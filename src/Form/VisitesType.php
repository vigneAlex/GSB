<?php

namespace App\Form;

use App\Entity\Visites;
use App\Entity\Praticiens;
use App\Entity\Motifs;
use App\Entity\Visiteurs;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class VisitesType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('vst_dateVisite')
            ->add('vst_commentaire')
            ->add('vst_praticien', EntityType::class, ['class' => Praticiens::class, 'choice_label' => 'pra_nom'])
            ->add('vst_motif', EntityType::class, ['class' => Motifs::class, 'choice_label' => 'mot_libelle'])
            ->add('vst_visiteur' , EntityType::class, ['class' => Visiteurs::class, 'choice_label' => 'vis_nom'])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Visites::class,
        ]);
    }
}
