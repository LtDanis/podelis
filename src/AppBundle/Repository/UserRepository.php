<?php

namespace AppBundle\Repository;

/**
 * UserRepository
 *
 * This class was generated by the Doctrine ORM. Add your own custom
 * repository methods below.
 */
class UserRepository extends \Doctrine\ORM\EntityRepository
{
    /** @param  \DateInterval $time */
    public function addTime($time, $answers, $uId)
    {
        $seconds = $time->s + $time->i * 60 + $time->h * 3600;
        $correct = $incorrect = 0;

        foreach ($answers as $answer)
        {
            if($answer == true){
                $correct++;
            }

            else{
                $incorrect++;
            }
        }

        $connection = $this->_em->getConnection();
        $sql = "UPDATE users SET 
                time_spent = DATE_ADD(time_spent, INTERVAL :seconds SECOND),
                 correct = correct + :correct,
                  incorrect = incorrect + :incorrect,
                   tests_taken = tests_taken + 1
                   WHERE id = :id";

        $stmt = $connection->prepare($sql);
        $stmt->bindValue('seconds', $seconds);
        $stmt->bindValue('id', $uId);
        $stmt->bindValue('correct', $correct);
        $stmt->bindValue('incorrect', $incorrect);
        $stmt->execute();
    }
}
