<?php


namespace App\Controller;


use App\Entity\Article;
use App\Entity\Categorie;
use App\Entity\Membre;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ArticleController extends AbstractController
{
    /**
     *  Démonstration de l'ajout d'un Article avec Doctrine
     * @Route("/demo/article", name="article_demo")
     */

    public function demo()
    {
        #Céation d'une catégorie
        $categorie = new Categorie();
        $categorie->setNom("Politique");
        $categorie->setSlug("politique");

        #Création d'un auteur
        $membre = new Membre();
        $membre->setPrenom("David");
        $membre->setNom("Guerra");
        $membre->setEmail("david@gmail.com");
        $membre->setPassword("david");
        $membre->setRoles(['ROLE_AUTEUR']);
        $membre->setDateInscription(new \DateTime());

        #Création d'un article
        $article = new Article();
        $article->setTitre("Grand débat : Macron cherche le bon tempo pour faire ses annonces");
        $article->setSlug("grand-debat-macron-cherche-le-bon-tempo-pour-faire-ses-annonces")
                ->setContenu("
                                <p>Même si les mesures qu’il devait annoncer lundi soir ont largement fuité dans la presse, le chef de l’Etat va décaler de plusieurs jours l’intervention dans laquelle il justifiera ses choix.
                                Pour l’effet de surprise… On repassera. L’incendie de Notre Dame a contraint Emmanuel Macron a reporté sine die son allocution solennelle programmée lundi soir. Annulée, aussi, la conférence de ce mercredi. Le président l’a lui-même affirmé mardi soir, le moment de « la politique et ses tumultes » n’est « pas encore venu ».
                                Problème, l’ensemble des annonces étaient déjà enregistrées. Et n’ont pas tardé à fuiter, au grand dam de l’Elysée. « Cette allocution n’a pas eu lieu. Cela n’a pas été diffusé. Cet enregistrement, il n’existe pas, il n’existera pas. Cela n’a aucune valeur. On ne va pas prendre la même bande. Le contexte est totalement différent », s’étranglent les conseillers du président.
                                Comme nous l’écrivions dès mardi, outre une batterie de mesures économiques et fiscales, Emmanuel Macron entend également jouer sur les symboles. Notamment en supprimant l’ENA, dont il est lui-même issu. « J’attends une manifestation de protestation des inspecteurs des finances », s’esclaffe par avance un membre du gouvernement.
                                Mais ce n’est pas tout, d’autres grandes écoles de l’administration sont sur la sellette. « L’Ecole nationale de la Magistrature (ENM), notamment », confie le même, estimant que cette mesure est « une façon de changer le mode de fonctionnement de la technostructure ». Pas de disparition pure et simple, toutefois, mais le remplacement de cette emblématique école par une autre formation est envisagé…
                                « Faire dans le symbole »
                                Charge par ailleurs aux présidents des deux Chambres, Gérard Larcher et Richard Ferrand, de proposer un nouveau taux pour la mise en place de la proportionnelle. Une mesure devrait, en outre, concerner le vote blanc. Quant au Conseil économique, social et environnemental, s’il ne devrait pas être supprimé, il pourrait être adossé à une assemblée citoyenne.
                                Signe qu’il veut marquer « un changement de méthode », confie un ministre, Macron souhaite « réhabiliter les partenaires sociaux » en leur demandant de formuler des propositions sur des sujets précis, comme la transition écologique. « Le président n’a pas une grosse envie de lâcher de l’argent, mais de faire dans le symbole, oui », devine un pilier de l’exécutif.
                                Les mesures déjà dans la nature, ne reste plus qu’à surprendre par la forme. Alors à l’Elysée, on cogite. « La question désormais, c’est de changer de format. Mais ce n’est pas simple : on risque vite de basculer dans le gadget », s’alarme déjà un ministre. Quant au calendrier, il n’est toujours pas arrêté. Mardi matin, lors du petit-déjeuner organisé comme chaque semaine par Edouard Philippe à Matignon, les cadres de la majorité ont unanimement plaidé pour un report de plusieurs jours.
                                « Ce serait cosmique de le faire cette semaine »
                                « Entre le vendredi Saint et le week-end de Pâques, il n’y aura rien cette semaine, prédit un ministre. Il faut que cela se passe entre le lundi de Pâques et le 1er mai, parce qu’après ce sera la campagne des européennes. » L’un de ses collègues pousse dans le même sens : « Ce serait cosmique de le faire cette semaine. Toutes les conversations vont tourner autour de Notre-Dame. Personne ne s’intéressera à la désindexation des retraites ! » Macron promet de revenir devant les Français « dans les jours prochains ». Sans en dire plus.
                                Faut-il, pour autant, s’attendre à une modification des arbitrages ? « Une ou deux semaines de décalage, cela peut conduire à faire bouger les choses », observe un ministre. Un autre n’en démord pas : « Les mesures sont les mesures. On ne va pas les bouger ! » Malgré le refrain du tournant, martelé depuis des jours, le même assure que la ligne politique, non plus, ne bougera pas tant que cela. « Ceux qui pensent que Macron va se déjuger ou se dédire se trompent lourdement. Tous ceux qui se sont déjugés par le passé se sont plantés. »</p>")
                ->setFeaturedImage("e_macron.jpg")
                ->setSpotlight(1)
                ->setSpecial(0)
                ->setMembre($membre)
                ->setCategorie($categorie)
                ->setDateCretion(new \DateTime())
            ;

        /*
         *
         * Récupération du Manager de Doctrine
         * -----------------------------------------
         * Le EntityManager est une classe qui sait comment persister (enregistrer) d'autres classes (Effectuer des opérations CRUD sur nos entités).
         *
         */

        $em = $this->getDoctrine()->getManager(); // Permet de recup le entityManager de Doctrine
        $em->persist($categorie); // J'enregistre dans ma base la categorie
        $em->persist($membre); // Le Membre
        $em->persist($article); // Et l'article

        $em->flush(); // J'execute le tout

        # Retourner une réponse à la vue
        return new Response('Nouvel Article ajouté avec ID : '
            . $article->getId()
            . 'et la nouvelle categorie '
            . $categorie->getNom()
            . 'de Auteur : '
            . $membre->getPrenom()
        );


    }


}