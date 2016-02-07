/*
	github.com/Shahan
	chat/js/msgs.js : functions for sending&loading messages
*/
	
	
//Function of loading msgs
function load_msgs()
{
	//load msgs
	$.ajax({
			type: "POST",
			url:  "chat/load_msgs.php",
			//Output php feedback
			success: function(html)
			{
				//Clear input box
				$("#msgs_room").empty();
				//Output php feedback
				$("#msgs_room").append(html);
				//scroll down
				$("#msgs_room").scrollTop(90000);
			}
		});
}
function send()
{
	//Get msg from input box with id mess_to_add
	var msg=$("#sender_message").val();
	var usrname=$("#sender_name").val();
	//Send parametrs
    $.ajax({
            type: "POST",
            url: "chat/add_msg.php",
            data: "user="+usrname+"&msg="+msg,
            // Output PHP feedback
            success: function(html)
			{
				//if successful, load msgs
				onTick();
				//clear input form
				$("#sender_message").val("");
            }
        });
}