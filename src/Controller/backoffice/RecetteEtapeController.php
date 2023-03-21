<?php

namespace App\Controller\backoffice;

use App\Entity\Etape;
use App\Entity\Recette;
use App\Form\RecetteEtapeType;
use App\Service\FileUploader;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\String\Slugger\SluggerInterface;

class RecetteEtapeController extends AbstractController
{
    #[Route('/recette/etape/{id}', name: 'app_recette_etape')]
    public function index($id, Request $request, SluggerInterface $slugger, FileUploader $fileUploader): Response
    {

        $recette = $this->getDoctrine()->getRepository(Recette::class)->find($id);

        $listeetapes = $recette->getEtape();


        $etape = new Etape();
        $form = $this->createForm(RecetteEtapeType::class, $etape);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

            //récupération des données du formulaire
            $data = $form->getData();
            $numero = $form->get('numero')->getData();
            $description = $form->get('description')->getData();
            $photo = $form->get('photo')->getData();


            if ($photo) {

                $originalFilename = pathinfo($photo->getClientOriginalName(), PATHINFO_FILENAME);
                // this is needed to safely include the file name as part of the URL
                $safeFilename = $slugger->slug($originalFilename);

                $brochureFileName = $fileUploader->upload($photo);

                $etape->setPhoto($brochureFileName);
            }

            // On génère un nouvelle étape
            $etape->setNumero($numero);
            $etape->setDescription($description);


            // On ajoute l'étape à la recette
            $recette->addEtape($etape);


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

    #[Route('/admin/etape/delete/{id}/{recette}', name: 'delete_admin_etape')]
    public function delete(Request $request, EntityManagerInterface $em, $id, $recette): Response
    {

        $etape = $em->getRepository(Etape::class)->find($id);
        $em->remove($etape);
        $em->flush();

        $this->addFlash('success', 'Etape supprimée avec succès');


        return $this->redirectToRoute('app_recette_etape', ['id' => $recette]);


    }
}
