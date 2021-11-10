<?php

namespace App\Controller;

use App\DTO\RequestDTO;
use App\Entity\Request as RequestEntity;
use App\Form\Type\RequestType;
use App\Repository\RequestRepository;
use Doctrine\ORM\EntityManager;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/request")
 */
class RequestController extends AbstractController
{
    public function __construct(EntityManagerInterface $entityManager)
    {
        $this->entityManager = $entityManager;
    }

    /**
     * @Route("/list", name="request.list")
     */
    public function getListAction(RequestRepository $requestRepository): Response
    {

        $requestList = $requestRepository->findAll();

        return $this->render('request/list.html.twig', [
            'requestList' => $requestList
        ]);
    }

    /**
     * @Route("/show/{id}", name="request.show")
     */
    public function showRequestAction(int $id, RequestRepository $requestRepository): Response
    {
        $request = $requestRepository->findById($id);
        if (is_null($request)) {
            throw new NotFoundHttpException('Запрос не найден');
        }

        return $this->render('request/show.html.twig', [
            'request' => $request
        ]);
    }

    /**
     * @Route("/add", name="request.add")
     */
    public function addRequestAction(Request $request): Response
    {
        $requestDTO = new RequestDTO();

        $form = $this->createForm(RequestType::class, $requestDTO, [
            'action' => $this->generateUrl('request.add')
        ]);

        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $requestEntity = RequestEntity::createFromDTO($requestDTO);
            $this->entityManager->persist($requestEntity);
            $this->entityManager->flush();

            return $this->redirectToRoute('request.show', [
                'id' => $requestEntity->getId()
            ]);
        }

        return $this->renderForm('request/add.html.twig', [
            'form' => $form,
        ]);

    }
}