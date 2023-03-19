<?php

namespace App\Controller;

use App\Entity\Recette;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class PatientController extends AbstractController
{
    #[Route('/patient', name: 'app_patient')]
    public function index(EntityManagerInterface $manager): Response
    {
        $patient = $this->getUser();
        $allergenes = $patient->getAllergene();
        $regimes = $patient->getRegime();
        $recettes = $manager->getRepository(Recette::class)
            ->findRecettesSansAllergenesEtRegimes($allergenes, $regimes);



        return $this->render('patient/index.html.twig', [
            'recettes' => $recettes,
        ]);
    }
}
