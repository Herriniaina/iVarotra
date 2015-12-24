<?php
namespace Ecommerce\EcommerceBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Table(name="tbldetailvente")
 * @ORM\Entity(repositoryClass="Ecommerce\EcommerceBundle\Entity\DetailVenteRepository")
 */
class DetailVente {
     /**
      * @ORM\Id
      * @ORM\ManyToOne(targetEntity="Ecommerce\EcommerceBundle\Entity\Vente")
      */
    private $vente;
    
    /**
     * @ORM\Id
     * @ORM\ManyToOne(targetEntity="Ecommerce\EcommerceBundle\Entity\Produit")
     */
    private $produit;
    
    
    /**
     * @ORM\Column(name="qte_vendue", type="integer")
     */
    private $qtevendue;
    

    public function __construct() {
    }

    public function setProduit(\Ecommerce\EcommerceBundle\Entity\Produit $produit) {
        $this->produit = $produit;
        return $this;
    }

    public function getProduit() {
        return $this->produit;
    }

    public function setVente(\Ecommerce\EcommerceBundle\Entity\Vente $vente){
        $this->vente = $vente;
        return $this;
    }

    public function getVente() {
        return $this->vente;
    }

    /**
     * Set qtevendue
     *
     * @param integer $qtevendue
     * @return DetailVente
     */
    public function setQtevendue($qtevendue)
    {
        $this->qtevendue = $qtevendue;
    
        return $this;
    }

    /**
     * Get qtevendue
     *
     * @return integer
     */
    public function getQtevendue()
    {
        return $this->qtevendue;
    }
}