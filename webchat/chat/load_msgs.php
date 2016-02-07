<?php
/* 
	github.com/Shahan/ars-chat
	chat/load_msgs.php : returns msgs from DB depending on room, which sent by ajax request
*/
//connect to DB
include("bd.php");
//Take all msgs


$res=mysql_query("SELECT * FROM `messages` ORDER BY `id` ");
while($d=mysql_fetch_array($res))
{	
	if($d['room']==strval(1)) echo "<b><font color='orange'>".$d['from'].":&nbsp;</font></b>".$d['message']."<br>";
}
?>