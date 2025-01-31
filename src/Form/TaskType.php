<?php

namespace App\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;

class TaskType extends AbstractType
{
    private const INPUT_STYLE = 'form-control';
    private const LABEL_STYLE = 'form-label mt-3 fw-bold text-dark';

    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('nombre', TextType::class, [
                'label' => 'Nombre:',
                'label_attr' => [
                    'class' => self::LABEL_STYLE
                ],
                'attr' => [
                    'class' => self::INPUT_STYLE,
                    'id' => 'user_form_nombre'
                ]
            ])
            ->add('descripcion', TextType::class, [
                'label' => 'Descripción:',
                'label_attr' => [
                    'class' => self::LABEL_STYLE
                ],
                'attr' => [
                    'class' => self::INPUT_STYLE,
                    'id' => 'user_form_descripcion'
                ]
            ])
            ->add('fechaexpiracion', TextType::class, [
                'label' => 'Fecha de término:',
                'label_attr' => [
                    'class' => self::LABEL_STYLE
                ],
                'attr' => [
                    'class' => self::INPUT_STYLE,
                    'id' => 'user_form_fechaexpiracion'
                ],
            ])
            ->add('estado', ChoiceType::class, [
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
            ->add('prioridad', TextType::class, [
                'label' => 'Prioridad:',
                'label_attr' => [
                    'class' => self::LABEL_STYLE
                ],
                'attr' => [
                    'class' => self::INPUT_STYLE,
                    'id' => 'user_form_prioridad'
                ],
            ])
            ->add('responsable', TextType::class, [
                'label' => 'Responsable:',
                'label_attr' => [
                    'class' => self::LABEL_STYLE
                ],
                'attr' => [
                    'class' => self::INPUT_STYLE,
                    'id' => 'user_form_responsable'
                ],
            ]);
    }
}
