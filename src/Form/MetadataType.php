<?php

namespace App\Form;

use App\Entity\Metadata;
use App\Entity\Message;

use App\Entity\User;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class MetadataType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('readdate')
            ->add('message', EntityType::class, [
                'class' => Message::class,'choice_label' => 'content',

            ] )
            ->add('user', EntityType::class, [
                'class' => User::class,'choice_label' => 'email',

            ] )
           // ->add('message')
            //->add('user')
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Metadata::class,
        ]);
    }
}
