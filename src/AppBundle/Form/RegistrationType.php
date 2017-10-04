<?php
// src/AppBundle/Form/RegistrationType.php

namespace AppBundle\Form;
use AppBundle\Entity\User;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;

class RegistrationType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
        ->add('nom')
        ->add('nourriture')
        ->add('famille')
        ->add('race')
        ;
    }

    public function getParent()
    {
        return 'FOS\UserBundle\Form\Type\RegistrationFormType';

        // Or for Symfony < 2.8
        // return 'fos_user_registration';
    }

    public function getBlockPrefix()
    {
        return 'app_user_registration';
    }

      
    public function setNom($nom)
    {
        $this->nom = $nom;

        return $this;
    }

    public function getNom()
    {
        return $this->getBlockPrefix();
    }
     public function setRace($race)
    {
        $this->race = $race;

        return $this;
    }

    public function getRace()
    {
        return $this->getBlockPrefix();
    }
       
    public function setNourriture($nourriture)
    {
        $this->nourriture = $nourriture;

        return $this;
    }

    public function getNourriture()
    {
        return $this->getBlockPrefix();
    }
     public function setFamille($famille)
    {
        $this->famille = $famille;

        return $this;
    }

    public function getFamille()
    {
        return $this->getBlockPrefix();
    }
       
}