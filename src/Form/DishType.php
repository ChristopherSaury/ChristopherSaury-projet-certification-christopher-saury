<?php

namespace App\Form;

use App\Entity\Dishes;
use App\Entity\SubCategory;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;

class DishType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('name', TextType::class,[
                'label' => 'Nom du plat:',
            ])
            ->add('url', TextType::class,[
                'label' => 'Url image:',
            ])
            ->add('quantity', NumberType::class,[
                'required'   => false,
                'empty_data' => null,
                'label' => 'Quantité:',
            ])
            ->add('price', NumberType::class,[
                'label' => 'Prix:',
            ])
            ->add('subcategory', EntityType::class,[
                'class' => SubCategory::class,
                'choice_label' => 'name',
                'label' => 'Catégorie:'
                ])
            ->add('description', TextareaType::class,[
                'label' => 'Description:',
            ])
            ->add('submit', SubmitType::class,[
                'label' => 'Ajouter',
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Dishes::class,
        ]);
    }
}
