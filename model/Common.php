<?php

namespace model;

use config\MysqlConnection as Db;
use \PDO;

class Common
{

    public $db;
    public function __construct()
    {
        $mydb =  new Db();
        $this->db = $mydb->getDb();
    }
    public function getAllStudent()
    {
        // prepare statement
        $stmt = $this->db->prepare("SELECT * FROM class");
        $stmt->execute();
        // set the resulting array to associative
        $result = $stmt->setFetchMode(PDO::FETCH_ASSOC);
        return $stmt->fetchAll();
    }

    /**
     * getUserRecordById function
     *
     * @param integer $id
     * @return array
     */
    public function getRecordByUserid($id = 0): array
    {
        if ($id != 0) {
            $sql = "SELECT s1.studentid, s1.name as stdName , s2.subjectid ,s2.name as subName , s2.maxmarks , s3.marks , s4.name as className FROM students s1 join subjects s2 on s1.classid = s2.classid  JOIN  results s3 on s2.subjectid  = s3.subid and s3.studentid = ? and s1.studentid = ? JOIN class s4 on s1.classid = s4.classid";
            // prepare statement
            $stmt = $this->db->prepare($sql);
            $stmt->execute([$id, $id]);
            // set the resulting array to associative
            $result = $stmt->setFetchMode(PDO::FETCH_ASSOC);
            return $stmt->fetchAll();
        }

        return false;
    }


    public function getSubjectMarksByUserid($id = 0)
    {
        $records = $this->getRecordByUserid($id);


        $marks  = array_sum(array_column($records, 'marks'));
        $data['total_marks']  =  $marks;
        return $data;
    }

    public function getUserClass($id)
    {
        $sql = 'SELECT s1.studentid , s1.classid  FROM students s1 where studentid = ?';
        $stmt = $this->db->prepare($sql);
        $stmt->execute([$id]);
        // set the resulting array to associative
        $result = $stmt->setFetchMode(PDO::FETCH_ASSOC);
        return $stmt->fetchAll();
    }

    public function getUserPercentile($id = 0)
    {
        // get class id from student id
        $record = $this->getUserClass($id);

        //get total marks from student id
        $total = $this->getSubjectMarksByUserid($id)['total'];
        $sql = 'SELECT s1.studentid , s1.name , SUM(s2.marks) as total FROM students s1 JOIN results s2 on s1.studentid = s2.studentid where s1.classid = ? GROUP by s2.studentid';
        $stmt = $this->db->prepare($sql);
        $stmt->execute([$record[0]['classid']]);
        // set the resulting array to associative
        $result = $stmt->setFetchMode(PDO::FETCH_ASSOC);
        $students =  $stmt->fetchAll();
        $total_marks = array_column($students, 'total');
        return $this->getPercentile($total, $total_marks);
    }

    public function getPercentile($percentile, $array)
    {
        sort($array);
        $position = array_search($percentile, $array) + 1;
        return ($position * 100) / count($array);
    }


    public function getTop10UserClassById($classid = 0)
    {



        //get total marks from student id $total = $this->getSubjectMarksByUserid($id)['total'];
        $sql = 'SELECT s1.studentid , s1.name, SUM(s2.marks) as marks FROM students s1 JOIN results s2 on s1.studentid = s2.studentid where s1.classid = ? GROUP by s2.studentid ORDER by marks DESC LIMIT 0 , 10';
        $stmt = $this->db->prepare($sql);
        $stmt->execute([$classid]);
        // set the resulting array to associative
        $stmt->setFetchMode(PDO::FETCH_ASSOC);
        $students =  $stmt->fetchAll();


        $sql = 'SELECT sum(s1.maxmarks) as maxmarks , c1.name as className FROM subjects s1 join class c1 on c1.classid = s1.classid WHERE s1.classid = ?';
        $stmt1 = $this->db->prepare($sql);
        $stmt1->execute([$classid]);
        // set the resulting array to associative
        $stmt1->setFetchMode(PDO::FETCH_ASSOC);
        $grand_total =  $stmt1->fetchAll();


        foreach ($students as $k => $v) {
            $students[$k]['maxmarks'] = $grand_total[0]['maxmarks'];
            $students[$k]['className'] = $grand_total[0]['className'];
        }
        return $students;
    }


    public function avgMarksForEachSubject($classid)
    {

        $sql = 'SELECT s1.subjectid , r1.marks , s1.name , AVG(r1.marks) as avgMarks FROM subjects s1 join results r1 on r1.subid = s1.subjectid and s1.classid = ? GROUP by s1.subjectid';
        $stmt = $this->db->prepare($sql);
        $stmt->execute([$classid]);
        // set the resulting array to associative
        $stmt->setFetchMode(PDO::FETCH_ASSOC);
        return $stmt->fetchAll();
    }


    public function findGreaterNumberCount($array,  $lessNumber, $number = 101)
    {
        $count = 0;
        foreach ($array as $value) {
            if ($value >= $lessNumber && $value < $number) {

                $count++;
            }
        }
        return $count;
    }

    public function  medianClass($arr)
    {
        $middle = count($arr) / 2;
        if (count($arr) % 2 == 1) {
            return $arr[$middle];
        } else {
            return ($arr[$middle - 1] + $arr[$middle]) / 2.0;
        }
    }

    public function getTotalFailureInClass($classid)
    {
        $sql = 'SELECT * FROM `students` WHERE classid = ?';
        $stmt = $this->db->prepare($sql);
        $stmt->execute([$classid]);
        // set the resulting array to associative
        $stmt->setFetchMode(PDO::FETCH_ASSOC);
        $students = $stmt->fetchAll();
        $students = array_column($students, 'studentid');
        $total_failure = 0;

        foreach ($students as $student) {
            $failure = 0;
            $per = $this->getStudentRecord($student);
            foreach ($per as $value) {
                if ($value['percentage'] < 40) {
                    $failure++;
                }
            }
            if ($failure > 1)
                $total_failure++;
        }

        return $total_failure ;
    }

    public function getStudentRecord($id)
    {

        $sql = 'SELECT ((s3.marks*100)/s2.maxmarks) as percentage FROM students s1 join subjects s2 on s1.classid = s2.classid JOIN results s3 on s2.subjectid = s3.subid and s3.studentid = ? and s1.studentid = ? JOIN class s4 on s1.classid = s4.classid';
        $stmt = $this->db->prepare($sql);
        $stmt->execute([$id, $id]);
        // set the resulting array to associative
        $stmt->setFetchMode(PDO::FETCH_ASSOC);
        return $stmt->fetchAll();
    }
}
