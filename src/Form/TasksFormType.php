<?php

namespace App\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;


class TasksFormType extends AbstractType
{
    private const INPUT_STYLE = 'form-control';
    private const LABEL_STYLE = 'form-label mt-3 fw-bold text-dark';

    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('name', TextType::class, [
                'label' => 'Nombre:',
                'label_attr' => [
                    'class' => self::LABEL_STYLE
                ],
                'attr' => [
                    'class' => self::INPUT_STYLE,
                    'id' => 'user_form_name',
                    'placeholder' => 'Escribe nombre tarea aquí',
                ]
            ])
            ->add('description', TextType::class, [
                'label' => 'descripcion',
                'label_attr' => [
                    'class' => self::LABEL_STYLE
                ],
                'attr' => [
                    'class' => self::INPUT_STYLE,
                    'id' => 'user_form_description',
                    'placeholder' => 'Escribe la descripcion aquí',
                ]
            ])
            ->add('expiration_date', TextType::class, [
                'label' => 'Fecha de termino:',
                'label_attr' => [
                    'class' => self::LABEL_STYLE
                ],
                'attr' => [
                    'class' => self::INPUT_STYLE,
                    'id' => 'user_form_expiration_date',
                    'placeholder' => 'Ingresar la fecha de terminoí',
                ],
            ])
            ->add('state', ChoiceType::class, [
                'label' => 'Estado:',
                'choices' => [
                    'Activo' => true,
                    'Inactivo' => false,
                ],
                'expanded' => true, // Muestra los botones de opción en lugar de un desplegable
                'multiple' => false, // Permite solo una selección
                'label_attr' => [
                    'class' => self::LABEL_STYLE
                ],

            ])
            ->add('priority', TextType::class, [
                'label' => 'prioridad:',
                'label_attr' => [
                    'class' => self::LABEL_STYLE
                ],
                'attr' => [
                    'class' => self::INPUT_STYLE,
                    'id' => 'user_form_priority',
                    'placeholder' => 'Ingresar la prioridad',
                ],
            ])
            ->add('responsible', TextType::class, [
                'label' => 'responsable:',
                'label_attr' => [
                    'class' => self::LABEL_STYLE
                ],
                'attr' => [
                    'class' => self::INPUT_STYLE,
                    'id' => 'user_form_responsible',
                    'placeholder' => 'Ingresar el encargado de la tarea',
                ],
            ]);
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            // Configure your form options here
        ]);
    }
}
