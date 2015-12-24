<?php

namespace Ecommerce\EcommerceBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Ecommerce\EcommerceBundle\Entity\Fournisseur;
use Ecommerce\EcommerceBundle\Form\FournisseurType;
use Symfony\Component\HttpFoundation\Request;
class FournisseurController extends Controller
{
    public function indexAction(Request $req)
    {
    	$fournisseur = new Fournisseur();
    	$form = $this->createForm(new FournisseurType(), $fournisseur);
    	$em=$this->getDoctrine()->getManager();
    	if($req->getMethod()=='POST'){
    		$form->handleRequest($req);
    		$em->persist($fournisseur);
    		$em->flush();
    		 return $this->redirect($this->generateUrl('ecommerce_ajoutfournisseur'));
    	}
        return $this->render('EcommerceBundle:Formulaire:ajoutFournisseur.html.twig', array('form' => $form->createView()));
    }
}