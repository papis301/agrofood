<?php

namespace App\Form;

use App\Entity\Piment;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;

class PimentType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('nom', TextType::class)
            ->add('description', TextareaType::class)
            ->add('conditions_sol', TextareaType::class)
            ->add('besoins_eau', TextareaType::class)
            ->add('periode_semi', TextType::class)
            ->add('periode_recolte', TextType::class)
            ->add('techniques_entretien', TextareaType::class)
            ->add('maladies_communes', TextareaType::class)
            ->add('astuces', TextareaType::class);
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Piment::class,
        ]);
    }
}
