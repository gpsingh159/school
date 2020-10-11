<?php

use model\Common;



if (isset($_POST['submit'])) {
    $id = $_POST['classid'] ?? 0;
    if ($id !== 0) {
        $common = new Common();
        $records = $common->getTop10UserClassById($id);
        if (!$records) {
            $message = "record not found";
        }
        $avgMarks = $common->avgMarksForEachSubject($id);
        $arrayMedian = array_column($avgMarks, 'avgMarks');
        $median = $common->medianClass($arrayMedian);
        $totalFailure = $common->getTotalFailureInClass($id);
    } else {
        $message = "record not found";
    }
}






?>

<br><br>
<form method="post" id="student">
    <p><?php echo $message ?? '';  ?></p>
    <p>Enter ClassId : <input type="text" name="classid" id="" placeholder="Enter StudentID" value='<?php echo $id ?? '';  ?>'></p>
    <p><input type="submit" name="submit" id="submit"></p>
</form>

<?php if (!empty($records)) : ?>
    <table border="1" align="center">
        <caption>
            Class Name : <?php echo $records[0]['className']; ?> <br>
        </caption>
        <tr>

            <th width='200'>Name</th>
            <th width='200'>MaxMarkr</th>
            <th width='200'>Marks</th>
            <th width='200'>Percentage</th>

        </tr>
        <?php $total_subject_marks = 0;
        $percent = [];
        foreach ($records as $record) : ?>
            <tr>

                <td align="center"><?php echo $record['name']; ?></td>
                <td align="center"><?php echo $record['maxmarks']; ?></td>
                <td align="center"><?php echo $record['marks']; ?></td>
                <td align="center"><?php $per = round($record['marks'] / $record['maxmarks'] * 100, 2) ?? 0;
                                    array_push($percent, $per);
                                    echo  $per . "%" ?></td>
            </tr>
        <?php $total_subject_marks += $record['maxmarks'];
        endforeach; ?>

        <tr>
            <td colspan="2">TOTAL NO Failure </td>
            <td align="center"> <?php echo $totalFailure ?></td>
            <td></td>
        </tr>

    </table>

    <br>

    <table border="1" align="center">
        <caption>
            Subject wise avg marks <br>
        </caption>
        <tr>

            <th width='200'>subjectId</th>
            <th width='200'>Name</th>
            <th width='200'>AvgMarsk</th>


        </tr>
        <?php $total_mean = 0;
        foreach ($avgMarks as $record) : ?>
            <tr>

                <td align="center"><?php echo $record['subjectid']; ?></td>
                <td align="center"><?php echo $record['name']; ?></td>
                <td align="center"><?php echo  $mark = round($record['avgMarks'], 2);
                                    $total_mean += $mark; ?></td>

            </tr>
        <?php endforeach; ?>

       
        <tr>
            <td colspan="2">Mean</td>
            <td align="center"><?php echo round($total_mean / count($avgMarks), 2); ?></td>
        </tr>
        <tr>
            <td colspan="2">Median</td>
            <td align="center"><?php echo round($median); ?></td>
        </tr>
    </table>
    <table border="1" align="center">
        <caption>
            NO of student greater than <br>
        </caption>
        <tr>

            <th width='200'>No of student </th>
            <th width='200'>Percentage Marks</th>
        </tr>
        <tr>
            <td align="center"><?php
                                echo $common->findGreaterNumberCount($percent, 90);
                                ?></td>
            <td>90%</td>
        </tr>
        <tr>
            <td align="center"><?php
                                echo $common->findGreaterNumberCount($percent, 80, 90);
                                ?></td>
            <td> >= 80% && < 90%</td> </tr> <tr>
            <td align="center"><?php
                                echo $common->findGreaterNumberCount($percent, 70, 80);
                                ?></td>
            <td> >= 70% && < 80%</td> </tr> <tr>
            <td align="center"><?php
                                echo $common->findGreaterNumberCount($percent, 50, 70);
                                ?></td>
            <td> >= 50% && < 70%</td> </tr> <tr>
            <td align="center"><?php
                                echo $common->findGreaterNumberCount($percent, 40, 50);
                                ?></td>
            <td> >= 40% && < 50%</td> </tr> <tr>
            <td align="center"><?php
                                echo $common->findGreaterNumberCount($percent, 1, 40);
                                ?></td>
            <td> 40%</td>
        </tr>

    </table>
<?php endif; ?>