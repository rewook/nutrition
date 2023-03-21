<?php

namespace App\Controller\backoffice;

use App\Entity\IngredientRecette;
use App\Entity\Recette;
use App\Form\IngredientRecetteType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class IngredientRecetteController extends AbstractController
{
    #[Route('/ingredient/recette/{id}', name: 'app_ingredient_recette')]
    public function index($id, Request $request, EntityManagerInterface $em): Response
    {
        $recette = $this->getDoctrine()->getRepository(Recette::class)->find($id);

        $listeingredients = $this->getDoctrine()->getRepository(IngredientRecette::class)->findBy(['recette' => $recette]);


        $ingredientRecette = new IngredientRecette();


        $form = $this->createForm(IngredientRecetteType::class, $ingredientRecette);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $data = $form->getData();
            $ingredientRecette->setRecette($recette);
            //$ingredientRecette->setIngredient($recette);

            $em->persist($ingredientRecette);
            $em->flush();
            $this->addFlash('success', 'L\'ingrédient a bien été ajouté');

            return $this->redirectToRoute('app_ingredient_recette', ['id' => $id]);
        }

        return $this->render('backoffice/ingredient_recette/index.html.twig', [
            'form' => $form->createView(),
            'listeingredients' => $listeingredients,
            'recette' => $id,
        ]);
    }
}
