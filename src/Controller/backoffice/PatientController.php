<?php

namespace App\Controller\backoffice;

use App\Entity\User;
use App\Form\PatientType;
use App\Repository\UserRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;
use Symfony\Component\Routing\Annotation\Route;

class PatientController extends AbstractController
{
    #[Route('/admin/patient', name: 'show_admin_patient')]
    public function show(EntityManagerInterface $em,UserRepository $userRepository): Response
    {
        //récupération des patients
        $patients =  $userRepository->findAllUser('["ROLE_USER"]');



        return $this->render('backoffice/patient/show.html.twig', [
            'patients' => $patients,
        ]);
    }

    #[Route('/admin/patient/add', name: 'add_admin_patient')]
    public function add(Request $request,EntityManagerInterface $em,UserPasswordHasherInterface $userPasswordHasher): Response
    {
        $patient = new User();

        $form = $this->createForm(PatientType::class, $patient);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $data = $form->getData();
            $patient->setRoles(['ROLE_USER']);
            $patient->setIsVerified(false);
            // Enregistrement du nom en majuscule
            $nom = $data->getNom();
            $nom = strtoupper($nom);
            $patient->setNom($nom);

            // Enregistrement du prénom en majuscule pour la première lettre
            $prenom = $data->getPrenom();
            $prenom = ucfirst($prenom);
            $patient->setPrenom($prenom);

            // encode the plain password
            $plainPassword="2rdR17$100";
            $patient->setPassword(
                $userPasswordHasher->hashPassword(
                    $patient,
                    $plainPassword
                )
            );

            $em->persist($patient);
            $em->flush();
            $this->addFlash('success', 'Patient ajouté avec succès');
            return $this->redirectToRoute('show_admin_patient');
        }



        return $this->render('backoffice/patient/add.html.twig', [
            'form' => $form->createView(),
        ]);
    }

    #[Route('/admin/patient/{id}', name: 'edit_admin_patient')]
    public function edit(Request $request,EntityManagerInterface $em,$id): Response
    {
        $patient = $em->getRepository(User::class)->find($id);

        $form = $this->createForm(PatientType::class, $patient);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

            $em->persist($patient);
            $em->flush();
            $this->addFlash('success', 'Régime modifié avec succès');
            return $this->redirectToRoute('show_admin_patient');
        }

        return $this->render('backoffice/patient/edit.html.twig', [
            'form' => $form->createView(),
            'patient' => $patient,
        ]);


    }

    #[Route('/admin/patient/delete/{id}', name: 'delete_admin_patient')]
    public function delete(Request $request,EntityManagerInterface $em,$id): Response
    {

        $patient = $em->getRepository(User::class)->find($id);



        $em->remove($patient);
        $em->flush();

        $this->addFlash('success', 'Régime supprimé avec succès');

        return $this->redirectToRoute('show_admin_patient');


    }
}
