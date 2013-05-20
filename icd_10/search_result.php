 <link rel="stylesheet" type="text/css" href="../health4all.css">
<?php  
$search_code = $_POST['search_code'];
$word_array = explode(' ', $search_code);
$num= count($word_array);
$j=1; 
if($num>1){
for($i=0; $i<$num; $i++){
if(strlen($word_array[$i])>2){
if($j==1){ $word_search = "(code_title LIKE '%$word_array[$i]%')"; }
else { $word_search = $word_search . " AND (code_title LIKE '%$word_array[$i]%')"; }
$j++;}
}
$word_search= "OR (".$word_search.")";
} else {
$word_search=""; }

 include("../db_connect.php");
 mysql_connect("$dbhost","$dbuser","$dbpass");
 mysql_select_db("$dbdatabase");

 function highlight($word, $result) {
 $array = explode(' ', $word);
 $num= count($array);
	for($i=0; $i<$num; $i++){
		if(strlen($array[$i])>2){
			$result = str_ireplace($array[$i], '<b style="color:red;">'.$array[$i].'</b>', $result);
		}
	}
 return $result;
 }

 if(strlen($search_code)>'3'){
 $viewquery = "SELECT * 
			FROM icd_code 
			INNER JOIN icd_block ON icd_code.block_id=icd_block.block_id
			INNER JOIN icd_chapter ON icd_block.chapter_id=icd_chapter.chapter_id
			WHERE ((code_title LIKE '%".$search_code."%') ".$word_search.")";
			
 $result = mysql_query($viewquery);
 if(mysql_num_rows($result)!= 0) {
 echo "<table id=\"table-icd\" width=\"1000px\">";
 echo "<thead>";
 echo "<tr><th>ICD 10</th><th>CODE</th><th>BlOCK</th><th>CHAPTER</th></tr>";
 echo "</thead>";
 echo "<tbody>";
 while ($record = mysql_fetch_array($result)){
 $icd=$record['icd_10'];
 $icd_ext=$record['icd_10_ext'];
 $id=$icd.".".$icd_ext;
 echo "<td><input type=button value=" . $id . " onclick=\"return icd_1(this.value);\"></td>";
 echo "<td>".highlight($search_code, $record['code_title'])."</td>";
 echo "<td>".$record['block_title']."</td>";
 echo "<td>".$record['chapter_title']."</td></tr>";
 }
 echo "</tbody>";
 echo "</table>";
 }
 else
 {
 Echo "<br><br><b style=\"color:red;\">No Matching Data</b>";
 }
 }
 ?>  