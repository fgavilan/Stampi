<?php

namespace Stampi\AdminBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class GameType extends AbstractType
{
    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('publishDate', 'time', array(
                'widget'  => 'single_text',
                'attr' => array('class' => 'datepicker')
                )
            )
            ->add('imageFolder')
            ->add('gameI18n', 'collection', array(
                    'type' => new TextI18nType(),
                    'allow_add'    => true,
                    'allow_delete' => true,
                    'prototype' => true,
                    'by_reference' => false
                )
            )
        ;
    }
    
    /**
     * @param OptionsResolverInterface $resolver
     */
    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'Stampi\AdminBundle\Entity\Game'
        ));
    }

    /**
     * @return string
     */
    public function getName()
    {
        return 'stampi_adminbundle_game';
    }
}
