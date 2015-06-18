<?php

$host="localhost"; // Host name 
$username="anders"; // Mysql username 
$password=""; // Mysql password 
$db_name="test"; // Database name 
$tbl_name="forum_question"; // Table name 

// Connect to server and select databse.
mysql_connect("$host", "$username", "$password")or die("cannot connect"); 
mysql_select_db("$db_name")or die("cannot select DB");

// get value of id that sent from address bar 
$id=$_GET['id'];
$sql="SELECT * FROM $tbl_name WHERE id='$id'";
$result=mysql_query($sql);
$rows=mysql_fetch_array($result);


function word_reduce($str, $length, $replace = '<br/>') {
    
    $parts  = str_split($str, $length);

    foreach($parts as $index => $value) {
        
        $parts[$index] .= $replace;
        
    }

    return implode('', $parts);

}


?>

<a href="index.html"><img style="position:absolute; top:5px; left:350px;" src="http://localhost:8888/MAMP/images/ufaglrt_logo_main.jpg" alt="main logo home">

<a href="om_os.html"><img style="position:absolute; top:200px; left:350px;" src="http://localhost:8888/MAMP/images/om_os.png" alt="main logo home">

<a href="kontakt.html"><img style="position:absolute; top:200px; left:530px;" src="http://localhost:8888/MAMP/images/kontakt.png" alt="main logo home">

<a href="virksomhed.html"><img style="position:absolute; top:202px; left:703px;" src="http://localhost:8888/MAMP/images/virksomhed_small.png" alt="main logo home">

<a href="http://localhost:8888/MAMP/main_forum.php"><img style="position:absolute; top:202px; left:871px;" src="http://localhost:8888/MAMP/images/forum.png" alt="forum">





<table style="max-width: 600px; margin: 0px center;"  border="0" cellpadding="4" bgcolor="#CCCCCC">
<tr>
<td bgcolor="#F8F7F1"><strong><? echo $rows['topic']; ?></strong></td>
</tr>

<tr>
<td style="word-wrap: break-word; display: block; width:50px;" bgcolor="#F8F7F1"><? echo word_reduce($rows['detail'],300); ?></td>
</tr>

<tr>
<td bgcolor="#F8F7F1"><strong>By :</strong> <? echo $rows['name']; ?> <strong>Email : </strong><? echo $rows['email'];?></td>
</tr>

<tr>
<td bgcolor="#F8F7F1"><strong>Date/time : </strong><? echo $rows['datetime']; ?></td>
</tr>
</table></td>
</tr>
</table>
<BR>

<?php

$tbl_name2="forum_answer"; // Switch to table "forum_answer"
$sql2="SELECT * FROM $tbl_name2 WHERE question_id='$id'";
$result2=mysql_query($sql2);
while($rows=mysql_fetch_array($result2)){
?>

<table style="max-width: 600px;" border="0" align="center" cellpadding="0" cellspacing="1" bgcolor="#CCCCCC">
<tr>
<td><table border="0" cellpadding="3" cellspacing="1" bgcolor="#FFFFFF">
<tr>
<td bgcolor="#F8F7F1"><strong>ID</strong></td>
<td bgcolor="#F8F7F1">:</td>
<td bgcolor="#F8F7F1"><? echo $rows['a_id']; ?></td>
</tr>
<tr>
<td width="10" bgcolor="#F8F7F1"><strong>Name</strong></td>
<td width="10" bgcolor="#F8F7F1">:</td>
<td width="10" bgcolor="#F8F7F1"><? echo $rows['a_name']; ?></td>
</tr>
<tr>
<td bgcolor="#F8F7F1"><strong>Email</strong></td>
<td bgcolor="#F8F7F1">:</td>
<td bgcolor="#F8F7F1"><? echo $rows['a_email']; ?></td>
</tr>
<tr>
<td bgcolor="#F8F7F1"><strong>Answer</strong></td>
<td bgcolor="#F8F7F1">:</td>
<td bgcolor="#F8F7F1"><? echo $rows['a_answer']; ?></td>
</tr>
<tr>
<td bgcolor="#F8F7F1"><strong>Date/Time</strong></td>
<td bgcolor="#F8F7F1">:</td>
<td bgcolor="#F8F7F1"><? echo $rows['a_datetime']; ?></td>
</tr>
</table></td>
</tr>
</table><br>
 
<?php
}

$sql3="SELECT view FROM $tbl_name WHERE id='$id'";
$result3=mysql_query($sql3);
$rows=mysql_fetch_array($result3);
$view=$rows['view'];
 
// if have no counter value set counter = 1
if(empty($view)){
$view=1;
$sql4="INSERT INTO $tbl_name(view) VALUES('$view') WHERE id='$id'";
$result4=mysql_query($sql4);
}
 
// count more value
$addview=$view+1;
$sql5="update $tbl_name set view='$addview' WHERE id='$id'";
$result5=mysql_query($sql5);
mysql_close();
?>

<BR>
<table style="max-width: 600px;" border="0" align="center" cellpadding="0" cellspacing="1" bgcolor="#CCCCCC">
<tr>
<form name="form1" method="post" action="add_answer.php">
<td>
<table border="0" cellpadding="3" cellspacing="1" bgcolor="#FFFFFF">
<tr>
<td width="18%"><strong>Name</strong></td>
<td width="3%">:</td>
<td width="79%"><input name="a_name" type="text" id="a_name" size="45"></td>
</tr>
<tr>
<td><strong>Email</strong></td>
<td>:</td>
<td><input name="a_email" type="text" id="a_email" size="45"></td>
</tr>
<tr>
<td valign="top"><strong>Answer</strong></td>
<td valign="top">:</td>
<td><textarea name="a_answer" cols="45" rows="3" id="a_answer"></textarea></td>
</tr>
<tr>
<td>&nbsp;</td>
<td><input name="id" type="hidden" value="<? echo $id; ?>"></td>
<td><input type="submit" name="Submit" value="Submit"> <input type="reset" name="Submit2" value="Reset"></td>
</tr>
</table>
</td>
</form>
</tr>
</table>