<?php

namespace AppBundle\Controller;

use AppBundle\Entity\Asma;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;use Symfony\Component\HttpFoundation\Request;

/**
 * Asma controller.
 *
 * @Route("asma")
 */
class AsmaController extends Controller
{
    /**
     * Lists all asma entities.
     *
     * @Route("/", name="asma_index")
     * @Method("GET")
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $asmas = $em->getRepository('AppBundle:Asma')->findAll();

        return $this->render('asma/index.html.twig', array(
            'asmas' => $asmas,
        ));
    }

    /**
     * Creates a new asma entity.
     *
     * @Route("/new", name="asma_new")
     * @Method({"GET", "POST"})
     */
    public function newAction(Request $request)
    {
        $asma = new Asma();
        $form = $this->createForm('AppBundle\Form\AsmaType', $asma);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($asma);
            $em->flush();

            return $this->redirectToRoute('asma_show', array('id' => $asma->getId()));
        }

        return $this->render('asma/new.html.twig', array(
            'asma' => $asma,
            'form' => $form->createView(),
        ));
    }

    /**
     * Finds and displays a asma entity.
     *
     * @Route("/{id}", name="asma_show")
     * @Method("GET")
     */
    public function showAction(Asma $asma)
    {
        $deleteForm = $this->createDeleteForm($asma);

        return $this->render('asma/show.html.twig', array(
            'asma' => $asma,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing asma entity.
     *
     * @Route("/{id}/edit", name="asma_edit")
     * @Method({"GET", "POST"})
     */
    public function editAction(Request $request, Asma $asma)
    {
        $deleteForm = $this->createDeleteForm($asma);
        $editForm = $this->createForm('AppBundle\Form\AsmaType', $asma);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('asma_edit', array('id' => $asma->getId()));
        }

        return $this->render('asma/edit.html.twig', array(
            'asma' => $asma,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a asma entity.
     *
     * @Route("/{id}", name="asma_delete")
     * @Method("DELETE")
     */
    public function deleteAction(Request $request, Asma $asma)
    {
        $form = $this->createDeleteForm($asma);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($asma);
            $em->flush();
        }

        return $this->redirectToRoute('asma_index');
    }

    /**
     * Creates a form to delete a asma entity.
     *
     * @param Asma $asma The asma entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(Asma $asma)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('asma_delete', array('id' => $asma->getId())))
            ->setMethod('DELETE')
            ->getForm()
        ;
    }
}
