<?php

namespace App\Controller\backoffice;

use App\Entity\Regime;
use App\Form\RegimeType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class RegimeController extends AbstractController
{
    #[Route('/admin/regime', name: 'show_admin_regime')]
    public function show(EntityManagerInterface $em): Response
    {
        $regimes = $em->getRepository(Regime::class)->findAll();


        return $this->render('backoffice/regime/show.html.twig', [
            'regimes' => $regimes,
        ]);
    }

    #[Route('/admin/regime/add', name: 'add_admin_regime')]
    public function add(Request $request, EntityManagerInterface $em): Response
    {
        $regime = new Regime();
        $form = $this->createForm(RegimeType::class, $regime);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em->persist($regime);
            $em->flush();
            $this->addFlash('success', 'Régime ajouté avec succès');
            return $this->redirectToRoute('show_admin_regime');
        }

        return $this->render('backoffice/regime/add.html.twig', [
            'form' => $form->createView(),
        ]);
    }

    #[Route('/admin/regime/{id}', name: 'edit_admin_regime')]
    public function edit(Request $request, EntityManagerInterface $em, $id): Response
    {
        $regime = $em->getRepository(Regime::class)->find($id);

        $form = $this->createForm(RegimeType::class, $regime);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

            $em->persist($regime);
            $em->flush();
            $this->addFlash('success', 'Régime modifié avec succès');
            return $this->redirectToRoute('show_admin_regime');
        }

        return $this->render('backoffice/regime/edit.html.twig', [
            'form' => $form->createView(),
            'regime' => $regime,
        ]);


    }

    #[Route('/admin/regime/delete/{id}', name: 'delete_admin_regime')]
    public function delete(Request $request, EntityManagerInterface $em, $id): Response
    {

        $regime = $em->getRepository(Regime::class)->find($id);


        $em->remove($regime);
        $em->flush();

        $this->addFlash('success', 'Régime supprimé avec succès');

        return $this->redirectToRoute('show_admin_regime');


    }
}
