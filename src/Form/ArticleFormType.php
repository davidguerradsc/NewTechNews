<?php


namespace App\Form;


use App\Entity\Article;
use App\Entity\Categorie;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class ArticleFormType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            # Titre
            ->add('titre', TextType::class, [
                'required' => true,
                'label' => false,
                'attr' => [
                    'placeholder' => "titre de l'article"
                ]
            ])

            # Catégorie
            ->add('categorie', EntityType::class, [
                'class' => Categorie::class,
                'choice_label' => 'nom',
                'label' => false
            ])

            # Contenu
            ->add('contenu', TextareaType::class, [
                'required' => true,
                'label' => false
            ])

            # Image
            ->add('featuredImage', FileType::class, [
                'required' => false,
                'label' => false,
                'attr' => [
                    'class' => 'dropify'
                ]
            ])

            # Choix de spécial
            ->add('special', CheckboxType::class, [
                'required' => false,
                'attr' => [
                    'data-toggle' => 'toggle',
                    'data-on' => 'Oui',
                    'data-off' => 'Non'
                ]
            ])

            # Choix de spotlight
            ->add('spotlight', CheckboxType::class, [
                'required' => false,
                'attr' => [
                    'data-toggle' => 'toggle',
                    'data-on' => 'Oui',
                    'data-off' => 'Non'
                ]
            ])

            # Bouton submit
            ->add('submit', SubmitType::class, [
                'label' => 'Publier mon Article'
            ])
        ;

    }

    public function configureOptions(OptionsResolver $resolver)
    {
        /*
         * Ici mon formulaire ArticleFormType travaillera avec des instances de App/Entity/Article.
         */
        $resolver->setDefault('data_class',Article::class);
    }

    public function getBlockPrefix()
    {
        /*
         * Permet de préfixer les id et name des formulaires
         */
        return 'form';
    }
}