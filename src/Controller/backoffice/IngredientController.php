<?php

namespace App\Controller\backoffice;

use App\Entity\Ingredient;
use App\Form\IngredientType;
use App\Service\FileUploader;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\File\Exception\FileException;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\String\Slugger\SluggerInterface;

class IngredientController extends AbstractController
{
    #[Route('/admin/ingredient', name: 'show_admin_ingredient')]
    public function show(EntityManagerInterface $em): Response
    {
        $ingredients = $em->getRepository(Ingredient::class)->findAll();


        return $this->render('backoffice/ingredient/show.html.twig', [
            'ingredients' => $ingredients,
        ]);
    }

    #[Route('/admin/ingredient/add', name: 'add_admin_ingredient')]
    public function add(Request $request, EntityManagerInterface $em, SluggerInterface $slugger, FileUploader $fileUploader): Response
    {
        $ingredient = new Ingredient();
        $form = $this->createForm(IngredientType::class, $ingredient);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $brochureFile = $form->get('photo')->getData();


            if ($brochureFile) {
                $originalFilename = pathinfo($brochureFile->getClientOriginalName(), PATHINFO_FILENAME);
                // this is needed to safely include the file name as part of the URL
                $safeFilename = $slugger->slug($originalFilename);

                $brochureFileName = $fileUploader->upload($brochureFile);

                $ingredient->setPhoto($brochureFileName);
            }


            $em->persist($ingredient);
            $em->flush();
            $this->addFlash('success', 'Ingrédient ajouté avec succès');
            return $this->redirectToRoute('show_admin_ingredient');
        }

        return $this->render('backoffice/ingredient/add.html.twig', [
            'form' => $form->createView(),
        ]);
    }

    #[Route('/admin/ingredient/{id}', name: 'edit_admin_ingredient')]
    public function edit(Request $request, EntityManagerInterface $em, $id, SluggerInterface $slugger, FileUploader $fileUploader): Response
    {
        $ingredient = $em->getRepository(Ingredient::class)->find($id);

        $form = $this->createForm(IngredientType::class, $ingredient);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

            $brochureFile = $form->get('photo')->getData();


            if ($brochureFile) {
                $originalFilename = pathinfo($brochureFile->getClientOriginalName(), PATHINFO_FILENAME);
                // this is needed to safely include the file name as part of the URL
                $safeFilename = $slugger->slug($originalFilename);

                $brochureFileName = $fileUploader->upload($brochureFile);
                $ingredient->setPhoto($brochureFileName);


                $em->persist($ingredient);
                $em->flush();
                $this->addFlash('success', 'Ingrédient modifié avec succès');
                return $this->redirectToRoute('show_admin_ingredient');
            }
        }
        return $this->render('backoffice/ingredient/edit.html.twig', [
            'form' => $form->createView(),
            'ingredient' => $ingredient,
        ]);


    }

    #[Route('/admin/ingredient/delete/{id}', name: 'delete_admin_ingredient')]
    public function delete(Request $request, EntityManagerInterface $em, $id): Response
    {

        $ingredient = $em->getRepository(Ingredient::class)->find($id);


        $em->remove($ingredient);
        $em->flush();

        $this->addFlash('success', 'Allergène supprimé avec succès');

        return $this->redirectToRoute('show_admin_ingredient');


    }
}
