<?php

namespace Stampi\AdminBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class InventoryType extends AbstractType
{
    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('altered')
            ->add('signed')
            ->add('blocked')
            ->add('customImage')
        ;
    }
    
    /**
     * @param OptionsResolverInterface $resolver
     */
    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'Stampi\AdminBundle\Entity\Inventory'
        ));
    }

    /**
     * @return string
     */
    public function getName()
    {
        return 'stampi_adminbundle_inventory';
    }
}
