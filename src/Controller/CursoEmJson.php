<?php

namespace Alura\Cursos\Controller;

use Alura\Cursos\Entity\Curso;
use Doctrine\Common\Persistence\ObjectRepository;
use Doctrine\ORM\EntityManagerInterface;
use Nyholm\Psr7\Response;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Psr\Http\Server\RequestHandlerInterface;

class CursoEmJson implements RequestHandlerInterface
{

    /**
     * @var EntityManagerInterface
     */
    private $entityManager;
    /**
     * @var ObjectRepository
     */
    private $repositorioDecursos;

    public function __construct(EntityManagerInterface $entityManager)
    {
        $this->repositorioDecursos = $entityManager->getRepository(Curso::class);
        $this->entityManager = $entityManager;
    }

    public function handle(ServerRequestInterface $request): ResponseInterface
    {
        $curso= $this->repositorioDecursos->findAll();
        return new Response(200, ['Content-Type' => 'application/json'], json_encode($curso));
    }
}