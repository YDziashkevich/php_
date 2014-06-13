<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
<html>
    <head>
        <meta charset="UTF-8">
        <title>Календарь</title>
    </head>
    <body>
        <?php 
        date_default_timezone_set('UTC');
        
        $weekDays=array(1=>"Monday", "Tuesday", "Wednesday", "Thursday", "Friday", "Saturday", "Sunday");
        $currentMonth=date(F);//наименование месяца
        $numMonth=date(n);//наименование месяца
        $curentYear=date(Y);//год
        $currentDay=date(j);//день месяца
        $numberDay=date(t);//количество дней в текущем месяце
        $nuwWeekDay=date(N);//порядковый номер текущего дня недели
        $firstDayOfMonth = date("N", mktime(0, 0, 0, $numMonth, 1, $curentYear));//порядковый номер дня недели первого числа месяца
        $lastDayOfMonth = date("N", mktime(0, 0, 0, $numMonth, $numberDay, $curentYear));//порядковый номер дня недели последнего числа месяца
        $html=" ";
        
        
        //название месяца и текущий год
        $html="<caption> $currentMonth \t $curentYear </caption>";
        //таблица календаря
        $html=$html. "<table border='1' style='border-collapse:collapse;' align='center'>";
        // вывод названия дней недели
       $html=$html. "<tr>";
        foreach($weekDays as $value){
            $html=$html. "<td>$value</td>";
        }
        $html=$html. "</tr>";
        // первая неделя месяца
        $html=$html. "<tr>";
        for($i=1; $i<$firstDayOfMonth; $i++){
            $html=$html. "<td></td>"; 
        }
        for($i=$firstDayOfMonth; $i<=7;$i++){
            $j=1;//числа месяца
            $html=$html. "<td>$j</td>";
            $j++;
        }
        $html=$html. "</tr>";
        //вывод оставшейся сетки календаря 
        
        while($j<=$numberDay){
           $html=$html. "<tr>";
            for($i=1; $i<=7; $i++){
                $html=$html. "<td>$j</td>";
                $j++;
                if($j>=$numberDay){
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
        echo $html;
        
        ?>        
    </body>
</html>