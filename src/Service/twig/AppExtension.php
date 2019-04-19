<?php


namespace App\Service\twig;


use Twig\Extension\AbstractExtension;
use Twig\TwigFilter;

class AppExtension extends AbstractExtension
{

    # Création d'un filtre
    public function getFilters()
    {
        return [
            # Création d'un filtre pour reduire le texte à 150 caractères
            new TwigFilter('summarize', function ( $contenu ){

                # Suppression des balises HTML
                $string = strip_tags($contenu);

                # Si mon $string est supérieur à 150, je continue
                if (strlen($string) > 150) {
                    # Je coupe ma chaine à 150
                    $stringCut = substr($string, 0, 150);
                    # Je m'assure de ne pas couper un mot.
                    #En recherchant la position du dernier espace.
                    $string = substr($stringCut, 0, strrpos($stringCut, ' '));
                }
                return $string . '...';
            }, array( 'is_safe' => array( 'html' )))
        ];
    }

}