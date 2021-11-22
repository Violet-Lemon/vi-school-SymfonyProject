<?php

namespace App\Controller;

use App\DTO\UserDTO;
use App\Entity\User;
use App\Form\Type\RegistrationType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;

/**
 * @Route("/registration")
 */
class RegistrationController extends AbstractController
{
    public function __construct(EntityManagerInterface $entityManager)
    {
        $this->entityManager = $entityManager;
    }

    /**
     * @Route("/", name="app.registration")
     */
    public function registrationAction(Request $request, UserPasswordHasherInterface $passwordHasher): Response
    {
        $userDTO = new UserDTO();
        $form = $this->createForm(RegistrationType::class, $userDTO, [
            'action' => $this->generateUrl('app.registration')
        ]);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {

            $user = new User();
            $user->setEmail($userDTO->getEmail());
            $hashedPassword = $passwordHasher->hashPassword(
                $user,
                $userDTO->getPlainPassword()
            );
            $user->setPassword($hashedPassword);

            $this->entityManager->persist($user);
            $this->entityManager->flush();

            return $this->redirectToRoute('homepage');

        }

        return $this->renderForm('app/registration.html.twig', [
            'form' => $form,
        ]);

    }

}