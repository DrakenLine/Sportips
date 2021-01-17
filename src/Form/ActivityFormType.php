<?php

namespace App\Form;

use App\Entity\Activity;
use App\Entity\TypeOfActivity;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class ActivityFormType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('name', TextType::class, [
                'label' => 'nom'
            ])
            ->add('didAt', DateType::class, [
                'label' => 'Date'
            ])
            ->add('km')
            ->add('duration')
            ->add('elevation')
            ->add('type', EntityType::class, [
                'class'=>TypeOfActivity::class,
                'choice_label' => 'name' //liste déroulante
            ])
            ->add('submit', SubmitType::class, [
                'label'=>'Ajouter une activité'
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Activity::class,
        ]);
    }
}
