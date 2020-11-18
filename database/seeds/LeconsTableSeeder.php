<?php

use App\Models\Lecon;
use Illuminate\Database\Seeder;

class LeconsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Lecon::create([
            'id' => '1',
            'matiere_id' => '4',
            'user_id' => '1',
            'name' => 'images/cours/1FjO392hVtZvjzs4dsnXr0DysPLhwzpiPuNslw5b.jpeg',
            'titre' => 'Cours d\'anglais débutant : faire des phrases simples en anglais',
            'description' => 'Avec des cours pour tous niveaux, simples et sympathiques.',
        ]);

        Lecon::create([
            'id' => '2',
            'matiere_id' => '3',
            'user_id' => '2',
            'name' => 'images/cours/qcBFhdvIZqOXRUNvdEnGLk9oQKQdfKn5z2FdKw3V.png',
            'titre' => 'Langage PHP: Qu\'est ce que c\'est',
            'description' => 'Avoir une identification et une définition du langage PHP.',
        ]);

        Lecon::create([
            'id' => '3',
            'matiere_id' => '3',
            'user_id' => '3',
            'name' => 'images/cours/tKXuJmkjMfeSgViT0QdbsXnnUkk6Z3a6dg83SqQm.jpeg',
            'titre' => 'Initation à la programmation web #1',
            'description' => 'Qu\'est ce qu\'il faut retenir ? - HTML : Le HTML est un langage de balises qui permet de mettre en forme du contenu ... L\'acronyme signifie HyperText Markup Language, ce qui signifie en français "Language de Balises HyperText"',
        ]);

        Lecon::create([
            'id' => '4',
            'matiere_id' => '3',
            'user_id' => '4',
            'name' => 'images/cours/GrAIDCLxysJDXCqcTP3IYS03fqLnGVqwPLJSOv4D.png',
            'titre' => 'Découverte du framework Laravel',
            'description' => 'Dans ce tutoriel nous voyions ce qu\'est un framework et comment l\'utiliser.',
        ]);

        Lecon::create([
            'id' => '5',
            'matiere_id' => '1',
            'user_id' => '1',
            'name' => 'images/cours/dOFzf8Wggvps5F0oQVzqg8I56ZBHUVzZRBzgNksp.jpeg',
            'titre' => 'Rédiger une synthèse',
            'description' => 'Un tour d\'horizon de la méthodologie de la synthèse pour l\'épreuve de culture générale de BTS',
        ]);

        Lecon::create([
            'id' => '6',
            'matiere_id' => '1',
            'user_id' => '2',
            'name' => 'images/cours/4iSdn5WvPhDPfF8UnhyrLEtK3pOsLNz9Yji1ctfn.jpeg',
            'titre' => 'L\'art de la guerre - explication et analysé',
            'description' => 'L\'Art de la Guerre est un ouvrage du général chinois Sun Tzu compilant un ensemble de stratégies militaires visant à assurer la victoire.',
        ]);

        Lecon::create([
            'id' => '7',
            'matiere_id' => '1',
            'user_id' => '3',
            'name' => 'images/cours/vdVmUlSYEASphLNoqW7Gi8BhsT93XevRw3mzcNyF.jpeg',
            'titre' => 'CGE : A toute vitesse !',
            'description' => 'Le 1er thème de Culture Générale et expression  du BTS 2021 est :  A toute vitesse !',
        ]);

        Lecon::create([
            'id' => '8',
            'matiere_id' => '2',
            'user_id' => '4',
            'name' => 'images/cours/usIA5q12a7FoRClMs3bqPbSPA31UyzrO2F7FeM5S.png',
            'titre' => 'Algèbre de Boole - Première Informatique',
            'description' => 'Découvrons l\'algèbre booléenne dans cette vidéo : c\'est simple et rapide à comprendre !',
        ]);

        Lecon::create([
            'id' => '9',
            'matiere_id' => '2',
            'user_id' => '1',
            'name' => 'images/cours/gZGLBfQh9oNmtLZeUDB9JQAewPcWgru7bGyUmrxK.png',
            'titre' => 'Introduction et apprentissage des graphes',
            'description' => '- Qu\'est-ce qu\'un sommet ? - Qu\'est-ce qu\'une arête ? - Que signifie l\'ordre d\'un graphe ? - Que signifie le degré d\'un sommet ? - Qu\'est-ce qu\'un graphe complet ? - Quelle est la définition de deux sommets adjacents ?',
        ]);

        Lecon::create([
            'id' => '10',
            'matiere_id' => '2',
            'user_id' => '2',
            'name' => 'images/cours/StFxMdk81ypUpfs1zBp27BWLtZPAtryYd7pjkJPo.jpeg',
            'titre' => 'Algorithme : les variables - Tous niveaux - Maths',
            'description' => 'De la Seconde à la Terminale, comprendre le principe des algorithmes avec les variables.',
        ]);

        Lecon::create([
            'id' => '11',
            'matiere_id' => '3',
            'user_id' => '1',
            'name' => 'images/cours/0c1JKWNeDppZoBF6BOs9NWTdt9xU54AnZNAt9K6K.png',
            'titre' => 'Découvre d\'une infrastructure réseaux',
            'description' => 'Comment fonctionne une armoire réseau, ce qu\'est un serveur, et plein d\'autre bonne choses.',
        ]);


        Lecon::create([
            'id' => '12',
            'matiere_id' => '3',
            'user_id' => '3',
            'name' => 'images/cours/SR4eKlrLdbtCTR6u0k0rgzsaPNWDT7TjihmVgFrL.jpeg',
            'titre' => 'Linux : Qu\'est ce que c\'est ?',
            'description' => 'C\'est quoi Linux? A quoi ça sert? devrais je l\'utiliser? la réponse dans ce cours de présentation rapide du système d\'exploitation !',
        ]);

        Lecon::create([
            'id' => '13',
            'matiere_id' => '1',
            'user_id' => '4',
            'name' => 'images/cours/ipWUgOwAsjqGlitLl00kXT9hppBw7OA9yvoLqD4w.jpeg',
            'titre' => 'Méthodologie pour réussir une synthèse',
            'description' => 'Dans ce cours nous voyions toute la méthodologie de l\'épreuve de Culture Générale !',
        ]);

        Lecon::create([
            'id' => '14',
            'matiere_id' => '2',
            'user_id' => '4',
            'name' => 'images/cours/pL2Rh9R9T4xiUeZqMgtpkgsDLKmznqOVBGWmGyKv.png',
            'titre' => 'Les intervalles - Revision',
            'description' => 'Revoir tout le cours sur les intervalles. L’objet de cette séquence est de se rappeler et de comprendre les éléments les plus importants du chapitre.',
        ]);

        Lecon::create([
            'id' => '15',
            'matiere_id' => '2',
            'user_id' => '5',
            'name' => 'images/cours/31CEcuRTqEeZSZG1kn5oNWbgO8X3iopZo0NLGYOA.jpeg',
            'titre' => 'Apprendre à lire sur le cercle trigonométrique',
            'description' => 'L\'objectif est simple, apprendre à lire sur le cercle trigonométrique et à déterminer le cosinus et le sinus d\'un angle.',
        ]);

        Lecon::create([
            'id' => '16',
            'matiere_id' => '5',
            'user_id' => '5',
            'name' => 'images/cours/BqxuEKyBpjl8I7XI0CS6Fqt9vuGIDzHAS79MMZYC.png',
            'titre' => 'Les prix et la monnaie dans les échanges',
            'description' => 'Connaître le fonctionnement de notre système d\'échange monétaire et les différents types de façon de "payer" une transaction.',
        ]);

        Lecon::create([
            'id' => '17',
            'matiere_id' => '1',
            'user_id' => '5',
            'name' => 'images/cours/cFYhZpBbhyetOBAXGpPWGOC60ueBSCd2nwW5V6dp.jpeg',
            'titre' => 'La méthodologie de l\'écriture personnelle',
            'description' => 'Comment la réussir et comment la conclure ?',
        ]);

        Lecon::create([
            'id' => '18',
            'matiere_id' => '3',
            'user_id' => '4',
            'name' => 'images/cours/Xg1SdPk97VVRa65Yj6H4QjydaVF7RGPFOK8UQrxk.png',
            'titre' => 'Node JS : Qu\'est ce que NodeJS ?',
            'description' => 'NodeJS est une plateforme construite sur le moteur JavaScript.',
        ]);

        Lecon::create([
            'id' => '19',
            'matiere_id' => '2',
            'user_id' => '6',
            'name' => 'images/cours/immPdOxPGvUA7C3z8xMLWjkzIg3IpQklS8SJpoOX.png',
            'titre' => 'L\'algebre de Boole',
            'description' => 'Dans ce cours, nous decouvrons : • L\'algèbre Booléenne • Les tables ET, OU et NON • Comment écrire la table d\'une expression booléenne',
        ]);

        Lecon::create([
            'id' => '20',
            'matiere_id' => '6',
            'user_id' => '6',
            'name' => 'images/cours/fWuj1G8tGct3FRVrPQQiVc2Cg8JgFBAIoFOLxMy5.jpeg',
            'titre' => 'Le fonctionnement de la justice française',
            'description' => 'Une juridiction, un appel, un pourvoi en cassation, un conseil de prud’hommes... Dans ce cours nous mettons à plat l’organisation de la justice française.',
        ]);

        Lecon::create([
            'id' => '21',
            'matiere_id' => '4',
            'user_id' => '7',
            'name' => 'images/cours/2HX3o4NMvAy87xIqeTOslJUNe9KPLlJTo2vLDtQ5.jpeg',
            'titre' => 'Oral d\'anglais : décrire un document efficacement',
            'description' => 'Dans ce cours, on se prépare à l\'oral d\'anglais. On apprend à faire une bonne introduction pour l\'oral d\'anglais.',
        ]);

        Lecon::create([
            'id' => '22',
            'matiere_id' => '5',
            'user_id' => '7',
            'name' => 'images/cours/76AfRyRlFv5ysiohb8e1Jc8ZRTH0EpVsTlVoMb1M.jpeg',
            'titre' => 'Le fonctionnement du marché',
            'description' => 'Qu\'est-ce qu\'un marché ? Qu\'est-ce qu\'un lieu d\'échange ? Comment sont-il encadrée ?',
        ]);

        Lecon::create([
            'id' => '23',
            'matiere_id' => '1',
            'user_id' => '6',
            'name' => 'images/cours/7yAs7AiDbZ2Xmmrgk2cwYjZQwoQDjQ6XJQSoQm3q.jpeg',
            'titre' => 'Le vocabulaire pour structurer un exposé en français',
            'description' => 'Comment présenter l\'epreuve d\'expression orale.',
        ]);

        Lecon::create([
            'id' => '24',
            'matiere_id' => '3',
            'user_id' => '1',
            'name' => 'images/cours/L8v3yJZdWpz8h2TmTHhZk7cpiTcOX03AvfelfAMj.jpeg',
            'titre' => 'Bases de jQuery | Qu\'est ce que jQuery et comment l\'utiliser',
            'description' => 'jQuery est une bibliothèque JavaScript libre et multiplateforme créée pour faciliter l\'écriture de scripts côté client dans le code HTML des pages web.',
        ]);

        Lecon::create([
            'id' => '25',
            'matiere_id' => '2',
            'user_id' => '1',
            'name' => 'images/cours/d4rGxdXxqNXzG2GTTBAGtakbJe88cOuyTQuY8dtT.png',
            'titre' => 'Matrice : introduction - définition',
            'description' => 'Objectifs: - Savoir ce que c\'est qu\'une matrice - se repérer dans une matrice coefficient ligne colonne',
        ]);

        Lecon::create([
            'id' => '26',
            'matiere_id' => '6',
            'user_id' => '2',
            'name' => 'images/cours/A6wjds8WjW9QsxCNQamfH4TT5vR5INfzEsTRCMIl.jpeg',
            'titre' => 'La protection juridique : ça sert à quoi?',
            'description' => 'La "protection juridique" vous permet d\'être représenté et défendu par votre assurance dans une procédure de justice.',
        ]);

        Lecon::create([
            'id' => '27',
            'matiere_id' => '4',
            'user_id' => '3',
            'name' => 'images/cours/KCubUh85NL7QVcp7yImCYSIHHsSq4SbLdkKvtWad.jpeg',
            'titre' => 'Comment décrire une image en anglais',
            'description' => 'Revoir les méthodes pour décrire une illustration.',
        ]);

        Lecon::create([
            'id' => '28',
            'matiere_id' => '3',
            'user_id' => '1',
            'name' => 'images/cours/knDDX395JuB0obF7gPcHpbPoBDm8P0RaciHEPrrx.png',
            'titre' => 'Créer et déployer une application Symfony 5',
            'description' => 'Déployer une application Symfony 5 avec Heroku. Créer une application avec Symfony 5.',
        ]);

        Lecon::create([
            'id' => '29',
            'matiere_id' => '3',
            'user_id' => '4',
            'name' => 'images/cours/YaQccq4bz8BayYcGhruT6BuBr4E5WkYNG9eirJpL.jpeg',
            'titre' => 'Apprendre et comprendre Bootstrap rapidement',
            'description' => 'Dans ce cours, qui est une suite logique à l\'apprentissage sur le HTML et CSS, nous abordons Bootstrap, le framework css développé par Twitter et qui permet de réaliser des sites responsives de manière simple et pratique.',
        ]);

        Lecon::create([
            'id' => '30',
            'matiere_id' => '3',
            'user_id' => '3',
            'name' => 'images/cours/7cIYiEZGlSVU4KAxy460fRico19uEj4vK87aQzgd.jpeg',
            'titre' => 'Apprendre le JavaScript : Chapitre 1, Introduction',
            'description' => 'Ce cours pour apprendre les bases du languages : les variables, les fonctions, les conditions...',
        ]);
    }
}
