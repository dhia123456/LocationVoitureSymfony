<?php

namespace App\Form;

use App\Entity\Location;
use App\Entity\Voiture;
use App\Entity\Client;

use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Config\Security\ProviderConfig\EntityConfig;

class LocationType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('datedebut')
            ->add('datefin')
            ->add('client',EntityType::class,
            [
                "class"=>Client::class,
                "choice_label"=>function($client){
                 return $client->getNom().''.$client->getPrenom();}
                ,
                "expanded"=>false,
                "multiple"=>false
            ])
            ->add('voiture',EntityType::class,
            [
                "class"=>Voiture::class,
                "choice_label"=>"serie",
                "expanded"=>false,
                "multiple"=>false
            ])

        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Location::class,
        ]);
    }
}
