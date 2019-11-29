<?php
namespace Core\EntityRepository;

use Doctrine\ORM\EntityRepository;
use Doctrine\ORM\Tools\Pagination\Paginator;

class PostRepository extends EntityRepository
{
    public function getEnabled($orderBy = ['order' => 'ASC'], $limit = null)
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

    /**
     * Find a list of posts delimited by an order range
     *
     * @param $minOrder minimum order
     * @param $maxOrder maximum order
     *
     * @return a list of posts whose order are between $minOrder and $maxOrder
     */
    public function findByOrderRange($minOrder, $maxOrder)
    {
        $query = $this->createQueryBuilder('p')
            ->where('p.order >= :minOrder')
            ->andWhere('p.order <= :maxOrder')
            ->orderBy('p.order', 'ASC')
            ->setParameters([
                'minOrder' => $minOrder,
                'maxOrder' => $maxOrder
            ])
        ;

        return $query->getQuery()->getResult();
    }

    /**
     * Return MAX post order
     */
    public function getMaxOrder()
    {
        $query = $this->createQueryBuilder('p')
            ->select('MAX(p.order)')
        ;

        return $query->getQuery()->getSingleScalarResult();
    }
}
