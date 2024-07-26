<?php

namespace App\Form;

use App\Entity\Enchere;
use App\Entity\Proposition;
use Doctrine\DBAL\Types\IntegerType;
use Doctrine\DBAL\Types\TextType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class PropositionType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('idEntreprise', TextType::class ,options: [
                'label'=>false,
                'placeholder' => 'Inserez votre Id',

            ])
            ->add('numeroTelephone',IntegerType::class, options:[
                'label' => 'Numéro de téléphone',
                'pattern' => '/^(2|7|5|3|4|9)\d{7}$/',
                'placeholder' => 'Entrez votre numéro de téléphone',
            ])

            ->add('mail',  EmailType::class ,options: [
                'label'=>false,
                'placeholder' => 'Entrez votre numéro de téléphone',
            ])

            ->add('titre',EntityType::class, options : [
                'class' => Enchere::class,
                'choice_label' => 'titre',
                'placeholder' => 'Inserez un Titre ',
            ])
            ->add('montant', IntegerType::class, options : [
                'class'=>  Enchere::class,
                'choice_label'=> 'offreinitial',
                'placeholder' => 'Inserez votre Offre de prix',
            ])
            ->add('message', TextType::class ,options: [
                    'label'=>false,
                    'placeholder' => 'Inserez un Descriptif de votre offre ',
    ])
            ->add('Valider',SubmitType::class);

    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Proposition::class,
        ]);
    }
}
