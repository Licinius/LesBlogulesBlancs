<?php
/**
 * Created by PhpStorm.
 * User: fdellomo
 * Date: 20/12/18
 * Time: 17:23
 */
namespace AppBundle\Form;


use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;

use Symfony\Component\Form\Extension\Core\Type\TextareaType;

class ArticleType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('Title')
            ->add('Description',TextareaType::class)
            ->add('Sauvegarder', SubmitType::class)
        ;
    }
}