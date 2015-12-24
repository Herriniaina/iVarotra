<?php

namespace Ecommerce\EcommerceBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Ecommerce\EcommerceBundle\Entity\Produit;
use Ecommerce\EcommerceBundle\Form\ProduitType;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\File\UploadedFile;

class ProduitController extends Controller
{
    public function indexAction(Request $req)
    {
    	$produit = new Produit();
    	$form = $this->createForm(new ProduitType(), $produit);
    	$em=$this->getDoctrine()->getManager();
    	if($req->getMethod()=='POST'){
    		$form->handleRequest($req);
    		$em->persist($produit);
    		$em->flush();
    		 return $this->redirect($this->generateUrl('ecommerce_ajoutproduit'));
    	}
        return $this->render('EcommerceBundle:Formulaire:ajoutProduit.html.twig', array('frm' => $form->createView()));
    }
}