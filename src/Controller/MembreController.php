<?php


namespace App\Controller;


use App\Entity\Membre;
use App\Form\ConnexionFormType;
use App\Form\MembreFormType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;
use Symfony\Component\Security\Http\Authentication\AuthenticationUtils;

class MembreController extends AbstractController
{
    /**
     * @Route("/inscription.html", name="membre_inscription")
     */

    public function inscription(Request $request,
                                UserPasswordEncoderInterface $encoder)
    {
        # Création d'un Membre
        $membre = new Membre();
        $membre->setRoles(['ROLE_MEMBRE']);

        # Création du formulaire "MembreFormType" + Vérification de la soumission du formulaire
        $form =$this->createForm(MembreFormType::class, $membre)
            ->handleRequest($request);

        if ( $form->isSubmitted() && $form->isValid() )
        {

            # Encodage du mot de passe avent l'envoi en BDD
            $membre->setPassword(
                $encoder->encodePassword($membre, $membre->getPassword())
            );

            # Sauvegarde du membre en BDD
            $em = $this->getDoctrine()->getManager();
            $em->persist($membre);
            $em->flush();

            # Notification everithing is good
            $this->addFlash('notice',
                'Bravo, Votre compte viens d\'être créé ! Vous pouvez vous connecter !');

            # Redirection
            return $this->redirectToRoute('membre_connexion');

        }

        return $this->render("inscription.html.twig",[
            'form' => $form->createView()
        ]);



        # Affichage du formulaire dans la vue
    }

    /**
     * @Route("/connexion.html", name="membre_connexion")
     */
    public function connexion(AuthenticationUtils $authenticationUtils)
    {
        # Récupération du formulaire de connexion
        $form =$this->createForm(ConnexionFormType::class, [
            'email' => $authenticationUtils->getLastUsername()
            ]);

        # Affichage du formulaire dans la vue
        return $this->render('membre/connexion.html.twig', [
            'form' => $form->createview(),
            'error'=> $authenticationUtils->getLastAuthenticationError()
        ]);


    }

    /**
     * @Route("/deconnexion.html", name="membre_deconnexion")
     */
    public function deconnexion(){

    }
}