<?php

namespace Ecommerce\EcommerceBundle\Entity;

use Doctrine\ORM\EntityRepository;

/**
 * DetailAchatRepository
 *
 * This class was generated by the Doctrine ORM. Add your own custom
 * repository methods below.
 */
class DetailAchatRepository extends EntityRepository
{
	public function getAchat(){
	  $query = $this->_em->createQuery("SELECT IDENTITY(d.produit) as idProduit,SUM(d.qteachetee) as qteStock,p.libelleProduit FROM EcommerceBundle:DetailAchat d LEFT JOIN d.produit p WHERE  p.id=d.produit GROUP BY d.produit");
	  $results = $query->getResult();
	  return $results;
	}
	public function getVente(){
	  $query = $this->_em->createQuery("SELECT IDENTITY(d.produit) as idProduit,SUM(d.qtevendue) as qteStock,p.libelleProduit FROM EcommerceBundle:DetailVente d LEFT JOIN d.produit p WHERE  p.id=d.produit GROUP BY d.produit");
	  $results = $query->getResult();
	  return $results;
	}
}