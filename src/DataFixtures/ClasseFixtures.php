<?php
namespace App\DataFixtures;

use App\Entity\Classe;
use App\Entity\Niveau;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class ClasseFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        // Créer des niveaux
        $niveaux = ["Niveau 1", "Niveau 2", "Niveau 3"];
        foreach ($niveaux as $key => $nomNiveau) {
            $niveau = new Niveau();
            $niveau->setNom($nomNiveau);
            $manager->persist($niveau);
            
            // Ajouter une référence
            $this->addReference('niveau_'.$key, $niveau);
        }

        // Créer des classes
        $classes = ["L1", "L2", "L3"];
        foreach ($classes as $key => $nomClasse) {
            $classe = new Classe();
            $classe->setNom($nomClasse);
            
            // Récupérer une référence de niveau
          
            $classe->setNiveau($niveau);
            
            $manager->persist($classe);
        }

        $manager->flush();
    }
}