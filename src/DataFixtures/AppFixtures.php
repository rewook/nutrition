<?php

namespace App\DataFixtures;

use App\Entity\Allergene;
use App\Entity\Etape;
use App\Entity\Ingredient;
use App\Entity\IngredientRecette;
use App\Entity\Recette;
use App\Entity\Regime;
use App\Entity\User;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Faker\Factory;
use Faker\Generator;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

class AppFixtures extends Fixture
{
    /**
     * @var Generator
     */
    private $faker;
    private $passwordEncoder;

    public function __construct(UserPasswordEncoderInterface $passwordEncoder)
    {

        $this->passwordEncoder = $passwordEncoder;
    }

    public function load(ObjectManager $manager): void
    {
        $faker = Factory::create('fr_FR');
        $ingredients = ['carottes', 'miel', 'pommes', 'poires', 'bananes', 'pêches', 'abricots', 'fraises', 'framboises', 'mûres', 'cassis', 'raisins', 'pommes de terre', 'tomates', 'courgettes', 'aubergines', 'poivrons', 'oignons', 'ail', 'poireaux', 'choux', 'choux-fleurs', 'brocolis', 'asperges', 'haricots verts', 'navets', 'champignons', 'pâtes', 'riz', 'légumes', 'pommes de terre', 'tomates', 'courgettes', 'aubergines', 'poivrons', 'oignons', 'ail', 'poireaux', 'choux', 'choux-fleurs', 'brocolis', 'asperges', 'haricots verts', 'navets', 'champignons', 'pâtes', 'riz', 'légumes', 'pommes de terre', 'tomates', 'courgettes', 'aubergines', 'poivrons', 'oignons', 'ail', 'poireaux', 'choux', 'choux-fleurs', 'brocolis', 'asperges', 'haricots verts', 'navets', 'champignons', 'pâtes', 'riz', 'légumes', 'pommes de terre', 'tomates', 'courgettes', 'aubergines', 'poivrons', 'oignons', 'ail', 'poireaux', 'choux', 'choux-fleurs', 'brocolis', 'asperges', 'haricots verts', 'navets', 'champignons', 'pâtes', 'riz', 'légumes', 'pommes de terre', 'tomates', 'courgettes', 'aubergines', 'poivrons', 'oignons', 'ail', 'poireaux', 'choux', 'choux-fleurs', 'brocolis', 'asperges', 'haricots verts', 'navets', 'champignons', 'pâtes', 'riz', 'légumes', 'pommes de terre', 'tomates', 'courgettes', 'aubergines', 'poivrons', 'oignons', 'ail', 'poireaux', 'choux', 'choux-fleurs', 'brocolis', 'asperges', 'haricots verts', 'navets', 'champignons', 'pâtes', 'riz', 'légumes', 'pommes de terre', 'tomates', 'courgettes', 'aubergines', 'poivrons', 'oignons', 'ail', 'poireaux', 'choux', 'choux-fleurs', 'brocolis', 'asperges', 'haricots verts'];


        //creation allergenes
        $arrayAllergenes = ['noix', 'arachides', 'gluten', 'lactose', 'oeuf', 'lait', 'soja', 'poisson', 'fruits à coque', 'moutarde', 'graines de sésame', 'crustacés', 'animaux', 'mollusques', 'céleri', 'lupin', 'amande', 'noisette', 'noix de cajou', 'noix de macadamia', 'noix du Brésil', 'noix de pecan', 'noix de pistache', 'noix de pin', 'noix de cajou', 'noix de macadamia', 'noix du Brésil', 'noix de pecan', 'noix de pistache', 'noix de pin', 'noix de cajou', 'noix de macadamia', 'noix du Brésil', 'noix de pecan', 'noix de pistache', 'noix de pin', 'noix de cajou', 'noix de macadamia', 'noix du Brésil', 'noix de pecan', 'noix de pistache', 'noix de pin', 'noix de cajou', 'noix de macadamia', 'noix du Brésil', 'noix de pecan', 'noix de pistache', 'noix de pin', 'noix de cajou', 'noix de macadamia', 'noix du Brésil', 'noix de pecan', 'noix de pistache', 'noix de pin', 'noix de cajou', 'noix de macadamia', 'noix du Brésil', 'noix de pecan', 'noix de pistache', 'noix de pin', 'noix de cajou', 'noix de macadamia', 'noix du Brésil', 'noix de pecan', 'noix de pistache', 'noix de pin', 'noix de cajou', 'noix de macadamia', 'noix du Brésil', 'noix de pecan', 'noix de pistache', 'noix de pin', 'noix de cajou', 'noix de macadamia', 'noix du Brésil', 'noix de pecan', 'noix de pistache', 'noix de pin', 'noix de cajou', 'noix de macadamia', 'noix du Brésil', 'noix de pecan', 'noix de pistache', 'noix de pin', 'noix de cajou', 'noix de macadamia', 'noix du Brésil', 'noix de pecan'];
        for ($i = 1; $i <= 10; $i++) {
            $allergene = new Allergene();
            $allergene->setNom($faker->randomElement($arrayAllergenes));
            $manager->persist($allergene);
        }

        //creation regimes
        $arrayRegimes = ['végétarien', 'végétalien', 'sans gluten', 'sans lactose', 'sans oeuf'];
        for ($i = 0; $i <= 4; $i++) {
            $regime = new Regime();
            $regime->setNom($arrayRegimes[$i]);
            $regime->setDescription($faker->sentence(10));
            $manager->persist($regime);
        }

        //creation ingredients
        $selectedIngredient = [];
        $arrayIngredients = ['carottes', 'miel', 'pommes', 'poires', 'bananes', 'pêches', 'abricots', 'fraises', 'framboises', 'mûres', 'cassis', 'raisins', 'pommes de terre', 'tomates', 'courgettes', 'aubergines', 'poivrons', 'oignons', 'ail', 'poireaux', 'choux', 'choux-fleurs', 'brocolis', 'asperges', 'haricots verts', 'navets', 'champignons', 'pâtes', 'riz', 'légumes', 'pommes de terre', 'tomates', 'courgettes', 'aubergines', 'poivrons', 'oignons', 'ail', 'poireaux', 'choux', 'choux-fleurs', 'brocolis', 'asperges', 'haricots verts', 'navets', 'champignons', 'pâtes', 'riz', 'légumes', 'pommes de terre', 'tomates', 'courgettes', 'aubergines', 'poivrons', 'oignons', 'ail', 'poireaux', 'choux', 'choux-fleurs', 'brocolis', 'asperges', 'haricots verts', 'navets', 'champignons', 'pâtes', 'riz', 'légumes', 'pommes de terre', 'tomates', 'courgettes', 'aubergines', 'poivrons', 'oignons', 'ail', 'poireaux', 'choux', 'choux-fleurs', 'brocolis', 'asperges', 'haricots verts', 'navets', 'champignons', 'pâtes', 'riz', 'légumes', 'pommes de terre', 'tomates', 'courgettes', 'aubergines', 'poivrons', 'oignons', 'ail', 'poireaux', 'choux', 'choux-fleurs', 'brocolis', 'asperges', 'haricots verts', 'navets', 'champignons', 'pâtes', 'riz', 'légumes', 'pommes de terre', 'tomates', 'courgettes', 'aubergines', 'poivrons', 'oignons', 'ail', 'poireaux', 'choux', 'choux-fleurs', 'brocolis', 'asperges', 'haricots verts', 'navets', 'champignons', 'pâtes', 'riz', 'légumes', 'pommes de terre', 'tomates', 'courgettes', 'aubergines', 'poivrons', 'oignons', 'ail', 'poireaux', 'choux', 'choux-fleurs', 'brocolis', 'asperges', 'haricots verts'];
        for ($i = 1; $i <= 10; $i++) {
            $ingredient = new Ingredient();
            $ingredient->setNom($faker->randomElement($arrayIngredients));
            $selectedIngredient[] = $ingredient;
            $manager->persist($ingredient);
        }

        //creation recettes
        for ($r = 0; $r < 10; $r++) {
            $recette = new Recette();
            $recette->setTitre($faker->sentence(3));
            $recette->setDescription($faker->sentence(5));
            $recette->setTempsPrepa($faker->numberBetween(10, 60));
            $recette->setTempsCuisson($faker->numberBetween(10, 60));
            $recette->setTempsRepos($faker->numberBetween(0, 60));
            $recette->setPublic($faker->randomElement(['0', '1']));

            //ajout des étapes
            $nbetapes = random_int(1, 6);
            for ($e = 0; $e < $nbetapes; $e++) {
                $etape = new Etape();
                $etape->setNumero($e + 1);
                $etape->setDescription($faker->sentence(5));
                $recette->addEtape($etape);
                $manager->persist($etape);
            }
            //ajout des ingrédients
            $nbingredients = random_int(2, 6);
            for ($i = 0; $i < $nbingredients; $i++) {
                $recetteIngredient = new IngredientRecette();
                $recetteIngredient->setQuantite($faker->numberBetween(1, 10));
                $recetteIngredient->setUnite($faker->randomElement(['g', 'kg', 'ml', 'cl', 'l', 'pièce']));
                $recetteIngredient->setIngredient($faker->randomElement($selectedIngredient));
                $recetteIngredient->setRecette($recette);
                $manager->persist($recetteIngredient);
            }

            //ajout des régimes
            $nbregimes = random_int(0, 2);

            for ($i = 0; $i < $nbregimes; $i++) {


                $recette->addRegime($regime);


            }


            $manager->persist($recette);
        }


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

        // Creation patients
        for ($i = 1; $i <= 10; $i++) {
            $patient = new User();
            $patient->setEmail($faker->email);
            $patient->setRoles(['ROLE_USER']);
            $patient->setPassword($this->passwordEncoder->encodePassword(
                $patient,
                'Pa$$w0rd'
            ));
            $patient->setNom($faker->lastName);
            $patient->setPrenom($faker->firstName);
            $patient->setTelephone($faker->phoneNumber);

            $patient->setIsVerified(true);

            //ajout des allergies
            $nbAllergies = random_int(0, 2);
            for ($a = 0; $a < $nbAllergies; $a++) {
                $patient->addAllergene($allergene);
            }


            $manager->persist($patient);
        }

        $manager->flush();
    }
}
