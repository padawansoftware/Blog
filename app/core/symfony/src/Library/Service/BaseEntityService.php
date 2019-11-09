<?php

namespace Core\Library\Service;

use Doctrine\Common\Persistence\ManagerRegistry as Doctrine;

abstract class BaseEntityService
{
    protected $doctrine;

    protected $repository;

    protected $class;

    protected $em;

    public function __construct(Doctrine $doctrine)
    {
        $this->class = $this->getEntityClass();

        $this->doctrine = $doctrine;
        $this->em = $doctrine->getEntityManager();
        $this->repository = $doctrine->getRepository($this->class);
    }

    /**
     * @return string The entity class this service is associated to
     */
    abstract protected function getEntityClass():string;


    //
    // CRUD
    //

    /**
     * Create a new entity instance
     */
    public function create()
    {
        return new $this->class();
    }

    public function persist($entity)
    {
        $this->em->persist($entity);
        $this->em->flush();
    }

    /**
     * Update an entity in DB
     */
    public function update()
    {
        $this->em->flush();
    }

    /**
     * Remove an entity from DB
     */
    public function remove($entity)
    {
        $this->em->remove($entity);
        $this->em->flush();
    }


    //
    // Search
    //

    public function find($id)
    {
        return $this->repository->find($id);
    }

    public function findAll()
    {
        return $this->repository->findAll();
    }

    public function findBy($criteria)
    {
        return $this->repository->findBy($criteria);
    }
}
