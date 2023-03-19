<?php

namespace App\Controller\backoffice;

use App\Entity\Allergene;
use App\Form\AllergeneType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class AllergeneController extends AbstractController
{
    #[Route('/admin/allergene', name: 'show_admin_allergene')]
    public function show(EntityManagerInterface $em): Response
    {
        $allergenes = $em->getRepository(Allergene::class)->findAll();


        return $this->render('backoffice/allergene/show.html.twig', [
            'allergenes' => $allergenes,
        ]);
    }

    #[Route('/admin/allergene/add', name: 'add_admin_allergene')]
    public function add(Request $request,EntityManagerInterface $em): Response
    {
        $allergene = new Allergene();
        $form = $this->createForm(AllergeneType::class, $allergene);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em->persist($allergene);
            $em->flush();
            $this->addFlash('success', 'Allergène ajouté avec succès');
            return $this->redirectToRoute('show_admin_allergene');
        }

        return $this->render('backoffice/allergene/add.html.twig', [
            'form' => $form->createView(),
        ]);
    }

    #[Route('/admin/allergene/{id}', name: 'edit_admin_allergene')]
    public function edit(Request $request,EntityManagerInterface $em,$id): Response
    {
        $allergene = $em->getRepository(Allergene::class)->find($id);

        $form = $this->createForm(AllergeneType::class, $allergene);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

            $em->persist($allergene);
            $em->flush();
            $this->addFlash('success', 'Allergène modifié avec succès');
            return $this->redirectToRoute('show_admin_allergene');
        }

        return $this->render('backoffice/allergene/edit.html.twig', [
            'form' => $form->createView(),
            'allergene' => $allergene,
        ]);


    }

    #[Route('/admin/allergene/delete/{id}', name: 'delete_admin_allergene')]
    public function delete(Request $request,EntityManagerInterface $em,$id): Response
    {

            $allergene = $em->getRepository(Allergene::class)->find($id);



            $em->remove($allergene);
            $em->flush();

            $this->addFlash('success', 'Allergène supprimé avec succès');

        return $this->redirectToRoute('show_admin_allergene');


    }
}
