<?php


namespace App\Controller;


use App\Entity\Article;
use App\Entity\Categorie;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class DefaultController extends AbstractController
{

    /*
     * Page d'Accueil
     */
    public function index()
    {

        $repository = $this->getDoctrine()
            ->getRepository(Article::class);


            #Je récupère tous les articles de ma base
            $article = $repository->findAll();
            $spotlight = $repository->findBySpotlight();


        # Transmission à la vue pour affichage
        return $this->render("default/index.html.twig",[
            'articles' => $article,
            'spotlight'=> $spotlight
        ]);
    }


    public function contact()
    {
        return $this->render("default/contact.html.twig");
        #return new Response("<html><body><h1>Page de Contact</h1></body></html>");
    }



    /**
     * Page permettant d'afficher les articles d'une categorie
     * @Route("/categorie/{slug}",
     *     defaults={"slug"="Toutes les Catégories"},
     *     methods={"GET"},
     *     name="default_categorie")
     */
    public function categorie($slug)
    {

        /*
         * Récuperer la categorie correspondant au "SLUG" passer en paramètre de la route
         * -------------------------------------------------------------------------------------
         * On récupère le paramètre "slug" de la route (url) dans notre variable $slug
         */

        $categorie = $this->getDoctrine()
            ->getRepository(Categorie::class)
            ->findOneBy(['slug' => $slug]);


        /*
         * Grâce à la relation entre article et catégorie (OnetoMany), je suis en mesure de récupérer les articles d'une catégorie
         */
        $articles = $categorie->getArticles();


        /*
         * j'envoi à ma vue les données à a afficher
         */
        return $this->render("default/categorie.html.twig",[
            'articles' => $articles,
            'categorie' => $categorie
        ]);

    }

    /**
     * Page permettant d'afficher la route
     * @Route ("/{categorie}/{slug}_{id<\d+>}.html",
     * name="default_article")
     */
    public function article($id)
    {
        #exemple d'URL
        #/politique/macron-le-roi-des-c.._666.html

        /*
         * Récupération de l'article correspondant à l'ID en paramètre de notre route
         */

        $article =$this->getDoctrine()
            ->getRepository(Article::class)
            ->find($id);

        # on passe à la vue les données à afficher
        return $this->render("default/article.html.twig", [
            'article' => $article
        ]);

    }

    /**
     * Génération de la sideBar
     */

    public function sidebar()
    {

        $repository = $this->getDoctrine()
            ->getRepository(Article::class);

        # Récupération des 5 deniers articles
        $articles = $repository->findByLatest();

        # Récupératin des articles à la position spéciale
        $special = $repository->findBySpecial();

        #Trarnsmission des informations à la vue.
        return $this->render('components/_sidebar.html.twig',[
            'articles' => $articles,
            'special' => $special
        ]);

    }


}