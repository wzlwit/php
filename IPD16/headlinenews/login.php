<?php

require('./includes/function.php');



// if ($_SERVER['REQUEST_METHOD'] == "POST"){

//     //start logger
//     // DEBUG (100): Detailed debug information.

//     // INFO (200): Interesting events. Examples: User logs in, SQL logs.
    
//     // NOTICE (250): Normal but significant events.
    
//     // WARNING (300): Exceptional occurrences that are not errors. Examples: Use of deprecated APIs, poor use of an API, undesirable things that are not necessarily wrong.
    
//     // ERROR (400): Runtime errors that do not require immediate action but should typically be logged and monitored.
    
//     // CRITICAL (500): Critical conditions. Example: Application component unavailable, unexpected exception.
    
//     // ALERT (550): Action must be taken immediately. Example: Entire website down, database unavailable, etc. This should trigger the SMS alerts and wake you up.
    
//     // EMERGENCY (600): Emergency: system is unusable.

//     //$log = new Logger('login_log');
//     // $log->pushHandler(new StreamHandler('./log/login_log.log',Logger::DEBUG));
//     // $log->info('Login attempt');


    

//    if(
//        isset($_POST['email'])&&
//        isset($_POST['password'])&&
//        $_POST['email']==''&&
//        $_POST['password']==''
//        )
//    {
//       //  $message='Please complete all the infomations!';

//  //log 
//    }
//    else if (
//     isset($_POST['email'])&&
//     isset($_POST['password'])&&
//     $_POST['email']!=''&&
//     $_POST['password']==''
//    )
//    {

//     // log $message='Please enter your PASSWORD!';
//    }

//    else if(
//     isset($_POST['email'])&&
//     isset($_POST['password'])&&
//     $_POST['email']==''&&
//     $_POST['password']!=''
//    )

//    {
//    // $message='Please enter your USER NAME!'; 
//    }
   
//    else 
//    {

//     $result=DB::queryFirstRow("SELECT * FROM account where email=%s limit 1",$_POST['email']);

// if($result['password']!=$_POST['password'])
// { $message='PASSWORD Not Correctly';

//   // $log->warning($_POST['username'].' wrong password');
// }
// else
// {
//     $_SESSION['user']=$result['username'];
//     $_SESSION['type']=$result['type'];
  
//   header('location:index.php');

// }
//    }

// }

$email = htmlspecialchars($_POST['email']);  
 
//获取AJAX提交过来的密码（安全起见做了安全过滤） 
$password = htmlspecialchars($_POST['password']); 
 
//判断输入的帐号密码是否正确（一般这里是从数据库获取数据来与提交的数据进行对比） 
$result=DB::queryFirstRow("SELECT * FROM account where email=%s limit 1",$email);

//$_SESSION['no']=$result['type'];

if($result['password'] == $_POST['password'])  
{ 
    //登录成功 返回code=1，logintime=时间为当前时间
  
    $msg = array("code"=>1,"logintime"=>date("Y-m-d H:i:s")); 
    $_SESSION['user']=$result['username']; 
    $_SESSION['type']=$result['type'];
} 
else 
{  
   //登录失败 返回code=2，logintime=时间为当前时间 
    $msg = array("code"=>2,"logintime"=>date("Y-m-d H:i:s")); 
} 
//将PHP数组转换成JSON格式数据，以便前台JS好接收返回值 
echo json_encode($msg);


?>