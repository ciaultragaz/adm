<?php
class Calendar{      
    // Cria uma matriz contendo abreviações de dias da semana.
    public $daysOfWeek = array('Dom.','Seg.','Terç.','Qua.','Qui.','Sex.','Sáb.');
    public $daysOfWeekNoAbr = array('Domingo','Segunda','Terça','Quarta','Quinta','Sexta','Sábado');
        
   public function cal() {
        $month  = $this->month;
        $year   = $this->year;
        $workedDays = (isset($this->workedDays))  ? $this->workedDays : null;

        $E = new Eventos();
        $E->month    = $this->month;
        $E->year     = $this->year;
        $eventos = $E->getMonth();
   
        $holiday = '';
        // Qual é o primeiro dia do mês em questão?
        $firstDayOfMonth = mktime(0,0,0,$month,1,$year);
   
        // Quantos dias este mês contém?
        $numberDays = date('t',$firstDayOfMonth);
   
        // Recupere algumas informações sobre o primeiro dia do mês em questão.
        $dateComponents = getdate($firstDayOfMonth);
   
        // Qual é o valor do índice (0-6) do primeiro dia do mês em questão.
        $dayOfWeek = $dateComponents['wday'];
   
        //cabeçalho
        $calendar ="<div class=\"row\"><div class=\"col-sm-12 col-md-6\"><select id=\"month\">";
          for($i=1;$i<=12;$i++){
            $selected = ($i == $month) ?'selected':'';
              $calendar .= "<option value='".$i."' $selected>".str_pad($i, 2, "0", STR_PAD_LEFT)."</option>";
          }
          $calendar .= "</select></div><div class=\"col-sm-12 col-md-6\" style=\"text-align:right\"><select id=\"year\">";
          $before = date('Y', strtotime('-5 years'));
          for($i=$before;$i<=date("Y");$i++){
            $selected = ($i == $year) ?'selected':'';
            $calendar .= "<option value='".$i."' $selected>".$i."</option>";
          }
          $calendar .= "</select></div></div>";
        $calendar .= "<table class='calendar'>";
        //$calendar .= "<caption>$year</caption>";
        $calendar .= "<tr>";
   
        // Cria os cabeçalhos do calendário
   
        foreach($this->daysOfWeek as $day) {
             $calendar .= "<th class='header'>$day</th>";
        } 
   
        /* Cria o resto do calendário
           Inicia o contador de dias, começando com o 1º. */
   
        $currentDay = 1;
   
        $calendar .= "</tr><tr>";
   
        /* A variável $dayOfWeek é usada para
           garantir que o calendário
           display consiste em exatamente 7 colunas. */
   
        if ($dayOfWeek > 0) { 
            for($i=0;$i<$dayOfWeek;$i++){
                $calendar .= "<td class=\"no-day\">&nbsp;</td>";
            }             
        }
   
        $month = str_pad($month, 2, "0", STR_PAD_LEFT);
   
        while ($currentDay <= $numberDays) {

             if ($dayOfWeek == 7) {
                  $dayOfWeek = 0;
                  $calendar .= "</tr><tr>";
             }
             $currentDayRel = str_pad($currentDay, 2, "0", STR_PAD_LEFT);
             $date = "$year-$month-$currentDayRel";
             if(isset($eventos[$date])){
                foreach ($eventos[$date] as $k => $v) {
                  if($v['idRef']==13){
                    $holiday = "<div class=\"holiday colorGreen\"></div>";
                  }                  
                  if($v['idRef'] == 18 && $v['idFuncionario'] == $this->idFuncionario){
                    $free = "<div class=\"holiday colorOrange\"></div>";
                  }
                }
             } else {
               $holiday = '';
               $free = '';
             }
             $textDanger = ($dayOfWeek==0) ? "text-danger" : "" ;
             //$currentDay = "<div>$currentDay</div>";
             $currentDay = str_pad($currentDay, 2, "0", STR_PAD_LEFT);
             if( count($workedDays) > 0 ){
                $key = in_array($date, $workedDays);
                $class = (false !== $key) ? 'day-work' : 'day';
                $calendar .= "<td class='$class $textDanger' rel='$date'><div class=\"eventos\">".$holiday.$free."</div><div class=\"current-day\">".$currentDay."</div></td>";
             } else {
                $calendar .= "<td class='day $textDanger' rel='$date'><div class=\"eventos\">".$holiday.$free."</div><div class=\"current-day\">".$currentDay."</div></td>";
             }
             $currentDay++;
             $dayOfWeek++;
             $holiday ='';
             $free = '';
        }
        // Preencha a linha da última semana do mês, se necessário
        if ($dayOfWeek != 7) {
             $remainingDays = 7 - $dayOfWeek;
             for($i=0;$i<$remainingDays;$i++){
                $calendar .= "<td class=\"no-day\"></td>"; 
            }         
        }   
        $calendar .= "</tr>";
        $calendar .= "</table>";

        $feriados = array();
        foreach ($eventos as $key => $value) {
          if(isset($value['idRef'])){
            if($value['idRef']==13){
              $feriados[] .="<li>".$value['dataEvento']." ".$value['evento']."</li>";
            }
          }          
        }
        
        if(count($feriados)){
          $calendar .="<div class=\"divEventos\">";
          $calendar .="<h5>Feriados</h5>";
          $calendar .="<ul>";
            foreach ($feriados as $key => $value) {
              $calendar .= $value;
            }
          $calendar .="</ul>";
          $calendar .="</div>";
        }        

        return $calendar;
   }
   public function calendarDayOff() {
    $month  = $this->month;
    $year   = $this->year;
    $daysOff = (isset($this->daysOff))  ? $this->daysOff : null;

    // Qual é o primeiro dia do mês em questão?
    $firstDayOfMonth = mktime(0,0,0,$month,1,$year);

    // Quantos dias este mês contém?
    $numberDays = date('t',$firstDayOfMonth);

    // Recupere algumas informações sobre o primeiro dia do mês em questão.
    $dateComponents = getdate($firstDayOfMonth);

    // Qual é o valor do índice (0-6) do primeiro dia do mês em questão.
    $dayOfWeek = $dateComponents['wday'];

    //cabeçalho
    $calendar ="<div class=\"row\"><div class=\"col-sm-12 col-md-6\"><select id=\"month\" class=\"custom-select custom-select-sm form-control form-control-sm\">";
      for($i=1;$i<=12;$i++){
        $selected = ($i == $month) ?'selected':'';
          $calendar .= "<option value='".$i."' $selected>".str_pad($i, 2, "0", STR_PAD_LEFT)."</option>";
      }
      $calendar .= "</select></div><div class=\"col-sm-12 col-md-6\" style=\"text-align:right\"><select id=\"year\" class=\"custom-select custom-select-sm form-control form-control-sm\">";
      $before = date('Y', strtotime('-5 years'));
      for($i=$before;$i<=date("Y");$i++){
        $selected = ($i == $year) ?'selected':'';
        $calendar .= "<option value='".$i."' $selected>".$i."</option>";
      }
      $calendar .= "</select></div></div>";
    $calendar .= "<table class='calendar'>";
    //$calendar .= "<caption>$year</caption>";
    $calendar .= "<tr>";

    // Cria os cabeçalhos do calendário

    foreach($this->daysOfWeek as $day) {
         $calendar .= "<th class='header'>$day</th>";
    } 

    /* Cria o resto do calendário
       Inicia o contador de dias, começando com o 1º. */

    $currentDay = 1;

    $calendar .= "</tr><tr>";

    /* A variável $dayOfWeek é usada para
       garantir que o calendário
       display consiste em exatamente 7 colunas. */

    if ($dayOfWeek > 0) { 
        for($i=0;$i<$dayOfWeek;$i++){
            $calendar .= "<td class=\"no-day\">&nbsp;</td>";
        }             
    }

    $month = str_pad($month, 2, "0", STR_PAD_LEFT);

    while ($currentDay <= $numberDays) {

         if ($dayOfWeek == 7) {
              $dayOfWeek = 0;
              $calendar .= "</tr><tr>";
         }
         $currentDayRel = str_pad($currentDay, 2, "0", STR_PAD_LEFT);             
         $date = "$year-$month-$currentDayRel";
         $textDanger = ($dayOfWeek==0) ? "text-danger" : "" ;
         $currentDay = str_pad($currentDay, 2, "0", STR_PAD_LEFT);
         if($dayOfWeek==0){
          $domingos[] = $currentDay;
         }         
         if( isset($daysOff[$date]['date']) ) {                        
            $qtd = $daysOff[$date]['qtd'];
            $ballOff = (isset($daysOff[$date]['date'])) ? "<div class=\"ballOff\">".$qtd."</div>" : "";

            $calendar .= "<td class='day' rel='$date' data-day='$currentDay'><div class=\"eventos\"></div><div class=\"current-day\">".$ballOff."<a class=\"clickDay $textDanger\" href=\"javascript:filterByDay('$date')\">".$currentDay."</a></div></td>";
         } else {
            $calendar .= "<td class='day' rel='$date' data-day='$currentDay'><div class=\"eventos\"></div><div class=\"current-day\"><a class=\"clickDay $textDanger\" href=\"javascript:filterByDay('$date')\">".$currentDay."</a></div></td>";
         }
         $currentDay++;
         $dayOfWeek++;
    }
    // Preencha a linha da última semana do mês, se necessário
    if ($dayOfWeek != 7) {
         $remainingDays = 7 - $dayOfWeek;
         for($i=0;$i<$remainingDays;$i++){
            $calendar .= "<td class=\"no-day\"></td>"; 
        }         
    }   
    $calendar .= "</tr>";
    $calendar .= "</table>";
    //$calendar .="<script>var domingos = [".implode($domingos,',')."]; getFuncionarioFolgas();</script>";

    return $calendar;
   }
   public function calendarList() {
    $month  = $this->month;
    $year   = $this->year;

    $firstDayOfMonth = mktime(0,0,0,$month,1,$year);
   
    // Quantos dias este mês contém?
    $numberDays = date('t',$firstDayOfMonth);

    // Recupere algumas informações sobre o primeiro dia do mês em questão.
    $dateComponents = getdate($firstDayOfMonth);
        // Qual é o valor do índice (0-6) do primeiro dia do mês em questão.
    $dayOfWeek = $dateComponents['wday'];
    $currentDay = 1;

    $month = str_pad($month, 2, "0", STR_PAD_LEFT);

    while ($currentDay <= $numberDays) {

      if ($dayOfWeek == 7) {
           $dayOfWeek = 0;
      }
      $currentDayRel = str_pad($currentDay, 2, "0", STR_PAD_LEFT);

      $date = "$year-$month-$currentDayRel";

      $calendar[$currentDay]['day'] = $currentDayRel;
      $calendar[$currentDay]['completeDay'] = $date;
      $calendar[$currentDay]['dayOfWeek'] = $this->daysOfWeekNoAbr[$dayOfWeek];
      $calendar[$currentDay]['dayOfWeekNumber'] = $dayOfWeek;
     
      $currentDay++;
      $dayOfWeek++;
    }

    return $calendar;

   }
   public function getNumberWeek(){
     $date = $this->date;
     $o = new DateTime($date);
     return $week = $o->format("W");
   }
   public function month(){
      $month  = $this->month;
      $year   = $this->year;
      $workedDays = (isset($this->workedDays))  ? $this->workedDays : null;

      $E = new Eventos();
      $E->month         = $this->month;
      $E->year          = $this->year;
      $E->onlyFeriados  = true ;
      $eventos = $E->getMonth();
 
      $nameMonths = Util::meses();

      $diasUteis = 0;

      $holiday = '';
      // Qual é o primeiro dia do mês em questão?
      $firstDayOfMonth = mktime(0,0,0,$month,1,$year);
 
      // Quantos dias este mês contém?
      $numberDays = date('t',$firstDayOfMonth);
 
      // Recupere algumas informações sobre o primeiro dia do mês em questão.
      $dateComponents = getdate($firstDayOfMonth);
 
      // Qual é o valor do índice (0-6) do primeiro dia do mês em questão.
      $dayOfWeek = $dateComponents['wday'];
 
      //cabeçalho
      $calendar .= "<div class=\"col-sm-3\"><div class=\"card\"><div class=\"card-header\"><h5>".$nameMonths[$month]." ".$year."</h5></div><div class=\"card-body\"><table class='calendar'>";
      //$calendar .= "<caption>$year</caption>";
      $calendar .= "<tr>";
 
      // Cria os cabeçalhos do calendário
 
      foreach($this->daysOfWeek as $day) {
           $calendar .= "<th>$day</th>";
      } 
 
      /* Cria o resto do calendário
         Inicia o contador de dias, começando com o 1º. */
 
      $currentDay = 1;
 
      $calendar .= "</tr><tr>";
 
      /* A variável $dayOfWeek é usada para
         garantir que o calendário
         display consiste em exatamente 7 colunas. */
 
      if ($dayOfWeek > 0) { 
          for($i=0;$i<$dayOfWeek;$i++){
              $calendar .= "<td class=\"no-day\">&nbsp;</td>";
          }             
      }
 
      $month = str_pad($month, 2, "0", STR_PAD_LEFT);
 
      while ($currentDay <= $numberDays) {

           if ($dayOfWeek == 7) {
                $dayOfWeek = 0;
                $calendar .= "</tr><tr>";
           }
           $currentDayRel = str_pad($currentDay, 2, "0", STR_PAD_LEFT);
           $date = "$year-$month-$currentDayRel";
           if(isset($eventos[$date])){
              foreach ($eventos[$date] as $k => $v) {
                if($v['idRef']==13){
                  $holiday = "<div class=\"feriado\" data-container=\"body\" data-toggle=\"popover\" data-placement=\"top\" data-content=\"".$v['evento']."\"></div>";
                }
              }
           } else {
             $holiday = '';
             $free = '';
             if($dayOfWeek != 0 ){
              $diasUteis++;
            }                
           }
           $textDanger = ($dayOfWeek==0) ? "text-danger" : "" ;
           $currentDay = str_pad($currentDay, 2, "0", STR_PAD_LEFT);
           if( count($workedDays) > 0 ){              
              $key = in_array($date, $workedDays);
              $class = (false !== $key) ? 'day-work' : 'day';
              $calendar .= "<td class='$class' rel='$date'>".$holiday.$free."<div class=\"current-day\"><a href=\"javascript:void(0)\"class=\"$textDanger btnDay\" data-date=\"$date\">".$currentDay."</a></div></td>";
           } else {              
              $calendar .= "<td class='day' rel='$date'>".$holiday.$free."<div class=\"current-day\"><a href=\"javascript:void(0)\" class=\"$textDanger btnDay\" data-date=\"$date\">".$currentDay."</a></div></td>";
           } 
           $currentDay++;
           $dayOfWeek++;
           $holiday ='';
           $free = '';
      }
      // Preencha a linha da última semana do mês, se necessário
      if ($dayOfWeek != 7) {
           $remainingDays = 7 - $dayOfWeek;
           for($i=0;$i<$remainingDays;$i++){
              $calendar .= "<td class=\"no-day\"></td>"; 
          }         
      }   
      $calendar .= "</tr>";
      $calendar .= "</table>";
      $calendar .="<div class=\"labelMonth\">Dias Úteis: ".$diasUteis."</div>";
      $calendar .="</div></div></div>";

      

      $feriados = array();
      foreach ($eventos as $key => $value) {
        if(isset($value['idRef'])){
          if($value['idRef']==13){
            $feriados[] .="<li>".$value['dataEvento']." ".$value['evento']."</li>";
          }
        }          
      }
      
      if(count($feriados)){
        $calendar .="<div class=\"divEventos\">";
        $calendar .="<h5>Feriados</h5>";
        $calendar .="<ul>";
          foreach ($feriados as $key => $value) {
            $calendar .= $value;
          }
        $calendar .="</ul>";
        $calendar .="</div>";
      }        

      return $calendar;
   }
   public function calendar12x36(){

    //$initDay = isset($this->inittDay) ? $this->inittDay : null;
    $initDay = '2021-04-01';
    $initDay = '2021-04-10';
    $this->date = $initDay;
    //$ddate = "2012-10-18";
    $evenOddWeekUser = ($this->getNumberWeek() % 2) ? 0 : 1 ;

    $month  = $this->month;
    $year   = $this->year;
    $workedDays = (isset($this->workedDays))  ? $this->workedDays : null;

    $E = new Eventos();
    $E->month    = $this->month;
    $E->year     = $this->year;
    $eventos = $E->getMonth();

    $holiday = '';
    // Qual é o primeiro dia do mês em questão?
    $firstDayOfMonth = mktime(0,0,0,$month,1,$year);

    // Quantos dias este mês contém?
    $numberDays = date('t',$firstDayOfMonth);

    // Recupere algumas informações sobre o primeiro dia do mês em questão.
    $dateComponents = getdate($firstDayOfMonth);

    // Qual é o valor do índice (0-6) do primeiro dia do mês em questão.
    $dayOfWeek = $dateComponents['wday'];

    //cabeçalho
    $calendar ="<div class=\"row\"><div class=\"col-sm-12 col-md-6\"><select class=\"custom-select custom-select-sm form-control form-control-sm\" id=\"month\">";
      for($i=1;$i<=12;$i++){
        $selected = ($i == $month) ?'selected':'';
          $calendar .= "<option value='".$i."' $selected>".str_pad($i, 2, "0", STR_PAD_LEFT)."</option>";
      }
      $calendar .= "</select></div><div class=\"col-sm-12 col-md-6\" style=\"text-align:right\"><select id=\"year\" class=\"custom-select custom-select-sm form-control form-control-sm\">";
      $beforeYears = date('Y', strtotime('-5 years'));
      $afterYears = date('Y', strtotime('+10 years'));
      for($i=$beforeYears;$i<=$afterYears;$i++){
        $selected = ($i == $year) ?'selected':'';
        $calendar .= "<option value='".$i."' $selected>".$i."</option>";
      }
      $calendar .= "</select></div></div>";
    $calendar .= "<table class='calendar'>";
    $calendar .= "<tr>";

    // Cria os cabeçalhos do calendário    
    foreach($this->daysOfWeek as $day) {
         $calendar .= "<th class='header'>$day</th>";
    } 

    /* Cria o resto do calendário
       Inicia o contador de dias, começando com o 1º. */

    $currentDay = 1;
    $calendar .= "</tr><tr>";
    /* A variável $dayOfWeek é usada para
       garantir que o calendário
       display consiste em exatamente 7 colunas. */
    if ($dayOfWeek > 0) { 
      for($i=0;$i<$dayOfWeek;$i++){
        $calendar .= "<td class=\"no-day\">&nbsp;</td>";
      }             
    }

    $month = str_pad($month, 2, "0", STR_PAD_LEFT);
    $dayOdd = 1;
    $countDay = 0;
    $countFree = 0;
    while ($currentDay <= $numberDays) {
         if ($dayOfWeek == 7) {
              $dayOfWeek = 0;
              $calendar .= "</tr><tr>";
         }
         $currentDayRel = str_pad($currentDay, 2, "0", STR_PAD_LEFT);
         $date = "$year-$month-$currentDayRel";
         $this->date = $date;
         $numberWeek = $this->getNumberWeek();
         $weekOdd = ($numberWeek % 2) ? '0' : '1' ;

         if($evenOddWeekUser){
          $evenWeek = array(2=>2,4=>4,6=>6);
          $oddWeek  = array(1=>1,3=>3,5=>5,0=>0);
         } else {
          $evenWeek = array(1=>1,3=>3,5=>5,0=>0);
          $oddWeek  = array(2=>2,4=>4,6=>6);
         }
         if(isset($eventos[$date])){
            foreach ($eventos[$date] as $k => $v) {
              if($v['idRef']==13){
                $holiday = "<div class=\"holiday colorGreen\"></div>";
              }           
            }
          $free = '';
         } else {
           $holiday = '';
           $free = '';
         }
         $textDanger = ($dayOfWeek==0) ? " text-danger" : "" ;
         //$textSuccess = ($dayOfWeek );
         $typeWeek = ($weekOdd) ? $evenWeek : $oddWeek;
         $ox = (in_array($dayOfWeek, $typeWeek))?'ox':'not';
         if($ox=='ox'){
          $countDay++;
         } else {
           $countFree++;
         }
         $currentDay = str_pad($currentDay, 2, "0", STR_PAD_LEFT);  
         //if($dayOfWeek!=0){
          $calendar .= "<td class='day $ox$textDanger' rel='$date'><div class=\"eventos\">".$holiday.$free."</div><div class=\"current-day\">".$currentDay." </div></td>";
         //}
         
         $currentDay++;
         $dayOfWeek++;
         $free = '';
    }
    // Preencha a linha da última semana do mês, se necessário
    if ($dayOfWeek != 7) {
         $remainingDays = 7 - $dayOfWeek;
         for($i=0;$i<$remainingDays;$i++){
            $calendar .= "<td class=\"no-day\"></td>"; 
        }         
    }   
    $calendar .= "</tr>";
    $calendar .= "</table>";

    $feriados = array();
    foreach ($eventos as $key => $value) {
      if(isset($value['idRef'])){
        if($value['idRef']==13){
          $feriados[] .="<li>".$value['dataEvento']." ".$value['evento']."</li>";
        }
      }          
    }
    
    if(count($feriados)){
      $calendar .="<div class=\"divEventos\">";
      $calendar .="<h5>Feriados</h5>";
      $calendar .="<ul>";
        foreach ($feriados as $key => $value) {
          $calendar .= $value;
        }
      $calendar .="</ul>";
      $calendar .="</div>";
    }        
    $calendar .="<div class=\"diasUteis\">($countDay) dias úteis</div>";
    $calendar .="<div class=\"diasFolga\">($countFree) dias folgas</div>";

    //$calendar .= "Weeknummer: ".$this->getNumberWeek();
    //$salario = 1208.02;
    //$salario = 1208.02;
    //$periculosidade = 362.41;
    //$periculosidade = 362.41;
    //$salario = 11.41;
    //$periculosidade = 108.72;
    //$Inss = new Inss();
    //$inss = $Inss->getInss();
    //Util::pre(json_decode($inss['data']['tabela'],true));
    
    //$Inss->salario = ($salario+$periculosidade);
    //echo $Inss->getDiscounts();
    //echo '----------------------';

    return array('calendar'=>$calendar,'diasUteis'=>$countDay,'diasFolga'=>$countFree);
   }
}

