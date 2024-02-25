<?php 
     while($row = mysqli_fetch_assoc($sql)){
        $sql2 = "SELECT * FROM messages WHERE (incoming_msg_id = {$row['unique_id']}
                OR outgoing_msg_id = {$row['unique_id']}) AND (outgoing_msg_id = {$outgoing_id} 
                OR incoming_msg_id = {$outgoing_id}) ORDER BY msg_id DESC LIMIT 1";
        $query2 = mysqli_query($conn, $sql2);
        // Check if query executed successfully
        if($query2){
            // Check if there are rows returned
            if(mysqli_num_rows($query2) > 0){
                $row2 = mysqli_fetch_assoc($query2);
                $result = $row2['msg']; 
            } else {
                $result = "No message available";
            }
        } else {
            // Handle query error
            $result = "Error retrieving message";
        }
        
        //trimming the message if the word are more than 28
        (strlen($result) > 20) ? $msg = substr($result, 0, 20).'...' : $msg = $result;
        
        //Adding you: text if you have sent the message
        // Check if $row2 is set and not null
        if(isset($row2) && $row2 != null) {
            ($outgoing_id == $row2['outgoing_msg_id']) ? $you = "You: " : $you = "";
        } else {
            $you = "";
        }

        // $row2 = mysqli_fetch_assoc($query2);
        // if(mysqli_num_rows($query2) > 0){
        //     $result = $row2['msg']; 
        // }else{
        //     $result = "No message available";
        // }            

        // //trimming the message if the word are more than 28
        // (strlen($result) > 20) ? $msg = substr($result, 0, 20).'...' : $msg = $result;
        // //Adding you: text if you have sent the message
        // ($outgoing_id == $row2['outgoing_msg_id']) ? $you = "You: " : $you = "";

        //check user is offline or online
        ($row['status'] === "Offline now") ? $offline = "offline" : $offline = "";

        $output .= '<a href="chat.php?user_id='.$row['unique_id'].'">
                    <div class="content">
                    <img src="php/images/' . $row['img'] . '" alt="">
                        <div class="details">
                            <span>'. $row['fname'] . " " . $row['lname'] .'</span>
                            <p>'. $you . $msg .'</p>
                        </div>
                        <div class="status-dot '.$offline.'"><i class="fas fa-circle"></i></div>
                    </div>
                    </a>';
    }
?>