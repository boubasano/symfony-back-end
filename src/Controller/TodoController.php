<?php

namespace App\Controller;

use App\Entity\Todo;
use App\Form\TodoType;
use App\Repository\TodoRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
/**
 * @Route("/todos" , methods={"OPTIONS"})
 */
class TodoController extends AbstractController
{
    /**
     * @Route("/", name="todo_index", methods={"GET"})
     * @param TodoRepository $repository
     * @return Response
     */
    public function index(TodoRepository $repository): Response
    {
        $response = $this->json($repository->findAll());
        return $response;
    }

    /**
     * @Route ("/{id}", methods={"GET"})
     */
    public function show($id, EntityManagerInterface $entityManager)
    {
        return $this->json($entityManager->find(Todo::class, $id));

    }

    /**
     * @return Response
     * @Route ("/", methods={"POST"})
     */
    public function new(Request $request): Response
    {
        $request->request->add(["todo" =>json_decode($request->getContent(), true)]);
        $form = $this->createForm(TodoType::class, new Todo())->handleRequest($request);
        if( $form->isSubmitted() && $form->isValid())
        {
            $em = $this->getDoctrine()->getManager();
            $em->persist($form->getData());
            $em->flush();
            return $this->json($form->getData(), 201);
        }
        return $this->json(["error" => "Bad request"], 400);
    }

    /**
     * @Route("/{id}", methods={"DELETE"})
     * @param Request $request
     * @param Todo $todo
     * @return Response
     */
    public function delete(Todo $todo): Response
    {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($todo);
            $entityManager->flush();
            return $this->json('cette tache est supprimée'.$todo->getId(), 205);
    }




}
