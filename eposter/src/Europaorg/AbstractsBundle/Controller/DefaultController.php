<?php

namespace Europaorg\AbstractsBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class DefaultController extends Controller
{
    public function indexAction($name)
    {
        return $this->render('EuropaorgAbstractsBundle:Default:index.html.twig', array('name' => "toto".$name."kkk"));
    }


    public function listAction()
    {

        $repository =$this->getDoctrine()->getManager()->getRepository('EuropaorgAbstractsBundle:Abstracts');
        $listeAbstracts = $repository->findAll();
        foreach($listeAbstracts as $abstract) {
            echo $abstract->getTitle();
        }


        return $this->render('EuropaorgAbstractsBundle:Default:list.html.twig', array ('abstracts'=>$listeAbstracts));
    }
}
