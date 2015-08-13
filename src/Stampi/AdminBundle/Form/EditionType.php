<?php

namespace Stampi\AdminBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class EditionType extends AbstractType
{
    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('publishDate', 'date', array(
                    'attr' => array('class' => 'datepicker')
                )
            )
            ->add('textI18n', 'collection', array(
                    'type' => new textI18nType(),
                    'allow_add' => true,
                    'allow_delete' => true,
                    'prototype' => true,
                    'by_reference' => false
                )
            )
            ->add('symbol')
        ;
    }
    
    /**
     * @param OptionsResolverInterface $resolver
     */
    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'Stampi\AdminBundle\Entity\Edition'
        ));
    }

    /**
     * @return string
     */
    public function getName()
    {
        return 'stampi_adminbundle_edition';
    }
}
