<?php

namespace TypoScriptBackendBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class DefaultController extends Controller
{
    public function indexAction()
    {
        return $this->render('TypoScriptBackendBundle:Default:index.html.twig');
    }
}
