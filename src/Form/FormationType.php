<?php

namespace App\Form;

use App\Entity\Langage;
use App\Entity\Formation;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\OptionsResolver\OptionsResolver;
use FOS\CKEditorBundle\Form\Type\CKEditorType;

class FormationType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
        ->add('langage', EntityType::class, [
            'class' => Langage::class,
            'choice_label' => 'nom',
            'label' => 'langage',
        ])
            ->add('titre')
            ->add('image')
            ->add('chapeau')
            ->add('corps', CKEditorType::class)
            ->add('resume')
            
            //->add('auteur')
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Formation::class,
        ]);
    }
}
