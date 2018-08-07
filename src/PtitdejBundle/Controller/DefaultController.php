<?php

namespace PtitdejBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class DefaultController extends Controller
{
    public function indexAction()
    {
        return $this->render('@Ptitdej/Default/index.html.twig');
    }
}
