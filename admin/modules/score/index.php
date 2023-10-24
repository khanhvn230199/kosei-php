<?
$sub = $stdio->GET("sub", "default");
$act = $stdio->GET("act", "default");
$clsModule = new Module("score");
$clsModule->run($sub, $act);

$assign_list["sub"] = $sub;
$assign_list["act"] = $act;
