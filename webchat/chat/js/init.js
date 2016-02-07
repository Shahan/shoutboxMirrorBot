function init_profile()
{
	$.ajax({
			type: "POST",
			url: "chat/profile.php",
			data: "request=init",
			success: function(html) {
				$("#user_panel").empty();
				$("#user_panel").append(html);
			}
		});
}
function init_username_room(room)
{
	$.ajax({
			type: "POST",
			url: "chat/profile.php",
			data: "request=username&room="+room,
			success: function(html) {
				$("#username_"+room).empty();
				$("#username_"+room).append(html);
			}
		});
}

function onTick()
{	
	load_msgs();
}