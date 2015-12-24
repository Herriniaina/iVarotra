<?php

namespace Ecommerce\EcommerceBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Ecommerce\EcommerceBundle\Entity\Categorie;
use Ecommerce\EcommerceBundle\Form\CategorieType;
use Symfony\Component\HttpFoundation\Request;

class CategorieController extends Controller
{
    public function indexAction(Request $req)
    {
        if (! $this->container->get('security.context')->isGranted('ROLE_ADMIN'))
        {
           return $this->redirect($this->generateUrl('homepage'));           
        }else{
        	$categorie = new Categorie();
        	$form = $this->createForm(new CategorieType(), $categorie);
        	$em=$this->getDoctrine()->getManager();

            //AFFICHAGE TABLEAU
              $rep = $this
                ->getDoctrine()
                ->getManager()
                ->getRepository('EcommerceBundle:Categorie');
              $listCategorie = $rep->afficherTout();

            //TRAITEMENT FORMULAIRE
        	if($req->getMethod()=='POST'){
        		$form->handleRequest($req);
        		$em->persist($categorie);
        		$em->flush();
        		return $this->redirect($this->generateUrl('ecommerce_ajoutcategorie'));
        	}
            return $this->render('EcommerceBundle:Formulaire:ajoutCategorie.html.twig', array('form' => $form->createView(),'liste'=>$listCategorie));
        }
    }
    public function suppressionAction(Request $req){
        if($req->isXmlHttpRequest()){
            $id=$req->request->get('id');
            $em = $this->getDoctrine()->getManager();
            $cat=$em->getRepository('EcommerceBundle:Categorie')->find($id);            
            if(!$cat){
                 throw $this->createNotFoundException('Categorie introuvable');
            }else{
                $em->remove($cat);
                $em->flush();            
            }       
        }
        return $this->redirect($this->generateUrl('ecommerce_ajoutcategorie'));
    }
    public function modificationAction(Request $req){
        if($req->isXmlHttpRequest()){
            $id=$req->request->get('id');
            $nomcat=$req->request->get('nomcat');
            $em = $this->getDoctrine()->getManager();
            $cat=$em->getRepository('EcommerceBundle:Categorie')->find($id);
            if($cat){
                $cat->setNomCategorie($nomcat);
                $em->flush();
                return   $this->redirect($this->generateUrl('ecommerce_ajoutcategorie'));
            }else{
                return new Response('Id Introuvable');
            }
        }
    }
}