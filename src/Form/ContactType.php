<?php

namespace App\Form;

use App\Entity\Contact;
use App\Entity\Group;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\CollectionType;

class ContactType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('lastname', TextType::class, [
                'required' => true,
            ])
            ->add('firstname', TextType::class, [
                'required' => true,
            ])
            ->add('number', TextType::class, [
                'required' => true,
            ])
            ->add('mail', TextType::class, [
                'required' => true,
            ])
            ->add('pictureFile', FileType::class, [
                'label' => 'Upload Image',
                'required' => false,
                'mapped' => false,
                'attr' => ['accept' => 'image/*'],
            ])
            ->add('pictureUrl', TextType::class, [
                'label' => 'Image URL',
                'required' => false,
                'mapped' => false,
            ])
            ->add('customFields', CollectionType::class, [
                'entry_type' => CustomFieldType::class,
                'entry_options' => ['label' => false],
                'allow_add' => true,
                'allow_delete' => true,
                'by_reference' => false,
            ])
            ->add('groups', EntityType::class, [
                'class' => 'App\Entity\Group',
                'choice_label' => 'name',
                'required' => false,
                'multiple' => true,
                'expanded' => false,
            ]);
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Contact::class,
        ]);
    }
}
