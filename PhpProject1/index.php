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
        
        
        //название месяца и текущий год
        echo "<caption> $currentMonth \t $curentYear </caption>";
        //таблица календаря
        echo "<table border='1' style='border-collapse:collapse;' align='center'>";
        // вывод названия дней недели
        echo "<tr>";
        foreach($weekDays as $value){
            echo "<td>$value</td>";
        }
        echo "</tr>";
        // первая неделя месяца
        echo "<tr>";
        for($i=1; $i<$firstDayOfMonth; $i++){
            echo "<td></td>"; 
        }
        for($i=$firstDayOfMonth; $i<=7;$i++){
            $j=1;//числа месяца
            echo "<td>$j</td>";
            $j++;
        }
        echo "</tr>";
        //вывод оставшейся сетки календаря 
        
        while($j<=$numberDay){
            echo "<tr>";
            for($i=1; $i<=7; $i++){
                echo "<td>$j</td>";
                $j++;
                if($j>=$numberDay){
                    break(1);
                }
            }
            if($j>$numberDay AND $lastDayOfMonth<7){
                for($i=$lastDayOfMonth+1; $i<=7; $i++){
                    echo "<td></td>";
                }
            }
            echo "</tr>";
        }
        
        echo "</table>";
        
        
        ?>        
    </body>
</html>
