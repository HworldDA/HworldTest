<?php

function db_connect(){
    //Database server information
    
    $dbServer='xxxxx.db.10442849.hostedresource.com';
    $dbName='xxxxx';
    $dbUser='xxxx';
    $dbPwd='bigB@wse2';
    
    $dbCon=mysql_connect($dbServer,$dbUser,$dbPwd) or die('Could not connect to the server'.mysql_error());
    mysql_select_db($dbName,$dbCon);

}

function db_close(){
    
    mysql_close();
}

?>