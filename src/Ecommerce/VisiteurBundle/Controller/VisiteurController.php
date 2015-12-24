<?php

namespace Ecommerce\VisiteurBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Ecommerce\EcommerceBundle\Form\CategorieType;
use Ecommerce\EcommerceBundle\Entity\Categorie;
use Ecommerce\EcommerceBundle\Entity\Produit;
use Knp\Bundle\PaginatorBundle\KnpPaginatorBundle;

class VisiteurController extends Controller
{
      public function indexAction(Request $request)
    {
      $em=$this->getDoctrine()->getManager();
        if(isset($_POST['form']['id']) && $_POST['form']['id'] != null){
        $dql = "SELECT p,c FROM EcommerceBundle:Produit p JOIN p.categorie c WHERE c.id=" . $_POST['form']['id'] ." ORDER BY p.prixUnitaire ASC";
        $em=$this->getDoctrine()->getManager();
        $query = $em->createQuery($dql);
        $paginator  = $this->get('knp_paginator');
        $pagination = $paginator->paginate(
            $query,
            $request->query->getInt('page', 1),
            12
        ); 
        }else{
      $dql = "SELECT p,i FROM EcommerceBundle:Produit p JOIN p.image i ORDER BY p.prixUnitaire ASC";
      $em=$this->getDoctrine()->getManager();
      $query = $em->createQuery($dql);
      $paginator  = $this->get('knp_paginator');
      $pagination = $paginator->paginate(
          $query,
          $request->query->getInt('page', 1),
          12
      );
    }
      $cat = new Categorie();
        $formBuilder = $this->get('form.factory')->createBuilder('form', $cat);
        $formBuilder
          ->add('id','entity',array('class'=>'Ecommerce\EcommerceBundle\Entity\Categorie','property'=>'nom_categorie','empty_value'=>'filtrer par categorie...','required'=>false));
        $form = $formBuilder->getForm();
        if($this->container->get('security.context')->getToken()->getUser() !== 'anon.'){
          $user=$this->container->get('security.context')->getToken()->getUser();
        }else{
          $user='Panier';
        }
       $session=$this->getRequest()->getSession();
       if($session->get('panier')!=null){
          $nb=count($session->get('panier'));
       }else{
          $nb=0;
       }
       return $this->render('VisiteurBundle:Formulaire:catalogue.html.twig',array('pagination'=>$pagination,'frm'=>$form->createView(),'nb'=>$nb,'user'=>$user));
    }
    public function modifierDetailAction($id){
        $em = $this->getDoctrine()->getManager();
        $rep = $em->getRepository('EcommerceBundle:Produit');
        $prods = $rep->getProduits($id);
       return $this->render('VisiteurBundle:Formulaire:modifierqte.html.twig',array('prods'=>$prods));
    }
    public function voirDetailAction(){
        $request=$this->getRequest();
        $em = $this->getDoctrine()->getManager();
        $rep = $em->getRepository('EcommerceBundle:Produit');
        if($request->getMethod() === 'POST'){
            $prods = $rep->getProduits($request->request->get('idProduit'));
        }
       return $this->render('VisiteurBundle:Formulaire:voirdetail.html.twig',array('prods'=>$prods));
    }
    public function afficheDetailProdAction(Request $req){
    	if($req->getMethod() == "POST"){
	     	 $rep=$this->getDoctrine()->getManager();
	       $res=$rep->getRepository('EcommerceBundle:Produit')->getProduits($req->request->get('idProduct'));   		
	       return new JsonResponse($res);
	   }
    }
}
