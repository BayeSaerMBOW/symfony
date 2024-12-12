<?php
namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class HomeController extends AbstractController
{
    #[Route('/', name: 'home')]
    public function index(): Response
    {
        $courses = [
            [
                'class' => 'Classe A, Classe B',
                'module' => 'Algèbre Linéaire',
                'hours' => 30,
                'semester' => 'Semester 1',
                'schedule' => '10:00:00',
                'quota' => '02:00:00',
                'status' => 'Terminé'
            ],
            [
                'class' => 'Classe A, Classe A, Classe B, Classe B',
                'module' => 'Programmation Avancée',
                'hours' => 45,
                'semester' => 'Semester 1',
                'schedule' => '10:00:00',
                'quota' => '02:00:00',
                'status' => 'En cours'
            ]
        ];

        return $this->render('home/index.html.twig', [
            'courses' => $courses
        ]);
    }
}