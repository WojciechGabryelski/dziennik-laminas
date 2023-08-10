<?php

namespace GradeBook\Entity\Repository;

use Doctrine\DBAL\ParameterType;
use Exception;
use GradeBook\Entity\Repository\Interface\StudentRepositoryInterface;
use GradeBook\Entity\Student;

class StudentRepository extends CustomRepository implements StudentRepositoryInterface
{
    public function fetchAllGrades(int $studentId) {
        /*return $this->getEntityManager()->createQueryBuilder()
            ->select('c', 'sc', 'g')
            ->from('GradeBook\Entity\Course', 'c')
            ->join('c.studentsCourse', 'sc', 'WITH', 'sc.student = :studentId')
            ->leftJoin('sc.grades', 'g')
            ->orderBy('g.date')
            ->getQuery()
            ->setParameter('studentId', $studentId)
            ->getResult();*/
        $sql = 'SELECT c.id AS c_id, c.name AS c_name, g.id AS g_id, g.value AS g_value, g.wage AS g_wage, g.date AS g_date
            FROM courses c JOIN students_courses sc ON c.id = sc.course_id AND sc.student_id = ?
            LEFT JOIN grades g ON sc.student_id = g.student_id AND sc.course_id = g.course_id ORDER BY c_name, g_date';
        try {
            $stmt = $this->getEntityManager()->getConnection()->prepare($sql);
            $stmt->bindValue(1, $studentId, ParameterType::INTEGER);
            $courses = $stmt->executeQuery()->fetchAllAssociative();
        } catch (Exception $ex) {
            echo $ex->getMessage();
            return [];
        }
        $result = [];
        foreach ($courses as $course):
            if (empty($result[$course['c_id']])) {
                $result[$course['c_id']] = ['id' => $course['c_id'], 'name' => $course['c_name'], 'grades' => []];
            }
            $result[$course['c_id']]['grades'][] = [
                'id'    => $course['g_id'],
                'value' => $course['g_value'],
                'wage'  => $course['g_wage'],
                'date'  =>$course['g_date'],
            ];
        endforeach;
        return $result;
    }

    public function getNewEntityInstance(): Student
    {
        return new Student();
    }
}