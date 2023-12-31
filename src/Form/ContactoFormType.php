<?php

namespace App\Form;

use App\Entity\Contactos;
use App\Entity\Provincia;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Validator\Constraints\File;

class ContactoFormType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('nombre', TextType::class)
            ->add('telefono' , TextType::class)
            ->add('email' , EmailType::class, array(
                'label' => 'Correo electronico'))
            ->add('provincia', EntityType::class, array(
                'class' => Provincia::class,
                'choice_label' => 'nombre'))
            
            ->add('file', FileType::class,[
                'mapped' => false,
                'constraints' => [
                    new File([
                        'mimeTypes' => [
                            'image/jpeg',
                            'image/png',
                        ],
                        'mimeTypesMessage' => 'Please upload a valid image file',
                    ])
                ],
            ])
            ->add('save', SubmitType::class, array(
                'label' => 'Enviar'));
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Contactos::class,
        ]);
    }
}
