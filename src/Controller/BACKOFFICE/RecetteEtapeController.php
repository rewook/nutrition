<?php

namespace App\Controller\BACKOFFICE;

use App\Entity\Etape;
use App\Entity\Recette;
use App\Form\RecetteEtapeType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class RecetteEtapeController extends AbstractController
{
    #[Route('/recette/etape/{id}', name: 'app_recette_etape')]
    public function index($id,Request $request): Response
    {

        $recette = $this->getDoctrine()->getRepository(Recette::class)->find($id);


        $listeetapes= $recette->getEtape();


        $etape = new Etape();
        $form = $this->createForm(RecetteEtapeType::class, $etape);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $data = $form->getData();
            dd($data);
            $etape->setRecette($recette);
            $em = $this->getDoctrine()->getManager();
            $em->persist($etape);
            $em->flush();
            $this->addFlash('success', 'L\'étape a bien été ajoutée');

            return $this->redirectToRoute('app_recette_etape', ['id' => $id]);
        }


        return $this->render('backoffice/recette_etape/index.html.twig', [
            'form' => $form->createView(),
            'listeetapes' => $listeetapes,
            'recette' => $id,
        ]);
    }
}
