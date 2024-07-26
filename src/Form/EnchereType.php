<?php

namespace App\Form;

use App\Entity\Enchere;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class EnchereType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('id', EntityType::class, [
                'class'=>Enchere::class,
                'choise_label'=> 'id',
            ])

            ->add('description',EntityType::class,  options :[
                'class'=>Enchere::class,
                'choise_label'=> 'description',
    ])
            ->add('datedebut',EntityType::class, options : [
                'class'=>Enchere::class,
                'choise_label'=> 'datedebut',
                'placeholder' => 'Inserez la date début  ',
            ])
            ->add('datefin',EntityType::class, options : [
                'class'=>Enchere::class,
                'choise_label'=> 'datefin',
                'placeholder' => 'Inserez la date fin  ',
            ])
            ->add('offreInitial',EntityType::class,  options :[
                'class'=>Enchere::class,
                'choise_label'=> 'offreInitial',
                'placeholder' => 'Inserez le montant d"ouverture ',
            ])
            ->add('Valider',SubmitType::class);

    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Enchere::class,
        ]);
    }
}
