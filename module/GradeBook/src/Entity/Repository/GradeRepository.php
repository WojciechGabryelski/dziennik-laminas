<?php

namespace GradeBook\Entity\Repository;

use Doctrine\DBAL\Cache\ArrayResult;
use Doctrine\ORM\AbstractQuery;
use GradeBook\Entity\Grade;
use GradeBook\Entity\Repository\Interface\GradeRepositoryInterface;

class GradeRepository extends CustomRepository implements GradeRepositoryInterface
{

    public function getNewEntityInstance(): Grade
    {
        return new Grade();
    }

    public function getCoursesAndStudents(int $teacherId): array|float|int|string
    {
        /*return $this->getEntityManager()->createQueryBuilder()
            ->select('c', 'sc', 's')
            ->from('GradeBook\Entity\Course', 'c', 'c.id')
            //->join('c.teacher', 't', 'with', 't.id = :teacherId')
            ->leftJoin('c.studentsCourse', 'sc')
            ->join('sc.student', 's')
            ->orderBy('s.lastName, s.firstName')
            ->getQuery()
            //->setParameter('teacherId', $teacherId)
            ->getArrayResult();*/
        $studentsCourses = $this->getEntityManager()->createQueryBuilder()
            ->select('c.id AS c_id', 'c.name AS c_name', 's.id AS s_id', 's.firstName AS s_firstName', 's.lastName AS s_lastName')
            ->from('GradeBook\Entity\StudentCourse', 'sc')
            ->join('sc.course', 'c')
            ->join('sc.student', 's')
            ->orderBy('s.lastName, s.firstName')
            ->getQuery()
            ->getArrayResult();
        $result = [];
        foreach ($studentsCourses as $studentCourse):
            if (empty($result[$studentCourse['c_id']])) {
                $result[$studentCourse['c_id']] = [
                    'id'   => $studentCourse['c_id'],
                    'name' => $studentCourse['c_name'],
                ];
            }
            $result[$studentCourse['c_id']]['students'][] = [
                'id'        => $studentCourse['s_id'],
                'firstName' => $studentCourse['s_firstName'],
                'lastName'  => $studentCourse['s_lastName'],
            ];
        endforeach;
        return $result;
    }

    public function findStudentCourse(int $studentId, int $courseId) {
        $result = $this->getEntityManager()->createQueryBuilder()
            ->select('sc')
            ->from('GradeBook\Entity\StudentCourse', 'sc')
            ->where('sc.student = :studentId')
            ->andWhere('sc.course = :courseId')
            ->getQuery()
            ->setParameter('studentId', $studentId)
            ->setParameter('courseId', $courseId)
            ->getResult();
        return $result == [] ? null : $result[0];
    }
}