<?php

namespace App\Form;

use App\Entity\Contact;
use App\Entity\CustomField;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class CustomFieldType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('name', TextType::class,
                [
                    'required' => true,
                    'label' => 'Field Name'
                ])
            ->add('value', TextType::class,
                [
                    'required' => false,
                    'label' => 'Field Value'
                ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => CustomField::class,
        ]);
    }
}
