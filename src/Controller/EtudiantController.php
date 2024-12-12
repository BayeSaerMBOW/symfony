<?php
// src/Controller/EtudiantController.php

namespace App\Controller;

use App\Entity\Etudiant;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class EtudiantController extends AbstractController
{
    #[Route('/etudiant/create', name: 'etudiant_create', methods: ['POST'])]
    public function create(Request $request, EntityManagerInterface $entityManager): Response
    {
        // Récupérer les données du formulaire
        $matricule = $request->get('matricule');
        $nomComplet = $request->get('nomComplet');
        $adress = $request->get('adress');
        $login = $request->get('login');
        $password = $request->get('password');

        // Créer un nouvel étudiant
        $etudiant = new Etudiant();
        $etudiant->setMatricule($matricule);
        $etudiant->setNomComplet($nomComplet);
        $etudiant->setAdress($adress);
        $etudiant->setLogin($login);
        $etudiant->setPassword($password);

        // Persister et flusher l'étudiant
        $entityManager->persist($etudiant);
        $entityManager->flush();

        return new Response('Étudiant créé avec succès');
    }

    #[Route('/etudiant/form', name: 'etudiant_form')]
    public function form(): Response
    {
        return $this->render('etudiant/index.html.twig');
    }
}
