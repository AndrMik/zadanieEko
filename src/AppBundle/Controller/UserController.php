<?php


namespace AppBundle\Controller;


use AppBundle\Entity\User;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\Extension\Core\Type\RepeatedType;
use Symfony\Component\Form\Extension\Core\Type\TextType;

class UserController extends Controller
{
    /**
     * @Route("/users/user")
     */
    public function userAction(){
        return $this->render('users/user.html.twig');
    }

    /**
     * @Route("/users/display", name="app_users_display")
     */
    public function displayUsers(){
        $usersDB = $this->getDoctrine()
            ->getRepository('AppBundle:User')
            ->findAll();
        return $this->render("users/display.html.twig", array('dane' => $usersDB));
    }

    /**
     * @Route("/users/addUser", name = "app_users_add")
     */
    public function addNewUser(Request $request){
        $newUser = new User();
        $form = $this->createFormBuilder($newUser)
            ->add('name', TextType::class)
            ->add('login', TextType::class)
            ->add('pass', RepeatedType::class, array(
                'type' => PasswordType::class,
                'invalid_message' => 'The password fields 
            must match.', 'options' => array('attr' => array('class' => 'password-field')),
                'required' => true, 'first_options'  => array('label' => 'Password'),
                'second_options' => array('label' => 'Re-enter'),
            ))
            ->add('rcp', TextType::class)
            ->add('save', SubmitType::class, array('label' => 'Submit'))
            ->getForm();

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $newUser = $form->getData();
            $doct = $this->getDoctrine()->getManager();

            // tells Doctrine you want to save the Product
            $doct->persist($newUser);

            //executes the queries (i.e. the INSERT query)
            $doct->flush();

            return $this->redirectToRoute('app_users_display');
        } else {
            return $this->render('users/addUser.html.twig', array(
                'form' => $form->createView(),
            ));
        }
    }

    /**
     * @Route("/users/update/{id}", name = "app_users_update" )
     */
    public function updateAction($id, Request $request) {
        $doct = $this->getDoctrine()->getManager();
        $user = $doct->getRepository('AppBundle:User')->find($id);

        if (!$user) {
            throw $this->createNotFoundException(
                'No user found for id '.$id
            );
        }
        $form = $this->createFormBuilder($user)
            ->add('name', TextType::class)
            ->add('login', TextType::class)
            ->add('rcp', TextType::class)
            ->add('save', SubmitType::class, array('label' => 'Submit'))
            ->getForm();

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $user = $form->getData();
            $doct = $this->getDoctrine()->getManager();

            // tells Doctrine you want to save the Product
            $doct->persist($user);

            //executes the queries (i.e. the INSERT query)
            $doct->flush();
            return $this->redirectToRoute('app_users_display');
        } else {
            return $this->render('users/addUser.html.twig', array(
                'form' => $form->createView(),
            ));
        }
    }

    /**
     * @Route("/users/delete/{id}", name="app_users_delete")
     */
    public function deleteAction($id) {
        $doct = $this->getDoctrine()->getManager();
        $user = $doct->getRepository('AppBundle:User')->find($id);

        if (!$user) {
            throw $this->createNotFoundException('No user found for id '.$id);
        }
        $doct->remove($user);
        $doct->flush();
        return $this->redirectToRoute('app_users_display');
    }

}