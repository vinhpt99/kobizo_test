<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Response;

class RssController extends AbstractController
{
  #[Route('/rss-reader', name: 'rss_reader')]
  public function index(): Response
  {
    return $this->render('rss/rss_reader.html.twig');
  }
}
