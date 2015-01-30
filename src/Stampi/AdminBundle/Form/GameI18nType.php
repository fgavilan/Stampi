<?php

namespace Stampi\AdminBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class GameI18nType extends AbstractType
{
    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('name')
            ->add('description')
            ->add('language','entity',array(
                'class' => 'Stampi\AdminBundle\Entity\Language',
                'attr' => array('class' => 'hidden')
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
            'data_class' => 'Stampi\AdminBundle\Entity\GameI18n'
        ));
    }

    /**
     * @return string
     */
    public function getName()
    {
        return 'gamei18n';
    }
}
