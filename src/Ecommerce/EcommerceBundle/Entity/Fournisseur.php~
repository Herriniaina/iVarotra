<?php

namespace Ecommerce\EcommerceBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Fournisseur
 *
 * @ORM\Table(name="tblfournisseur")
 * @ORM\Entity(repositoryClass="Ecommerce\EcommerceBundle\Entity\FournisseurRepository")
 */
class Fournisseur
{
    /**
     * @var integer
     *
     * @ORM\Column(name="id_fournisseur", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="nom_fournisseur", type="string", length=200)
     */
    private $nomFournisseur;

    /**
     * @var string
     *
     * @ORM\Column(name="mail_fournisseur", type="string", length=100,nullable=true)
     */
    private $mailFournisseur;

    /**
     * @var string
     *
     * @ORM\Column(name="adresse_fournisseur", type="text",nullable=true)
     */
    private $adresseFournisseur;

    /**
     * @var ArrayCollection $produits
     *
     * @ORM\OneToMany(targetEntity="Produit",mappedBy="fournissseur",cascade={"persist","remove","merge"})
     */
    private $produits;

    /**
     * Get id
     *
     * @return integer
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set nomFournisseur
     *
     * @param string $nomFournisseur
     * @return Fournisseur
     */
    public function setNomFournisseur($nomFournisseur)
    {
        $this->nomFournisseur = $nomFournisseur;
    
        return $this;
    }

    /**
     * Get nomFournisseur
     *
     * @return string 
     */
    public function getNomFournisseur()
    {
        return $this->nomFournisseur;
    }

    /**
     * Set mailFournisseur
     *
     * @param string $mailFournisseur
     * @return Fournisseur
     */
    public function setMailFournisseur($mailFournisseur)
    {
        $this->mailFournisseur = $mailFournisseur;
    
        return $this;
    }

    /**
     * Get mailFournisseur
     *
     * @return string 
     */
    public function getMailFournisseur()
    {
        return $this->mailFournisseur;
    }

    /**
     * Set adresseFournisseur
     *
     * @param string $adresseFournisseur
     * @return Fournisseur
     */
    public function setAdresseFournisseur($adresseFournisseur)
    {
        $this->adresseFournisseur = $adresseFournisseur;
    
        return $this;
    }

    /**
     * Get adresseFournisseur
     *
     * @return string 
     */
    public function getAdresseFournisseur()
    {
        return $this->adresseFournisseur;
    }
    /**
     * Constructor
     */
    public function __construct()
    {
        $this->produits = new \Doctrine\Common\Collections\ArrayCollection();
    }
    
    /**
     * Add produits
     *
     * @param \Ecommerce\EcommerceBundle\Entity\Fournisseur $produits
     * @return Fournisseur
     */
    public function addProduit(\Ecommerce\EcommerceBundle\Entity\Fournisseur $produits)
    {
        $this->produits[] = $produits;
    
        return $this;
    }

    /**
     * Remove produits
     *
     * @param \Ecommerce\EcommerceBundle\Entity\Fournisseur $produits
     */
    public function removeProduit(\Ecommerce\EcommerceBundle\Entity\Fournisseur $produits)
    {
        $this->produits->removeElement($produits);
    }

    /**
     * Get produits
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getProduits()
    {
        return $this->produits;
    }
}