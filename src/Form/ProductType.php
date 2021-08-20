<?php

namespace App\Form;

use App\Entity\Product;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class ProductType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('Name',TextType::class,['attr'=>['class'=>'form-control'],'label'=>'Nombre producto'])
            ->add('Cant',TextType::class,['attr'=>['class'=>'form-control'],'label'=>'Cantidad del producto'])
            ->add('Description',TextType::class,['attr'=>['class'=>'form-control'],'label'=>'Descripción'])

        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Product::class,
        ]);
    }
}
