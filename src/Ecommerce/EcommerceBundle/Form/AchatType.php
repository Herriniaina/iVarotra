<?php

namespace Ecommerce\EcommerceBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class AchatType extends AbstractType
{
        /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('dateAchat','date',array('format'=>'dd/MM/yyyy','widget'=>'single_text'))
            ->add('fournisseur','entity',array('class'=>'EcommerceBundle:Fournisseur','property'=>'nom_fournisseur','empty_value' => 'Choisissez un fournisseur...'))
            ->add('cmdValider','submit',array('label'=>'Enregistrer l\'achat'));
    }
    
    /**
     * @param OptionsResolverInterface $resolver
     */
    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'Ecommerce\EcommerceBundle\Entity\Achat'
        ));
    }

    /**
     * @return string
     */
    public function getName()
    {
        return 'ecommerce_ecommercebundle_achat';
    }
}
