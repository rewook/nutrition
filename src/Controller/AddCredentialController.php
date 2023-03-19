<?php

namespace App\Controller;

use App\Entity\User;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;



class AddCredentialController extends AbstractController
{
    #[Route('/add/credential/docteur', name: 'app_add_credential_docteur')]
    public function index(UserPasswordEncoderInterface $passwordEncoder,EntityManagerInterface $manager): Response
    {

        // Création du compte médecin
        $doctor = new User();
        $doctor->setEmail('sandrine@coupart.fr');
        $doctor->setRoles(['ROLE_ADMIN']);
        $doctor->setNom('Coupart');
        $doctor->setPrenom('Sandrine');
        $doctor->setTelephone('0606060606');
        $doctor->setIsVerified(true);
        $doctor->setPassword($this->passwordEncoder->encodePassword(
            $doctor,
            'Pa$$w0rd'
        ));
        $manager->persist($doctor);
        $manager->flush();

        $this->addFlash('success', 'Le compte a bien été créé');

        return $this->render('add_credential/index.html.twig');
    }


    #[Route('/add/credential/patient', name: 'app_add_credential_docteur')]
    public function patient(UserPasswordEncoderInterface $passwordEncoder,EntityManagerInterface $manager): Response
    {

        $patient = new User();
        $patient->setEmail('patient@coupart.fr');
        $patient->setRoles(['ROLE_USER']);
        $patient->setPassword($this->passwordEncoder->encodePassword(
            $patient,
            'Pa$$w0rd'
        ));
        $patient->setNom('DOE');
        $patient->setPrenom('John');
        $patient->setTelephone('06 05 04 03 02');

        $patient->setIsVerified(true);


        $manager->persist($patient);
        $manager->flush();

        $this->addFlash('success', 'Le compte a bien été créé');

        return $this->render('add_credential/index.html.twig');
    }
}
