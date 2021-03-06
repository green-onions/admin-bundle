<?php
/**
 * Créé par Aropixel @2020.
 * Par: Joël Gomez Caballe
 * Date: 04/07/2020 à 19:21
 */

namespace Aropixel\AdminBundle\Form\Type\Page;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\DateTimeType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class PublishableType extends AbstractType
{

    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('status', ChoiceType::class, array(
                'choices'  => array(
                    'Oui' => 'online',
                    'Non' => 'offline',
                ),
                'empty_data' => 'Non',
                'expanded' => true
            ))
        ;

        if ($options['publishAt'] !== false) {
            $builder
                ->add('publishAt', DateTimeType::class, array(
                    'required' => false,
                    'date_widget' => 'single_text',
                    'time_widget' => 'single_text',
                    'date_format' => 'yyyy-MM-dd',
                    'years' => range(date('Y') - 50, date('Y') + 50),
                ))
            ;
        }

        if ($options['publishUntil'] !== false) {
            $builder
                ->add('publishUntil', DateTimeType::class, array(
                    'required' => false,
                    'date_widget' => 'single_text',
                    'time_widget' => 'single_text',
                    'date_format' => 'yyyy-MM-dd',
                    'years' => range(date('Y') - 50, date('Y') + 50),
                ))
            ;
        }

    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver
            ->setDefaults(array(
                'publishAt' => false,
                'publishUntil' => false,
            ))
        ;
    }

}
