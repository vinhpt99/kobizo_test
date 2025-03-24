<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Doctrine\ORM\EntityManagerInterface;
use App\Entity\Post;
use Doctrine\ORM\Exception\ORMException;
use Doctrine\DBAL\Exception as DBALException;



class PostController extends AbstractController
{
    //get all
    #[Route('/api/posts', name: 'get_all_posts', methods: ['GET'])]
    public function getAllPosts(EntityManagerInterface $em): JsonResponse
    {
        $posts = $em->getRepository(Post::class)->findAll();
        return new JsonResponse(array_map(fn($p) => [
            'id' => $p->getId(),
            'title' => $p->getTitle(),
            'content' => $p->getContent(),
            'metas' => array_map(fn($meta) => [
                'id' => $meta->getId(),
                'key' => $meta->getMetaKey(),
                'value' => $meta->getValue(),
            ], $p->getMetas()->toArray())
        ], $posts));
    }

    //get post
    #[Route('/api/posts/{id}', name: 'get_post', methods: ['GET'])]
    public function getPost($id, EntityManagerInterface $em): JsonResponse
    {
        $post = $em->getRepository(Post::class)->find($id);
        if (!$post) return new JsonResponse(['error' => 'Not found'], 404);
        return new JsonResponse([
            'id' => $post->getId(),
            'title' => $post->getTitle(),
            'content' => $post->getContent(),
            'status' => $post->getStatus(),
        ]);
    }

    #[Route('/api/posts', name: 'create', methods: ['POST'])]
    public function create(Request $request, EntityManagerInterface $em): JsonResponse
    {
        $data = json_decode($request->getContent(), true);

        $post = new Post();
        $post->setTitle($data['title']);
        $post->setContent($data['content']);
        $post->setStatus($data['status']);

        $em->persist($post);

        try {
            $em->flush();
        } catch (ORMException $e) {
            echo "Lỗi ORM: " . $e->getMessage();
        } catch (DBALException $e) {
            echo "Lỗi DBAL: " . $e->getMessage();
        } catch (\Exception $e) {
            echo "Lỗi khác: " . $e->getMessage();
        }
        return $this->json(['message' => 'Post created successfully', 'id' => $post->getId()]);
    }

    #[Route('/api/posts/{id}', name: 'update_post', methods: ['PUT'])]
    public function updatePost($id, Request $request, EntityManagerInterface $em): JsonResponse
    {
        $post = $em->getRepository(Post::class)->find($id);
        if (!$post) return new JsonResponse(['error' => 'Not found'], 404);

        $data = json_decode($request->getContent(), true);
        $post->setTitle($data['title']);
        $post->setContent($data['content']);
        $post->setStatus($data['status']);

        $em->flush();
        return new JsonResponse(['message' => 'Updated']);
    }
}
