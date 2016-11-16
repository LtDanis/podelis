<?php

namespace AppBundle\Repository;

/**
 * AnswerRepository
 *
 * This class was generated by the Doctrine ORM. Add your own custom
 * repository methods below.
 */
class AnswerRepository extends \Doctrine\ORM\EntityRepository
{
    public function getAllChecked($answers)
    {
        return $this->createQueryBuilder('a')
            ->select('a')
            ->where('a.id IN (:ids)')
            ->setParameter('ids', $answers)
            ->distinct(true)
            ->getQuery()
            ->getResult();
    }

    public function getCorrectIds($qId)
    {
        return $this->createQueryBuilder('a')
            ->select('a.id')
            ->where('a.question = :qId')
            ->andWhere('a.correct = 1')
            ->setParameter('qId', $qId)
            ->getQuery()
            ->getResult();
    }
}
