<?php

namespace App\Form;

use App\Entity\Categoria;
use App\Entity\Filme;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use App\Controller\VideoPageController;

class FormMovieType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        
        $comedia = new Categoria();
        $comedia->setNome("Comedy");
        
        $acao = new Categoria();
        $acao->setNome("Action");
        $builder
            ->add('produtora', TextType::class)
            ->add('titulo', TextType::class)
            // ->add('pessoasFilmeFavorito')
            //->add('uploadUtilizador')
            ->add('categoria', ChoiceType::class, [
                'choices' => [
                    'Comedy' => $comedia,
                    'Action' => $acao
                ]
            ])
            ->add('descricao', TextType::class)
            ->add('upload', SubmitType::class)
            
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Filme::class,
        ]);
    }
}
