<?php
$session=session_id();
$time=time();
$time_check=$time-180; //SET TIME 3 Minute
$countx=$getdata->my_sql_show_rows($connect,"user_online","osession='".$session."'");
if($countx=="0"){
@$sql1 = $getdata->my_sql_insert($connect,"user_online","osession='".$session."',user_key='".$_SESSION['ukey']."',otime='".$time."'");
@$on = $getdata->my_sql_query($connect,NULL,"user_online","user_key='".$_SESSION['ukey']."'");
}
else {
@$sql2 = $getdata->my_sql_update($connect,"user_online","user_key='".$_SESSION['ukey']."',otime='".$time."'","osession='".$session."'");
@$on = $getdata->my_sql_query($connect,NULL,"user_online","user_key='".$_SESSION['ukey']."'");
}
//
$count_user_online=$getdata->my_sql_show_rows($connect,"user_online","1");

//echo "User online : $count_user_online ";

// if over 1 minute, delete session
$getdata->my_sql_delete($connect,"user_online","otime < ".$time_check."");
//mysqli_close();

// Open multiple browser page for result
?>
