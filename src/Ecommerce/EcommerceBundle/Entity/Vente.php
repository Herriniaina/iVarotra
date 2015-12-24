<?php

namespace Ecommerce\EcommerceBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Ecommerce\UserBundle\Entity\User;

/**
 * Vente
 *
 * @ORM\Table(name="tblvente")
 * @ORM\Entity(repositoryClass="Ecommerce\EcommerceBundle\Entity\VenteRepository")
 */
class Vente
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
    private $datevente;


    /**
     * @var Utilisateur $utilisateur
     * 
     * @ORM\ManyToOne(targetEntity="\Ecommerce\UserBundle\Entity\User",inversedBy="Utilisateur",cascade={"persist","remove"})
     * @ORM\JoinColumn(name="Utilisateur_idUtilisateur",referencedColumnName="id")
     */
    private $utilisateur;

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
     * Set dateVente
     *
     * @param \DateTime $dateVente
     * @return Vente
     */
    public function setDateVente($datevente)
    {
        $this->datevente = $datevente;
    
        return $this;
    }

    /**
     * Get dateVente
     *
     * @return \DateTime 
     */
    public function getDateVente()
    {
        return $this->datevente;
    }

    public function __construct(){
        $this->datevente = new \DateTime();
    }


    /**
     * Set utilisateur
     *
     * @param \Ecommerce\UserBundle\Entity\User $utilisateur
     * @return Vente
     */
    public function setUtilisateur(\Ecommerce\UserBundle\Entity\User $utilisateur = null)
    {
        $this->utilisateur = $utilisateur;

        return $this;
    }

    /**
     * Get utilisateur
     *
     * @return \Ecommerce\UserBundle\Entity\User
     */
    public function getUtilisateur()
    {
        return $this->utilisateur;
    }
}