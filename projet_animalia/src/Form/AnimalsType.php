<?php

namespace App\Form;

use App\Entity\Animals;
use App\Entity\Genre;
use App\Entity\Type;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class AnimalsType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('name')
            ->add('type_id',EntityType::class, [
                'class' => Type::class ,
                'choice_label' => 'name',
                'label' => 'Type',
                'placeholder' => "Choisis l'espèce"
            ])
            ->add('genre_id', EntityType::class, [
                'class' => Genre::class ,
                'choice_label' => 'name',
                'label' => 'Genre',
                'placeholder' => "Domestique ou Sauvage"])
            ->add('Submit', SubmitType::class)
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Animals::class,
        ]);
    }
}
