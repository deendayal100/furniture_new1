<!doctype html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
   
    
    <!--<link rel="stylesheet" href="css/style.css">-->
    <!------ Include the above in your HEAD tag ---------->
    <title>Messages</title>

    <script src="https://www.gstatic.com/firebasejs/8.7.0/firebase-app.js"></script>

    <script src="https://www.gstatic.com/firebasejs/8.7.0/firebase-database.js"></script>
    <!-- TODO: Add SDKs for Firebase products that you want to use
     https://firebase.google.com/docs/web/setup#available-libraries -->
   <script src="https://www.gstatic.com/firebasejs/8.7.0/firebase-analytics.js"></script> 
    <!-- Add Firebase products that you want to use -->
    <script src="https://www.gstatic.com/firebasejs/8.7.0/firebase-auth.js"></script>
    <script src="https://www.gstatic.com/firebasejs/8.7.0/firebase-firestore.js"></script>
    <script>

        // Your web app's Firebase configuration
        // For Firebase JS SDK v7.20.0 and later, measurementId is optional
        var firebaseConfig = {
            apiKey: "AIzaSyDuc6dwzr5h03IJu0YmWlgA6E5kgeHNIto",
            authDomain: "audition-bd459.firebaseapp.com",
            projectId: "audition-bd459",
            storageBucket: "audition-bd459.appspot.com",
            messagingSenderId: "305394851944",
            appId: "1:305394851944:web:97b69e9d388a7e28d91bdd",
            measurementId: "G-9YZ08MNW98"
        };
        // Initialize Firebase
        // var myName = prompt("Enter your name");
        firebase.initializeApp(firebaseConfig);
        
    </script>
    <script>
        var msgRef=firebase.database().ref("messages");
       
        $(document).ready(function(){
            

            $("#submit").on('submit',function(e){
                e.preventDefault()
                //alert('message');
               // return false;
                var message = $("#message").val();

            // save in database
            var w = (new Date()).toDateString("YYYY-MM-DD")
            var today = new Date();

            var time = today.getHours() + ":" + today.getMinutes() + ":" + today.getSeconds();
            var dateTime = w.slice(4, 10) + ' ' + time;
            msgRef.push().set({
                "sender_id": '<?php echo $admin_firebase_id; ?>',
                "sender": 'vinod',
                "receiver_id": 'fda7c752e45f20a43',
                "message": message,
                "time": dateTime,
            });
            $("#message").val('');
            // prevent form from submitting
            //window.location="http://127.0.0.1/your_audition/chat_a?q={{$query}}";
            });

              $('input').keyup(function(event) {
                    if (event.which === 13)
                    {
                        event.preventDefault();
                        $('form').submit();
                    }
                });  
            
        });
        
    </script>
   
    <script>
        // listen for incoming messages
        firebase.database().ref("messages").orderByKey().on("child_added", function(snapshot) {
            var html = "";
            var html1 = "";
            // give each message a unique ID
           
            // show delete button if message is sent by me
            if (snapshot.val().sender_id == '<?php echo $admin_firebase_id; ?>' && snapshot.val().receiver_id == 'fda7c752e45f20a43') {
              
                html += "<div class='send_msg'> <div class='send_msg_img'> </div><div class='send_msg' ><div class='send_withd_msg'><p class='msg-para' id='message-" + snapshot.key + "'>";
                html += snapshot.val().message;
                html += "</p><br/>";
                html += "<span class='send_time_date'>";
                html += snapshot.val().time
                html += "</span></div></div></div>";
                // console.log(snapshot.val());
                // console.log('send');
            }else if (snapshot.val().sender_id =='{{$query}}' && snapshot.val().receiver_id == '{{ $user->firebase_id }}') {
                
                html += "<div class='incoming_msg'><div class='incoming_msg_img'> </div><div class='received_msg'><div class='received_withd_msg'><p id='message-" + snapshot.key + "'>";
                html += snapshot.val().message;
                html += "</p><br/>";
                html += "<span class='time_date'>";
                html += snapshot.val().time
                html += "</span></div></div></div>";
                // console.log(snapshot.val());
                 console.log('recive');
            }

            
            //console.log(html1);
            

            document.getElementById("messages_r").innerHTML += html;
            // for auto scrolling
             $("#messages_r").scrollTop(9999);
            // document.getElementById("messages_rec").innerHTML += html1;
        });

        function deleteMessage(self) {
            // get message ID
            var messageId = self.getAttribute("data-id");

            // delete message
            firebase.database().ref("messages").child(messageId).remove();
        }

        // attach listener for delete message
        firebase.database().ref("messages").on("child_removed", function(snapshot) {
            // remove message node
            document.getElementById("message-" + snapshot.key).innerHTML = "This message has been removed";
        });
    </script>
    
</head>

<body>
    
    
    <section>
        <div class="container">
            <div class="messaging">
                <div class="inbox_msg">
                    <div class="inbox_people">
                        <div class="headind_srch">
                            <div class="recent_heading">
                                <h4>Messaging</h4>
                            </div>

                            
                        </div>
                        
                    </div>
                    <div class="mesgs1">
                        

                        <div class="msg_history" id="messages_r">

                        </div>

                        <div class="type_msg">
                            <div class="input_msg_write">

                                <form id="submit">
                                    <input id="message" name="comment" form="usrform">
                                    <button class="msg_send_btn" type="submit">
                                        SEND</button>
                                </form>

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
   
    
</body>

</html>
<!-- Button to Open the Modal -->
<!-- The Modal -->
