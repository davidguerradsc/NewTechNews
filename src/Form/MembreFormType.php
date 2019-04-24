<?php


namespace App\Form;


use App\Entity\Membre;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class MembreFormType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            # Prenom
            ->add('prenom', TextType::class,[
                'required' => true,
                'label' => false,
                'attr' => [
                    'placeholder' => "Entrez votre prénom"
                ]
            ])

            # Nom
            ->add('nom', TextType::class,[
                'required' => true,
                'label' => false,
                'attr' => [
                'placeholder' => "Entrez votre nom"
                ]
            ])

            # Email
            ->add('email', EmailType::class,[
                'required' => true,
                'label' => false,
                'attr' => [
                    'placeholder' => "Entrez votre Email"
                ]
            ])

            # Password
            ->add('password', PasswordType::class,[
                'required' => true,
                'label' => false,
                'attr' => [
                    'placeholder' => "Entrez votre mot de passe"
                ]
            ])

            # Button Submit
            ->add('submit', SubmitType::class,[
                'label' => 'Enregistrer'
            ])
        ;
    }

    # securite pour etre sur que seul une instance membre est passé
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefault('data_class', Membre::class);
    }



}