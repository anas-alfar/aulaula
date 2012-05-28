<?php
class Aula_Model_Pager extends Aula_Model_Default {

	public function pager ($table, $max ,$more_variables=""){
		if(!(isset($_GET['page'])))
		{
			$page=1;
		}
		else
		{
			$page=$_GET['page'];
		}
		
		$from=($max*$page)-$max;
		$sql_cond2="SELECT * FROM $table ORDER BY ID DESC LIMIT $from,$max";

		$sql = @mysql_query("SELECT * FROM $table");
		$num_sql = @mysql_num_rows($sql);

		$sql1 = @mysql_query("SELECT * FROM $table ORDER BY ID DESC LIMIT $from,$max") ;
		$num_sql1 = @mysql_num_rows($sql1);
		$pages=ceil($num_sql/$max);

		$resultHtml = array('','','','');

		if($page>1)
		{
			$prev=$page-1;
			$resultHtml[0] = '<a href="/'.$table.'/views/'.$more_variables.'page/'.$prev.'">prevoius...</a> ';
		}

		if ($page==$pages ){
			$i2=$page;
		} else {
			$i2=$page+5;
		}

		for($i=$page;$i<=$i2; $i++)
		{
			if($page==$i) {
				$resultHtml[1]= "[$i]";
				continue;
			}
				if ($i>$pages){
					break;
				}
			
				$resultHtml[2][] = '<a href="/'.$table.'/views/'.$more_variables.'page/'.$i.'">'.$i.'</a>';
		}

		if($page<$pages)
		{
			$next=$page+1;
			$resultHtml[3] ='<a href="/'.$table.'/views/'.$more_variables.'page/'.$next.'">..next</a>';
		}
		return $resultHtml;
	}
}
?>