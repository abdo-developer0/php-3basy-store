<?php

    ob_start();
    session_start();
    include 'temp/header.inc';
    // include 'db_connect.php';
    if(isset($_SESSION['admin'])) header('location:control.php');
    $admins = array(
        'Abasy' => 'abasy-admin',
        'dev'   => '88888888'
    );

    if($_SERVER['REQUEST_METHOD']=='POST'){
        foreach($admins as $user => $pass ){
            if($_POST['user']==$user && $_POST['pass']==$pass){
                $_SESSION['admin'] = array(
                    '-u'=>$user,
                    '-p'=>$pass
                );
                header('location:control.php?page=main');
            }
        }
    }
?>

    <div class="login">
        <h1>Log in</h1>
        <form method="POST">
            <input type="text" placeholder="Type Username" class="form-control" name="user"/>
            <input type="text" placeholder="Tpye Password" class="form-control" name="pass"/>
            <input type="submit" value="Log in Now" class="btn btn-primary" />
        </form>
    </div>

<?php
    include 'temp/footer.inc';
    ob_end_flush();
?>