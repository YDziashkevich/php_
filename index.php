<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title>Calendar</title>
        <style type="text/css">
        
        body {
            margin-top: 0px;
            margin-right: auto;
            margin-bottom: 0px;
            margin-left: auto;
            font-family:'Times New Roman', Times, serif;
            font-size:20px; 
            width:800px;
            text-align: center;
        }
        table {
            font-family:'Times New Roman', Times, serif;
            font-size:20px;
            border-collapse: collapse; 
            width: 800px; 
            text-align: center;
        }
        td, tr{
            border: 1px solid black;
            padding: 4px;
        }       
</style>
    </head>
    <body>
        <div class="main_">
    <?php 
        function getCalendar($month = null, $year = null){ 
        date_default_timezone_set('UTC');
        $weekDays=array(1=>"Monday", "Tuesday", "Wednesday", "Thursday", "Friday", "Saturday", "Sunday");
        $currentMonth=array(1=>"January", "February", "March", "April", "May", "June", "July", "August", "September", "October", "November", "December");
        if($month == null) {
          $numMonth=date(n);
        }
        else{
          $numMonth=$month;
        }
        if($year == null) {
          $curentYear=date(Y);
        }
        else{
          $curentYear=$year;
        }
        $numberDay=cal_days_in_month(CAL_GREGORIAN, $numMonth, $curentYear);
        $firstDayOfMonth = date("N", mktime(0, 0, 0, $numMonth, 1, $curentYear));
        $lastDayOfMonth = date("N", mktime(0, 0, 0, $numMonth, $numberDay, $curentYear));     
        $html="<p'> $currentMonth[$numMonth] \t $curentYear </p>";
        $html=$html. "<table>";
        $html=$html. "<tr class='bold_'>";
        foreach($weekDays as $value){
            $html=$html. "<td>$value</td>";
        }
        $html=$html. "</tr>";
        $html=$html. "<tr>";
        for($i=1; $i<$firstDayOfMonth; $i++){
            $html=$html. "<td></td>"; 
        }
        $j=1;
        for($i=$firstDayOfMonth; $i<=7;$i++){
            $html=$html. "<td>$j</td>";
            $j++;
        }
        $html=$html. "</tr>";
        while($j<=$numberDay){
           $html=$html. "<tr>";
            for($i=1; $i<=7; $i++){
                $html=$html. "<td>$j</td>";
                $j++;
                if($j>$numberDay){
                    break(1);
                }         
            }
            if($j>$numberDay AND $lastDayOfMonth<7){
                for($i=$lastDayOfMonth+1; $i<=7; $i++){
                    $html=$html. "<td></td>";
                }
            }
            $html=$html. "</tr>";
        }
        $html=$html. "</table>";
        return $html;
        }
    echo getCalendar($_GET["month"], $_GET["year"]);
    ?>
        </div>
    </body>
</html>