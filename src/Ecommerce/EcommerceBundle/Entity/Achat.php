<?php

namespace Ecommerce\EcommerceBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Achat
 *
 * @ORM\Table(name="tblachat")
 * @ORM\Entity(repositoryClass="Ecommerce\EcommerceBundle\Entity\AchatRepository")
 */
class Achat
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
     * @var \DateTime
     *
     * @ORM\Column(name="date_achat", type="date")
     */
    private $dateachat;


    /**
     * @var Fournisseur $fournisseur
     * 
     * @ORM\ManyToOne(targetEntity="Fournisseur",inversedBy="Fournisseur",cascade={"persist","remove"})
     * @ORM\JoinColumn(name="Fournisseur_idFournisseur",referencedColumnName="id_fournisseur")
     */
    private $fournisseur;

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
     * Set dateAchat
     *
     * @param \DateTime $dateAchat
     * @return Achat
     */
    public function setDateAchat($dateachat)
    {
        $this->dateachat = $dateachat;
    
        return $this;
    }

    /**
     * Get dateAchat
     *
     * @return \DateTime 
     */
    public function getDateAchat()
    {
        return $this->dateachat;
    }

    public function __construct(){
        $this->dateachat = new \DateTime();
    }


    /**
     * Set fournisseur
     *
     * @param \Ecommerce\EcommerceBundle\Entity\Fournisseur $fournisseur
     * @return Achat
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
}