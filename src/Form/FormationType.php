<?php

namespace App\Form;

use App\Entity\Langage;
use App\Entity\Formation;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\OptionsResolver\OptionsResolver;
use FOS\CKEditorBundle\Form\Type\CKEditorType;
use Symfony\Component\Form\Extension\Core\Type\FileType;


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
            ->add('image', FileType::class, [
              
            ])
            ->add('chapeau')
            ->add('corps', CKEditorType::class)
            ->add('resume')
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Formation::class,
        ]);
    }
}
