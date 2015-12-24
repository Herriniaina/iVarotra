<?php

namespace Ecommerce\VisiteurBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Session\Session;
use Ecommerce\EcommerceBundle\Entity\Produit;
use Ecommerce\EcommerceBundle\Entity\Vente;
use Ecommerce\EcommerceBundle\Entity\DetailVente;

class PanierController extends Controller
{
    public function ajoutPanierAction(Request $req){
            $session = $this->getRequest()->getSession();
            $id=$req->request->get('idProd');
            $qte=$req->request->get('qte');
                 if(! $session->has('panier')){ 
                    $session->set('panier',array());
                 }
                 $panier=$session->get('panier');
                 if(! in_array($id,$panier)){
                        $panier[$id]=$qte;
                }
               $session->set('panier',$panier);
             return $this->redirect($this->generateUrl('visiteur_affichelistepanier'));
    }
    public function listePanierAction(){
        $session=$this->getRequest()->getSession();
        if($session->get('panier') != null){
            $rep=$this->getDoctrine()->getManager();
            $p = $rep->getRepository('EcommerceBundle:Produit')->getProducts(array_keys($session->get('panier')));
            return $this->render('VisiteurBundle:Formulaire:panier.html.twig',array('session'=>$p,'qte'=>$session->get('panier')));            
        }else{
            return $this->redirect($this->generateUrl('homepage'));
        }
    }
    public function supprimerSessionAction($id){
        $session=$this->getRequest()->getSession();
        $pan = $session->get('panier');
        if(array_key_exists($id,$pan)){
            unset($pan[$id]);
        }
        $session->set('panier',$pan);
        if($session->get('panier') != null){
            return $this->redirect($this->generateUrl('visiteur_affichelistepanier'));
        }else{
            return $this->redirect($this->generateUrl('homepage'));
        }
    }
    public function modifierSessionAction($id){
        $session=$this->getRequest()->getSession();
        $pan = $session->get('panier');
        $key=array_search($id,$pan);
        //unset($pan[$key]);
        if($key){
            $pan[$id]=$request->get('qte');
        }
        $session->set('panier',$pan);
        if($session->get('panier')!=null){
            return $this->redirect($this->generateUrl('visiteur_affichelistepanier'));
        }
    }
    public function envoierMailAction(){
        //enregistrer commande
        $req=$this->getRequest();
        $session=$this->getRequest()->getSession();
        $em=$this->getDoctrine()->getManager();
        $vente=new Vente();
        $vente->setDateVente(new \DateTime());
        $vente->setUtilisateur($this->container->get('security.context')->getToken()->getUser());
        $em->persist($vente);
        $em->flush();
        foreach($session->get('panier') as $i=>$value)
        {
          $dtlvt[$i] = new DetailVente();
          $dtlvt[$i]->setVente($vente);
          $dtlvt[$i]->setProduit($em->getRepository('EcommerceBundle:Produit')->findOneById(array('id'=>$i)));
          $dtlvt[$i]->setQtevendue($value);
          $em->persist($dtlvt[$i]);
        }
        $em->flush();
        //pdf
        foreach($session->get('panier') as $i=>$value)
        {
          $prods[$i]=$em->getRepository('EcommerceBundle:Produit')->findOneById(array('id'=>$i));
        }
        $html = $this->renderView('VisiteurBundle:Formulaire:pdf.html.twig',array('prods'=>$prods,'qte'=>$session->get('panier')));
        $html2pdf = new \Html2Pdf_Html2Pdf('P','A4','fr');
        $html2pdf->pdf->SetDisplayMode('real');
        $html2pdf->writeHTML($html);
        $pdf = './pdf/' . $this->container->get('security.context')->getToken()->getUser() . time() .'.pdf';
        $html2pdf->pdf->Output($pdf,"F");
        //mail
                $message= \Swift_Message::newInstance()
                ->setSubject('Validation achat')
                ->setFrom(array('plano.heriniaina@shasama.com'=>'iVarotra'))
                ->setTo($this->container->get('security.context')->getToken()->getUser()->getEmail())
                ->setCharset('utf-8')
                ->setContentType('text/html')
                ->setBody($this->renderView('VisiteurBundle:Formulaire:validationCommande.html.twig',array('total'=>$req->query->get('ttl'))))
                ->attach(\Swift_Attachment::fromPath($pdf));
        $transport = \Swift_SmtpTransport::newInstance('smtp.gmail.com', 587,'tls')
                    ->setUsername('rakotoarimananaherriniaina@gmail.com')
                    ->setPassword('heriniaina777');
        $session->remove('panier');
        $mailer = \Swift_Mailer::newInstance($transport);
        $mailer->send($message);
        $session->remove('panier');
        $this->get('session')->getFlashBag()->add('notice','Votre commande a bien été enregistrée, vous allez recevoir un mail de confirmation!');
        return $this->redirect($this->generateUrl('homepage'));
    }
}