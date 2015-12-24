<?php

namespace Ecommerce\EcommerceBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\HttpFoundation\File\UploadedFile;
use Symfony\Component\Validator\Constraints as Assert;
/**
 * Produit
 *
 * @ORM\Table(name="tblproduit")
 * @ORM\Entity(repositoryClass="Ecommerce\EcommerceBundle\Entity\ProduitRepository")
 */
class Produit
{
    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="libelle_produit", type="string", length=255)
     */
    private $libelleProduit;

    /**
     * @var integer
     *
     * @ORM\Column(name="prix_unitaire", type="bigint")
     */
    private $prixUnitaire;

    /**
     * @var string
     *
     * @ORM\Column(name="description", type="text")
     */
    private $description;


    /**
     * @var integer
     *
     * @ORM\Column(name="qte_reappro", type="integer",options={"default":10},nullable=false)
     */
    private $qte_reappro;

    /**
     * @var integer
     *
     * @ORM\Column(name="qte_alerte", type="integer",options={"default":5},nullable=false)
     */
    private $qte_alerte;

    /**
     * @var Fournisseur $fournisseur
     *
     * @ORM\ManyToOne(targetEntity="Fournisseur",inversedBy="produit",cascade={"persist","remove","merge"})
     *@ORM\JoinColumns({@ORM\JoinColumn(name="Fournisseur_idFournisseur",referencedColumnName="id_fournisseur",nullable=false)})
     */
    private $fournisseur;

    /**
     * @var Image $image
     *
     * @ORM\OneToOne(targetEntity="Image",cascade={"persist"})
     */
    private $image;

    /**
     * @var Categorie $categorie
     *
     * @ORM\ManyToOne(targetEntity="Categorie",inversedBy="produits",cascade={"persist","remove","merge"})
     *@ORM\JoinColumns({@ORM\JoinColumn(name="Categorie_idCategorie",referencedColumnName="id_categorie",nullable=false)})
     */
    private $categorie;


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
     * Set libelleProduit
     *
     * @param string $libelleProduit
     * @return Produit
     */
    public function setLibelleProduit($libelleProduit)
    {
        $this->libelleProduit = $libelleProduit;
    
        return $this;
    }

    /**
     * Get libelleProduit
     *
     * @return string 
     */
    public function getLibelleProduit()
    {
        return $this->libelleProduit;
    }

    /**
     * Set prixUnitaire
     *
     * @param integer $prixUnitaire
     * @return Produit
     */
    public function setPrixUnitaire($prixUnitaire)
    {
        $this->prixUnitaire = $prixUnitaire;
    
        return $this;
    }

    /**
     * Get prixUnitaire
     *
     * @return integer 
     */
    public function getPrixUnitaire()
    {
        return $this->prixUnitaire;
    }

    /**
     * Set description
     *
     * @param string $description
     * @return Produit
     */
    public function setDescription($description)
    {
        $this->description = $description;
    
        return $this;
    }

    /**
     * Get description
     *
     * @return string 
     */
    public function getDescription()
    {
        return $this->description;
    }


    /**
     * Set fournisseur
     *
     * @param \Ecommerce\EcommerceBundle\Entity\Fournisseur $fournisseur
     * @return Produit
     */
    public function setFournisseur(\Ecommerce\EcommerceBundle\Entity\Fournisseur $fournisseur = null)
    {
        $this->fournisseur = $fournisseur;
    
        return $this;
    }

    /**
     * Get fournisseur
     *
     * @return \Ecommerce\EcommerceBundle\Entity\Fournisseur 
     */
    public function getFournisseur()
    {
        return $this->fournisseur;
    }

    /**
     * Set categorie
     *
     * @param \Ecommerce\EcommerceBundle\Entity\Categorie $categorie
     * @return Produit
     */
    public function setCategorie(\Ecommerce\EcommerceBundle\Entity\Categorie $categorie = null)
    {
        $this->categorie = $categorie;
    
        return $this;
    }

    /**
     * Get categorie
     *
     * @return \Ecommerce\EcommerceBundle\Entity\Categorie 
     */
    public function getCategorie()
    {
        return $this->categorie;
    }
    public function __construct(){
        $this->qte_reappro=10;
        $this->qte_alerte=5;
    }

    /**
     * Set qte_reappro
     *
     * @param integer $qteReappro
     * @return Produit
     */
    public function setQteReappro($qteReappro)
    {
        $this->qte_reappro = $qteReappro;
    
        return $this;
    }

    /**
     * Get qte_reappro
     *
     * @return integer 
     */
    public function getQteReappro()
    {
        return $this->qte_reappro;
    }

    /**
     * Set qte_alerte
     *
     * @param integer $qteAlerte
     * @return Produit
     */
    public function setQteAlerte($qteAlerte)
    {
        $this->qte_alerte = $qteAlerte;
    
        return $this;
    }

    /**
     * Get qte_alerte
     *
     * @return integer 
     */
    public function getQteAlerte()
    {
        return $this->qte_alerte;
    }


    /**
     * Set image
     *
     * @param \Ecommerce\EcommerceBundle\Entity\Image $image
     * @return Produit
     */
    public function setImage(\Ecommerce\EcommerceBundle\Entity\Image $image = null)
    {
        $this->image = $image;
    
        return $this;
    }

    /**
     * Get image
     *
     * @return \Ecommerce\EcommerceBundle\Entity\Image 
     */
    public function getImage()
    {
        return $this->image;
    }
}