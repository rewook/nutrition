<?php

namespace App\Controller\backoffice;

use App\Entity\Recette;
use App\Form\RecetteType;
use Doctrine\DBAL\Driver\IBMDB2\Exception\Factory;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class RecetteController extends AbstractController
{
    #[Route('/admin/recette', name: 'show_admin_recette')]
    public function show(EntityManagerInterface $em): Response
    {
        $recettes = $em->getRepository(Recette::class)->findAll();


        return $this->render('backoffice/recette/show.html.twig', [
            'recettes' => $recettes,
        ]);
    }

    #[Route('/admin/recette/add', name: 'add_admin_recette')]
    public function add(Request $request,EntityManagerInterface $em): Response
    {

        $recette = new Recette();
        $form = $this->createForm(RecetteType::class, $recette);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

            foreach ($recette->getEtape() as $etape) {

                $etape->setNumero($etape->getNumero());
                $etape->setDescription($etape->getDescription());
                $em->persist($etape);
            }



            $em->persist($recette);
            $em->flush();
            $this->addFlash('success', 'Recette ajouté avec succès');
            return $this->redirectToRoute('show_admin_recette');
        }

        return $this->render('backoffice/recette/add.html.twig', [
            'form' => $form->createView(),
        ]);
    }

    #[Route('/admin/recette/{id}', name: 'edit_admin_recette')]
    public function edit(Request $request,EntityManagerInterface $em,$id): Response
    {
        $recette = $em->getRepository(Recette::class)->find($id);

        $form = $this->createForm(RecetteType::class, $recette);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

            $em->persist($recette);
            $em->flush();
            $this->addFlash('success', 'Recette modifié avec succès');
            return $this->redirectToRoute('show_admin_recette');
        }

        return $this->render('backoffice/recette/edit.html.twig', [
            'form' => $form->createView(),
            'recette' => $recette,
        ]);


    }

    #[Route('/admin/recette/delete/{id}', name: 'delete_admin_recette')]
    public function delete(Request $request,EntityManagerInterface $em,$id): Response
    {

        $recette = $em->getRepository(Recette::class)->find($id);



        $em->remove($recette);
        $em->flush();

        $this->addFlash('success', 'Recette supprimé avec succès');

        return $this->redirectToRoute('show_admin_recette');


    }
}
