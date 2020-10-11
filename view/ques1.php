<?php

use model\Common;
if (isset($_POST['submit'])) {
    $id = $_POST['stdId'] ?? 0;
    if($id !== 0){
    $common = new Common();
    $records = $common->getRecordByUserid($id);
    if(!empty($records)){
    $total = $common->getSubjectMarksByUserid($id);
    
    $percentile = $common->getUserPercentile($id);
    }else{
        $message = "record not found";
    }
    }else {
        $message = "record not found";
    }
  
}

?>

<br><br>
<form method="post" id="student">
    <p><?php echo $message ?? '';  ?></p>
    <p>Enter studentId : <input type="text" name="stdId" id="" placeholder="Enter StudentID" value='<?php echo $id ?? '' ;  ?>'></p>
    <p><input type="submit" name="submit" id="submit"></p>
</form>

<?php if(!empty($records)): ?>
<table border="1" align="center">
    <caption>Student Name : <?php  echo $records[0]['stdName'] ;?> <br>
    Student Id : <?php  echo $records[0]['studentid'] ;?> <br>
    Class Name : <?php  echo $records[0]['className'] ;?> <br>
</caption>
    <tr>
        
        <th width='200'>Subject</th>
        <th width='200'>MaxMarks</th>
        <th width='200'>Marks</th>
        <th width='200'>Percentage</th>
        <th width='200'>result</th>
    </tr>
    <?php $total_subject_marks = 0; $i= 0; foreach($records as $record):?>
    <tr>
        
        <td align="center" ><?php  echo $record['subName'] ;?></td>
        <td align="center"><?php  echo $record['maxmarks'] ;?></td>
        <td align="center"><?php  echo $record['marks'] ;?></td>
        <td align="center"><?php   $per = round($record['marks']/$record['maxmarks']*100,2) ?? 0  ; echo  $per . "%"?></td>
        <td align="center"><?php  if($per < 40) {echo 'Fail'; $i++;} else { echo  'Pass' ; } ?></td>
    </tr>
    <?php $total_subject_marks += $record['maxmarks'] ; endforeach; ?>

    <tr>
<td  colspan="2" align="center" >TOTAL</td><td align="center"><?php  ;echo $total['total_marks'] ?? 0 ?></td>
<td></td>
<td></td>
    </tr>


    <tr>
<td  colspan="2" align="center" >PERCENTAGE</td><td align="center"><?php  ;echo round(($total['total_marks']/$total_subject_marks)*100,2) . "%" ?? 0 ?></td>
<td></td>
<td></td>
</tr>
<tr>
<td  colspan="2" align="center" >PERCENTILE</td><td align="center"><?php echo round($percentile) . "%" ?? 0 ?></td>
<td></td>
<td></td>
    </tr>
    <tr>
<td  colspan="2" align="center" >TOTAL RESULT</td><td align="center"><?php echo  ($i == 2) ? "FAIL" : "PASS" ?></td>
<td></td>
<td></td>
    </tr>
</table>
    <?php  endif; ?>
<br>