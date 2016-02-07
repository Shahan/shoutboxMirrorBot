<? /*
	github.com/Shahan/ars-chat
	chat.php : main module, use include('chat.php'); to include it
*/?>
<link href="chat/css/rooms.css" rel="stylesheet" type="text/css" />
<link href="chat/css/tabs.css" rel="stylesheet" type="text/css" />

<!--include JQuery-->
<script src="chat/js/jquery.min.1.7.2.js"></script> 
<script src="chat/js/jTabs.js"></script> 
<script src="chat/js/init.js" type="text/javascript"></script>
<script src="chat/js/msgs.js" type="text/javascript"></script> 
<script> 
	$(document).ready(function(){     
		$("ul.tabs").jTabs({content: ".tabs_content", animate: true});                       
		}); 
</script>
<div class="wrap">
    <ul class="tabs">  
        <li class="active"><a href="#">Public room</a></li>
    </ul>  
    <div class="clear"></div>
    <div class="tabs_content">
        <div>
			<table width="100%">
				<tr><td>
					<div id="msgs_room"></div>
				</td></tr>
				<tr><td>
					<form action="javascript:send();">
						<input type="text" id="sender_name" placeholder="Name">(<i>guest</i>)
						<input type="text" id="sender_message" placeholder="Message">
						<input type="submit" value="Send">
					</form>
				</td></tr>
			</table>
		</div>
    </div><!-- tabs content -->
	
</div><!-- wrap -->



<script>
//Load msgs on page load
onTick();
//do it each 3 sec
setInterval(onTick,3000);
</script>
