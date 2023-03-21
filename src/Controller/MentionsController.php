<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class MentionsController extends AbstractController
{
    #[Route('/mentions/legales', name: 'app_mentions_legales')]
    public function legale(): Response
    {
        return $this->render('mentions/legale.html.twig');
    }

    #[Route('/mentions/rgpd', name: 'app_mentions_rgpd')]
    public function rgpd(): Response
    {
        return $this->render('mentions/rgpd.html.twig');
    }
}
