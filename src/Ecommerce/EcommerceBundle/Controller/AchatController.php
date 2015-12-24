<?php

namespace Ecommerce\EcommerceBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Ecommerce\EcommerceBundle\Entity\Achat;
use Ecommerce\EcommerceBundle\Entity\Produit;
use Ecommerce\EcommerceBundle\Entity\DetailAchat;
use Ecommerce\EcommerceBundle\Form\AchatType;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\JsonResponse;

class AchatController extends Controller
{
    public function indexAction()
    {
      $achat = new Achat();
      $req = $this->getRequest();
      $em = $this->getDoctrine()->getManager();
    	$form = $this->createForm(new AchatType(), $achat);
      $form->handleRequest($req);
      if($req->getMethod()==='POST'){
        $em->persist($achat);
        $em->flush();
        $idP=$req->request->get('idProd');
        foreach($idP as $i=>$value)
        {
          $dtlcht[$i] = new DetailAchat();
          $dtlcht[$i]->setAchat($achat);
          $dtlcht[$i]->setProduit($em->getRepository('EcommerceBundle:Produit')->findOneById($_POST['idProd'][$i]));
          $dtlcht[$i]->setQteachetee($_POST['qte'][$i]);
          $em->persist($dtlcht[$i]);
        }
        $em->flush();
      }
      return $this->render('EcommerceBundle:Formulaire:achat.html.twig', array('frm' => $form->createView()));
    }
    public function afficheProduitAction(){
      $req=$this->getRequest();
    	$rep = $this
    		->getDoctrine()
            ->getManager()
            ->getRepository('EcommerceBundle:Produit');
            if($req->getMethod()=='POST'){
              $listprod = $rep->afficherProd($req->request->get('idF'));
            }
        return new JsonResponse($listprod);
    }
    public function getStockAction(){
        $rep = $this
        ->getDoctrine()
            ->getManager()
            ->getRepository('EcommerceBundle:DetailAchat');
        $achat=$rep->getAchat();
        $vente=$rep->getVente();
        return $this->render('EcommerceBundle:Formulaire:stock.html.twig',array('achat'=>$achat,'vente'=>$vente));
    }
}