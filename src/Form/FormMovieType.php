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
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Validator\Constraints\File;


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
            ->add('URL', FileType::class, [
                'label' => 'VIDEO',
                'mapped' => false,
                'required' => false,
                'constraints' => [
                    new File([
                        'maxSize' => '200M',
                        'mimeTypes' => [
                            'video/x-flv',
                            'video/mp4',
                        ],
                        'mimeTypesMessage' => 'Please upload a valid video',
                    ])
                ],
            ])
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
