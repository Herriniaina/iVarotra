<?php

namespace Ecommerce\EcommerceBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class ProduitType extends AbstractType
{
        /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('libelleProduit')
            ->add('prixUnitaire')
            ->add('description')
            ->add('image',new ImageType())
            ->add('qte_reappro')
            ->add('qte_alerte')
            ->add('fournisseur','entity',array('class'=>'EcommerceBundle:Fournisseur','property'=>'nom_fournisseur'))
            ->add('categorie','entity',array('class'=>'EcommerceBundle:Categorie','property'=>'nom_categorie'))
            ->add('cmdValider','submit',array('label'=>'ENREGISTRER'))
        ;
    }
    
    /**
     * @param OptionsResolverInterface $resolver
     */
    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'Ecommerce\EcommerceBundle\Entity\Produit'
        ));
    }

    /**
     * @return string
     */
    public function getName()
    {
        return 'ecommerce_ecommercebundle_produit';
    }
}
