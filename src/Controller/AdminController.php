<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Security;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;
use Symfony\Component\HttpFoundation\Response;
use App\Form\EditUserType;
use App\Repository\UserRepository;
use App\Entity\User;
use Symfony\Contracts\Translation\TranslatorInterface;


/**
 * @Route("/{_locale}/admin", name="admin_")
 **/
class AdminController extends AbstractController
{
    /**
     * @Route("/", name="administration")
     */
    public function administration()
    {
        return $this->render('admin/administration.html.twig', [
            'controller_name' => 'AdminController',
        ]);
    }

    /**
     * Liste des utilisateurs du site
     * @Route("/utilisateurs", name="utilisateurs")
     */
    public function usersList(UserRepository $users)
    {
        return $this->render("admin/users.html.twig", [
            'users' => $users->findAll(),
        ]);
    }

    /**
     * Modifier un utilisateur
     * @Route("/utilisateur/modifier/{id}", name="modifier_utilisateur")
     */
    public function editUser(User $user, Request $request, TranslatorInterface $translator) 
    {
        $form = $this->createForm(EditUserType::class, $user);
        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid()){
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($user);
            $entityManager->flush();

            $message = $translator->trans('User modified succesfully');

            $this->addFlash('message', $message);
            return $this->redirectToRoute('admin_utilisateurs');
        }
        
        return $this->render('admin/editUser.html.twig', [
            'userForm' => $form->createView(),
        ]);
    }

    /**
     * Supprimer un utilisateur
     * @IsGranted("ROLE_ADMIN")
     * @Route("user/{id}/delete", name="delete")
      * @param Request $request
     * @param User $user
     * @param EntityManagerInterface $em
     * @return Response
     */
    public function delete(Request $request, User $user, EntityManagerInterface $em) : Response
    {
        $form = $this->createFormBuilder()
            ->setAction($this->generateUrl('admin_delete', ['id' => $user->getId()]))
            ->getForm();
        $form->handleRequest($request);
        if ( ! $form->isSubmitted() || ! $form->isValid()) {
            return $this->render('admin/deleteUser.html.twig', [
                'user' => $user,
                'form' => $form->createView(),
            ]);
        }
        $em = $this->getDoctrine()->getManager();
        $em->remove($user);
        $em->flush();
        return $this->redirectToRoute('admin_utilisateurs');
    }
}



