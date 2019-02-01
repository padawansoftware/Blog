<?php
namespace Core\EntityRepository;

use Doctrine\ORM\EntityRepository;
use Doctrine\ORM\Tools\Pagination\Paginator;

class PostRepository extends EntityRepository
{
    public function getEnabled($orderBy, $limit)
    {
        $query = $this->createQueryBuilder('p')
            ->addSelect('c')
            ->join('p.chapters', 'c')
            ->where('p.enabled =:status')
            ->andWhere('c.enabled =:status')
            ->groupBy('p.id')
            ->setParameter('status', true)
            ->setMaxResults($limit)
        ;

        foreach ($orderBy as $property => $order) {
            $query->addOrderBy('p.' . $property, $order);
        }

        return $query->getQuery()->getResult();
    }
}
