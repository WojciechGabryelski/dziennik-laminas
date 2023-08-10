<?php

namespace GradeBook\Entity\Repository;

use Exception;
use GradeBook\Entity\StudentCourse;

class StudentCourseRepository extends CustomRepository
{
    public function getNewEntityInstance(): StudentCourse
    {
        return new StudentCourse();
    }

    public function findByStudentAndCourse(int $studentId, int $courseId)
    {
        $result = $this->getEntityManager()->createQueryBuilder()
            ->select('sc')
            ->from('GradeBook\Entity\StudentCourse', 'sc')
            ->where('sc.student = :studentId AND sc.course = :courseId')
            ->getQuery()
            ->setParameter('studentId', $studentId)
            ->setParameter('courseId', $courseId)
            ->getResult();
        return $result == [] ? null : $result[0];
    }

    public function deleteByStudentAndCourse(int $studentId, int $courseId): void
    {
        $this->getEntityManager()->createQueryBuilder()
            ->delete('GradeBook\Entity\StudentCourse', 'sc')
            ->where('sc.student = :studentId AND sc.course = :courseId')
            ->getQuery()
            ->setParameter('studentId', $studentId)
            ->setParameter('courseId', $courseId)
            ->getResult();
    }

    public function getCoursesAndStudents(int $teacherId): array|float|int|string
    {
        /*$em = $this->getEntityManager();
        $expr = $em->getExpressionBuilder();
        $subQuery = $em->createQueryBuilder()
            ->select('c.id AS c_id', 'c.name AS c_name', 's.id AS s_id', 's.firstName AS s_firstName', 's.lastName AS s_lastName')
            ->from('GradeBook\Entity\Course', 'c')
            ->join('GradeBook\Entity\Student', 's', 'WITH', '0=0')
            ->where($expr->not($expr->exists(
                $em->createQueryBuilder()
                    ->select('sc')
                    ->from('GradeBook\Entity\StudentCourse', 'sc')
                    ->where('sc.student = s.id AND sc.course = c.id')
                    ->getDQL()
            )));
        $query = $em->createQueryBuilder()
            ->select('c.id AS c_id', 'c.name AS c_name', 's_id', 's_firstName', 's_lastName')
            ->from('GradeBook\Entity\Course', 'c')
            ->leftJoin('(' . $subQuery->getDQL() . ')', 'sq', 'WITH', 'c.c_id = sq.c_id')
            ->orderBy('c_name, s_lastName, s_firstName')
            ->getQuery();
        $studentsCourses = $query->getArrayResult();*/
        $sql = 'SELECT c.id AS c_id, c.name AS c_name, s_id, s_firstName, s_lastName
            FROM courses c LEFT JOIN (SELECT c.id AS c_id, c.name AS c_name, s.id AS s_id, s.first_name AS s_firstName,
            s.last_name AS s_lastName FROM courses c, students s WHERE NOT EXISTS(SELECT * FROM students_courses sc
            WHERE s.id = sc.student_id AND c.id = sc.course_id)) sq ON c.id = sq.c_id ORDER BY c_name, s_lastName, s_firstName';
        try {
            $stmt = $this->getEntityManager()->getConnection()->prepare($sql);
            $studentsCourses = $stmt->executeQuery()->fetchAllAssociative();
        } catch (Exception $ex) {
            echo $ex->getMessage();
            return [];
        }
        $result = [];
        foreach ($studentsCourses as $studentCourse):
            if (empty($result[$studentCourse['c_id']])) {
                $result[$studentCourse['c_id']] = [
                    'id'       => $studentCourse['c_id'],
                    'name'     => $studentCourse['c_name'],
                    'students' => [],
                ];
            }
            if (!empty($studentCourse['s_id'])) {
                $result[$studentCourse['c_id']]['students'][] = [
                    'id' => $studentCourse['s_id'],
                    'firstName' => $studentCourse['s_firstName'],
                    'lastName' => $studentCourse['s_lastName'],
                ];
            }
        endforeach;
        return $result;
    }

    public function findStudent($studentId)
    {
        $result = $this->getEntityManager()->createQueryBuilder()
            ->select('s')
            ->from('GradeBook\Entity\Student', 's')
            ->where('s.id = :studentId')
            ->getQuery()
            ->setParameter('studentId', $studentId)
            ->getResult();
        return $result == [] ? null : $result[0];
    }

    public function findCourse($courseId)
    {
        $result = $this->getEntityManager()->createQueryBuilder()
            ->select('c')
            ->from('GradeBook\Entity\Course', 'c')
            ->where('c.id = :courseId')
            ->getQuery()
            ->setParameter('courseId', $courseId)
            ->getResult();
        return $result == [] ? null : $result[0];
    }
}