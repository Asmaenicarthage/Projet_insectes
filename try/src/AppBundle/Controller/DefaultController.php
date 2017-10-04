<?php

namespace AppBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

class DefaultController extends Controller
{
 /**
     * @Route("/" ,  name="list_insectes")
     */
    public function listAction(){
    $todos = $this->getDoctrine()
    ->getRepository('AppBundle:User')
    ->findAll();
        return $this->render('todo/index.html.twig', array(
            'todos'=> $todos
        ));
       
    }
     /**
     * @Route("/todo/create", name="create_insectes")
     */
    public function createAction(Request $request)
    { $User = new User;
       $form= $this->createFormBuilder($User)
       ->add('username',TextType::class,array('attr' => array('class' => 'form-control', 'style'=>'margin-bottom:15px')))
        ->add('email',TextType::class,array('attr' => array('class' => 'form-control', 'style'=>'margin-bottom:15px')))
        ->add('password',TextType::class,array('attr' => array('class' => 'form-control', 'style'=>'margin-bottom:15px')))
         ->add('nom',TextType::class,array('attr' => array('class' => 'form-control', 'style'=>'margin-bottom:15px')))
        ->add('famille',TextType::class,array('attr' => array('class' => 'form-control', 'style'=>'margin-bottom:15px')))
     ->add('nourriture',TextType::class,array('attr' => array('class' => 'form-control', 'style'=>'margin-bottom:15px')))
     ->add('race',TextType::class,array('attr' => array('class' => 'form-control', 'style'=>'margin-bottom:15px')))
       ->add('save',SubmitType::class,array('label' => 'Create User','attr'=> array('class' => 'btn btn-primary', 'style'=>'margin-bottom:15px')))
        ->getForm();
        $form->handleRequest($request);

       if($form->isSubmitted() && $form->isValid()){

            // Get Data
             $username = $form['username']->getData();
              $email = $form['email']->getData();
                  $password = $form['password']->getData();
            $nom = $form['nom']->getData();
            $nourriture = $form['nourriture']->getData();
            $famille = $form['famille']->getData();
             $race = $form['race']->getData();

            $User->setUsername($username);
            $User->setEmail($email);
            
                    $User->setPassword($password);
             $User->setNom($nom);
               $User->setNourriture($nourriture);
                 $User->setFamille($famille);
                   $User->setRace($race);
                  $em = $this->getDoctrine()->getManager();

                  $em->persist($User);
                  $em->flush();
                  $this->addFlash('notice','User added');
    return $this->redirectedToRoute('list_insectes');
        }
    
        return $this->render('/todo/create.html.twig',array(
            'form' => $form ->createView()
        )
        );
    }
    /**
     * @Route("/todo/edit/{id}", name="edit_insectes")
     */
    public function editAction($id,Request $request)
    {
         $User = $this->getDoctrine()
    ->getRepository('AppBundle:User')
    ->find($id);
$User->setUsername($User->getUsername());
            $User->setEmail($User->getEmail());
             
                    $User->setPassword($User->getPassword());
             $User->setNom($User->getNom());
               $User->setNourriture($User->getNourriture());
                 $User->setFamille($User->getFamille());
                   $User->setRace($User->getRace());
                 


       $form= $this->createFormBuilder($User)
       ->add('username',TextType::class,array('attr' => array('class' => 'form-control', 'style'=>'margin-bottom:15px')))
        ->add('email',TextType::class,array('attr' => array('class' => 'form-control', 'style'=>'margin-bottom:15px')))
        ->add('password',TextType::class,array('attr' => array('class' => 'form-control', 'style'=>'margin-bottom:15px')))
         ->add('nom',TextType::class,array('attr' => array('class' => 'form-control', 'style'=>'margin-bottom:15px')))
        ->add('famille',TextType::class,array('attr' => array('class' => 'form-control', 'style'=>'margin-bottom:15px')))
     ->add('nourriture',TextType::class,array('attr' => array('class' => 'form-control', 'style'=>'margin-bottom:15px')))
     ->add('race',TextType::class,array('attr' => array('class' => 'form-control', 'style'=>'margin-bottom:15px')))
       ->add('save',SubmitType::class,array('label' => 'Update User','attr'=> array('class' => 'btn btn-primary', 'style'=>'margin-bottom:15px')))
        ->getForm();
        $form->handleRequest($request);

       if($form->isSubmitted() && $form->isValid()){

            // Get Data
             $username = $form['username']->getData();
              $email = $form['email']->getData();
                  $password = $form['password']->getData();
            $nom = $form['nom']->getData();
            $nourriture = $form['nourriture']->getData();
            $famille = $form['famille']->getData();
             $race = $form['race']->getData();
             $em = $this->getDoctrine()->getManager();
             $User =$em->getRepository('AppBundle:User')->find($id);
            $User->setUsername($username);
            $User->setEmail($email);
             
                    $User->setPassword($password);
             $User->setNom($nom);
               $User->setNourriture($nourriture);
                 $User->setFamille($famille);
                   $User->setRace($race);
                 

                  
                  $em->flush();
                  $this->addFlash('notice','User updated');
    return $this->redirectedToRoute('list_insectes');
        }
        return $this->render('todo/edit.html.twig', array(
            'User'=> $User ,
            'form' =>$form->createView()
        ));
    }
    /**
     * @Route("/todo/details/{id}", name="details_insectes")
     */
    public function detailsAction($id)
    {
        $User = $this->getDoctrine()
    ->getRepository('AppBundle:User')
    ->find($id);


        return $this->render('/todo/details.html.twig', array(
            'User'=> $User
        ));
    }
    /**
     * @Route("/todo/delete/{id}", name="insectes_lis")
     */
    public function deleteAction($id)
    {
         $em = $this->getDoctrine()->getManager();
             $User =$em->getRepository('AppBundle:User')->find($id);
    
    $em->remove($User);
    $em->flush();
      $this->addFlash('notice','User removed');
    return $this->redirectedToRoute('list_insectes');
    
    }
}
