<?php

namespace App\Packages\Doctrine\Repository;

class Repository extends AbstractRepository
{
    protected array $defaultOrderings = [];

    /**
     * @param object $entity
     * @throws \Doctrine\ORM\ORMException
     */
    public function dbSave(object $entity)
    {
        $this->_em->persist($entity);
    }

    /**
     * @param object $entity
     * @throws \Doctrine\ORM\ORMException
     */
    public function dbUpdate(object $entity)
    {
        return $this->_em->merge($entity);
    }

    /**
     * @param object $entity
     * @throws \Doctrine\ORM\ORMException
     */
    public function dbRemove(object $entity)
    {
        $this->_em->remove($entity);
    }

    /**
     * @return \Doctrine\ORM\QueryBuilder
     */
    public function getQueryBuilder()
    {
        return $this->_em->createQueryBuilder();
    }

}
