<?php
namespace App\Form;
use App\Entity\Voiture;
use Doctrine\DBAL\Types\Types;
use Symfony\Component\Form\AbstractType;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;

class VoitureType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
        ->add(child:'serie',type:TextType::class)
        ->add(child:'datemiseenmarche',type:DateType::class)
        ->add(child:'modele',type:TextType::class)
        ->add(child:'prix',type:TextType::class);
    }
    public function getName(){
        return "Voiture";
    }

}
