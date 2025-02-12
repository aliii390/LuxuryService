<?php

namespace App\Form;

use App\DTO\ContactDTO;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\TelType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class ContactType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('firstname' , TextType::class , [
                // 'empty-data' => "",
                'label' =>  "Firstname"
            ])
            ->add('lastname' , TextType::class , [
                // 'empty-data' => "",
                'label' =>  "Lastname",
                // 'empty_data' => '',
            ])
         ->add('email')
            ->add('phone' , TelType::class , [
                // 'empty-data' => "",
                'label' =>  "Phone",
                // 'empty_data' => ''
            ])
            ->add('message', TextareaType::class, [
                // 'empty_data' => '',
                'label' => 'Message',
                // 'empty_data' => '',
                'required' => true,
                'attr' => [
                    'cols' => 50,
                    'rows' => 10,
                    'class' => 'materialize-textarea'
                ],
            ])
         
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => ContactDTO::class,
        ]);
    }
}
