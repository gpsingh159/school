SELECT s1.studentid, s1.name as stdName , s2.subjectid ,s2.name as subName , s2.maxmarks , s3.marks , s4.name as className FROM students s1 join subjects s2 on s1.classid = s2.classid  JOIN  results s3 on s2.subjectid  = s3.subid and s3.studentid = 1 and s1.studentid =1 JOIN class s4 on s1.classid = s4.classid

first run this
set GLOBAL sql_mode = (SELECT REPLACE(@@sql_mode,'ONLY_FULL_GROUP_BY' ,'' ))

SELECT s1.studentid , s1.name , SUM(s2.marks) as total FROM students s1 JOIN results s2 on s1.studentid = s2.studentid where s1.classid = 1 GROUP by s2.studentid


SELECT s1.studentid , s1.name , SUM(s2.marks) as total FROM students s1 JOIN results s2 on s1.studentid = s2.studentid where s1.classid = 3 GROUP by s2.studentid ORDER by total DESC LIMIT 0 , 10

SELECT s1.subjectid , r1.marks , s1.name , AVG(r1.marks) as avgMarks FROM subjects s1 join results r1 on r1.subid = s1.subjectid and s1.classid = 1 GROUP by s1.subjectid

total faliure
SELECT s1.studentid, s1.name as stdName , s2.name as subName , s2.maxmarks , s3.marks , ((s3.marks*100)/s2.maxmarks) as percentage, s4.name as className FROM students s1 join subjects s2 on s1.classid = s2.classid JOIN results s3 on s2.subjectid = s3.subid and s3.studentid = 1 and s1.studentid =1 JOIN class s4 on s1.classid = s4.classid

SELECT * FROM `students` WHERE classid =1