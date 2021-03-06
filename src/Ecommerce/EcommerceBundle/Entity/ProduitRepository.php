<?php

namespace Ecommerce\EcommerceBundle\Entity;

use Doctrine\ORM\EntityRepository;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;

/**
 * ProduitRepository
 *
 * This class was generated by the Doctrine ORM. Add your own custom
 * repository methods below.
 */
class ProduitRepository extends EntityRepository
{
	public function getProdByCatAction($id){
		$query = $this->_em->createQuery("SELECT p,c FROM EcommerceBundle:Produit p JOIN p.categorie c WHERE c.id=". $id);
		$results = $query->getResult();
		return $results;
	}
	public function afficherProd($id){
		$query = $this->_em->createQuery("SELECT p,f FROM EcommerceBundle:Produit p JOIN p.fournisseur f WHERE f.id=". $id);
		$results = $query->getArrayResult();
		return $results;
	}
	public function getProduit($id){
	  $produit=new Produit();
	  $query = $this->_em->createQuery("SELECT p FROM EcommerceBundle:Produit p WHERE p.id=$id");
	  $results = $query->getResult();
	  return $results;
    }
    public function afficheAllProd(){
    	$query = $this->_em->createQuery("SELECT p,i FROM EcommerceBundle:Produit p JOIN p.image i");
		$results = $query->getResult();
		return $results;
    }
    public function getProduits($id){
    	$query = $this->_em->createQuery("SELECT p,i FROM EcommerceBundle:Produit p JOIN p.image i WHERE p.id=$id");
		$results = $query->getResult();
		return $results;
    }
    public function getProduitByCategorie($id){
    	$query = $this->_em->createQuery("SELECT p,c FROM EcommerceBundle:Produit p JOIN p.categorie c WHERE c.id=$id ORDER BY p.prixUnitaire ASC");
		$results = $query->getResult();
		return $results;
    }
    public function getProducts($tableau){
    	$query=$this->createQueryBuilder('p')
    		->select('p')
    		->where('p.id IN (:tab)')
    		->setParameter('tab',$tableau);
    		return $query->getQuery()->getResult();
    }
}
