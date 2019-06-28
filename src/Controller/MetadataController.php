<?php

namespace App\Controller;

use App\Entity\Metadata;
use App\Form\MetadataType;
use App\Repository\MetadataRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/metadata")
 */
class MetadataController extends AbstractController
{
    /**
     * @Route("/", name="metadata_index", methods={"GET"})
     */
    public function index(MetadataRepository $metadataRepository): Response
    {
        return $this->render('metadata/index.html.twig', [
            'metadata' => $metadataRepository->findAll(),
        ]);
    }

    /**
     * @Route("/new", name="metadata_new", methods={"GET","POST"})
     */
    public function new(Request $request): Response
    {
        $metadata = new Metadata();
        $form = $this->createForm(MetadataType::class, $metadata);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($metadata);
            $entityManager->flush();

            return $this->redirectToRoute('metadata_index');
        }

        return $this->render('metadata/new.html.twig', [
            'metadata' => $metadata,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="metadata_show", methods={"GET"})
     */
    public function show(Metadata $metadata): Response
    {
        return $this->render('metadata/show.html.twig', [
            'metadata' => $metadata,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="metadata_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, Metadata $metadata): Response
    {
        $form = $this->createForm(MetadataType::class, $metadata);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('metadata_index', [
                'id' => $metadata->getId(),
            ]);
        }

        return $this->render('metadata/edit.html.twig', [
            'metadata' => $metadata,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="metadata_delete", methods={"DELETE"})
     */
    public function delete(Request $request, Metadata $metadata): Response
    {
        if ($this->isCsrfTokenValid('delete'.$metadata->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($metadata);
            $entityManager->flush();
        }

        return $this->redirectToRoute('metadata_index');
    }
}
