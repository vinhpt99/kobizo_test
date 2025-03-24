<?php

namespace App\Controller;

use App\Entity\Meta;
use App\Entity\Post;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Serializer\SerializerInterface;

class MetaController extends AbstractController
{
  // GET ALL Meta
  #[Route('/api/meta', name: 'list_meta', methods: ['GET'])]
  public function getAllMeta(EntityManagerInterface $em, SerializerInterface $serializer): JsonResponse
  {
    $metaList = $em->getRepository(Meta::class)->findAll();
    return new JsonResponse(array_map(fn($meta) => [
      'id' => $meta->getId(),
      'meta_key' => $meta->getMetaKey(),
      'value' => $meta->getValue(),
      'post_title' => $meta->getPost()->getTitle(),
    ], $metaList));
  }

  // GET Meta by ID
  #[Route('/api/meta/{id}', name: 'get_meta', methods: ['GET'])]
  public function getMeta($id, EntityManagerInterface $em, SerializerInterface $serializer): JsonResponse
  {
    $meta = $em->getRepository(Meta::class)->find($id);
    if (!$meta) return new JsonResponse(['error' => 'Meta not found'], 404);
    return new JsonResponse([
      'id' => $meta->getId(),
      'meta_key' => $meta->getMetaKey(),
      'value' => $meta->getValue(),
      'post_id' => $meta->getPost()->getId(),
    ]);
  }

  // CREATE Meta
  #[Route('/api/meta', name: 'create_meta', methods: ['POST'])]
  public function createMeta(Request $request, EntityManagerInterface $em): JsonResponse
  {
    $data = json_decode($request->getContent(), true);
    $post = $em->getRepository(Post::class)->find($data['post_id']);

    if (!$post) return new JsonResponse(['error' => 'Post not found'], 404);

    $meta = new Meta();
    $meta->setMetaKey($data['meta_key']);
    $meta->setValue($data['value']);
    $meta->setPost($post);

    $em->persist($meta);
    $em->flush();

    return new JsonResponse(['message' => 'Meta created successfully', 'id' => $meta->getId()], 201);
  }

  // UPDATE Meta
  #[Route('/api/meta/{id}', name: 'update_meta', methods: ['PUT'])]
  public function updateMeta($id, Request $request, EntityManagerInterface $em): JsonResponse
  {
    $data = json_decode($request->getContent(), true);
    $meta = $em->getRepository(Meta::class)->find($id);

    if (!$meta) return new JsonResponse(['error' => 'Meta not found'], 404);

    if (isset($data['meta_key'])) $meta->setMetaKey($data['meta_key']);
    if (isset($data['value'])) $meta->setValue($data['value']);

    $em->flush();
    return new JsonResponse(['message' => 'Meta updated successfully']);
  }
}
