<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="style.css">
</head>

<body>
    
<?php

if(isset($_GET['month'])){
    $month=$_GET['month'];
}else{
    $month=date("m");
}
if(isset($_GET['year'])){
    $year=$_GET['year'];
    
}else{
    $year=date("Y");
}

if($month-1<1){
    $prevMonth=12;
    $prevYear=$year-1;
}else{
    $prevMonth=$month-1;
    $prevYear=$year;
}

if($month+1>12){
    $nextMonth=1;
    $nextYear=$year+1;
}else{
    $nextMonth=$month+1;
    $nextYear=$year;
}

$spDate=['2024-11-07'=>"立冬",
         '2024-06-10' => "端午節",
         '2024-09-17' => "中秋節",
         '2025-06-20' => "端午節",
         '2025-09-27' => "中秋節",
         '2026-06-30' => "端午節",
         '2026-10-07' => "中秋節",
         '2024-11-22'=>'小雪'];
$holidays = [
    '01-01' => "元旦",
    '02-10' => "農曆新年",
    '04-04' => "兒童節",
    '04-05' => "清明節",
    '05-01' => "勞動節",
    '10-10' => "國慶日"
];
?>
 <div class='nav'>
    <table style="width:100%">
        <tr>
            <td style='text-align:left'>
                <a href="">前年</a>
                <a href="calendar.php?year=<?=$prevYear;?>&month=<?=$prevMonth;?>"><</a>
            </td>
            <td>
                <?php echo date("{$year}年");?>
            </td>
            <td style='text-align:right'>
                <a href="calendar.php?year=<?=$nextYear;?>&month=<?=$nextMonth;?>">></a>
                <a href="">明年</a>
            </td>
        </tr>
            <td>
            <?php echo date("{$month}月");?>
        </td>
        </tr>
    </table>
</div>
<table>
<tr>
    <td></td>
    <td>Sun</td>
    <td>Mon</td>
    <td>Tue</td>
    <td>Wed</td>
    <td>Thu</td>
    <td>Fri</td>
    <td>Sat</td>
</tr>
<?php

$firstDay="{$year}-{$month}-1";
$firstDayTime=strtotime($firstDay);
$firstDayWeek=date("w",$firstDayTime);

for($i=0;$i<6;$i++){
    echo "<tr>";
    echo "<td>";
    echo $i+1;
    echo "</td>";
    for($j=0;$j<7;$j++){
        //echo "<td class='holiday'>";
        $cell=$i*7+$j -$firstDayWeek;
        $theDayTime=strtotime("$cell days".$firstDay);

        //所需樣式css判斷
        $theMonth=(date("m",$theDayTime)==date("m",$firstDayTime))?'':'grey-text';
        $isToday=(date("Y-m-d",$theDayTime)==date("Y-m-d"))?'today':'';
        $w=date("w",$theDayTime);
        $isHoliday=($w==0 || $w==6)?'holiday':'';
        
        echo "<td class='$isHoliday $theMonth $isToday'>";
        echo date("d",$theDayTime);
        if(isset($spDate[date("Y-m-d",$theDayTime)])){
            echo "<br>{$spDate[date("Y-m-d",$theDayTime)]}";
        }
        
        if(isset($holidays[date("m-d",$theDayTime)])){
            echo "<br>{$holidays[date("m-d",$theDayTime)]}";
        }

        echo "</td>";
        
    }
    echo "</tr>";
}



?>
</table>
</body>
</html>