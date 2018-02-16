<?php

namespace App\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Response;

class IndexController extends Controller
{
    /**
     * @Route("/", name="index")
     */
    public function index()
    {
        $em = $this->container->get('doctrine')->getManager();
        
        return $this->render('Index/index.html.twig', array(
            'hotels' => $em->getRepository("App:Hotel")->findAll(),
            'flights' => $em->getRepository("App:Flight")->findAll(),
        ));
    }
}
