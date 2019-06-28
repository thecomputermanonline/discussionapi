<?php

namespace App\Controller;

use App\Entity\Thread;
use App\Entity\User;
use App\Form\ThreadType;
use App\Repository\ThreadRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/thread")
 */
class ThreadController extends AbstractController
{
    /**
     * @Route("/", name="thread_index", methods={"GET"})
     */
    public function index(ThreadRepository $threadRepository): Response
    {
        return $this->render('thread/index.html.twig', [
            'threads' => $threadRepository->findAll(),
        ]);
    }

    /**
     * @Route("/new", name="thread_new", methods={"GET","POST"})
     */
    public function new(Request $request): Response
    {
        $thread = new Thread();
        $form = $this->createForm(ThreadType::class, $thread);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($thread);
            $entityManager->flush();

            return $this->redirectToRoute('thread_index');
        }

//        $entityManager = $this->getDoctrine()->getManager();
//
//        $user = $entityManager->getRepository(User::class)
//            ->findOneBy(['email' => 'olalekanarowoselu@gmail.com']);
//        $thread->setSubject('thread1');
//        $thread->addParticipant($user);

        //$entityManager->persist($thread);
        //$entityManager->flush();

      //  return $this->redirectToRoute('thread_index');



        return $this->render('thread/new.html.twig', [
            'thread' => $thread,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="thread_show", methods={"GET"})
     */
    public function show(Thread $thread): Response
    {
        return $this->render('thread/show.html.twig', [
            'thread' => $thread,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="thread_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, Thread $thread): Response
    {
        $form = $this->createForm(ThreadType::class, $thread);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('thread_index', [
                'id' => $thread->getId(),
            ]);
        }

        return $this->render('thread/edit.html.twig', [
            'thread' => $thread,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="thread_delete", methods={"DELETE"})
     */
    public function delete(Request $request, Thread $thread): Response
    {
        if ($this->isCsrfTokenValid('delete'.$thread->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($thread);
            $entityManager->flush();
        }

        return $this->redirectToRoute('thread_index');
    }
}
