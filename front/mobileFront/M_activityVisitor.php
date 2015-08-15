<?php
error_reporting(E_ALL & ~E_NOTICE);
require_once('../../background/conf/connect.php');
$actId=8;//$_GET['actId'];

//查找活动信息
$aInfo=mysql_fetch_assoc(mysql_query("select * from society_act_open where actId='$actId'"));
//查询活动主办社团
$society=mysql_fetch_assoc(mysql_query("select sName,sSchool from society where sId='$aInfo[sId]'"));

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta name="viewport" content="width=device-width,minimum-scale=1.0,maximum-scale=2.0,initial-scale=1.0,user-scalable=no">
<title>社团详情</title>
<link href="M_css/M_activityVisitor.css" type="text/css" rel="stylesheet">
<script src="../js/jquery-1.11.1.js"></script>
</head>

<body>
<div class="top">
	<?php echo $aInfo['actName']?>
</div>
<div class="cover" id="cover">
	<img src="<?php echo $aInfo['actImg']?>"/>
</div>
<script>
	var coverWidth = $("#cover").width();
	$("#cover").height(coverWidth/1.76);
</script>

<div class="summary">
	<ul>
    	<li class="a">
            <em>正在进行</em>           
        	<p>当前状态</p>
        </li>
        <li class="b">
            <em><?php echo $aInfo['actFocusNum']?></em>
        	<p>关注人数</p>
        </li>
        <li class="c">
<?php
	if($aInfo['isApply']=='无需报名'){
?>
            <em>无需报名</em>
<?php
	}else{
?>
            <em><?php echo $aInfo['actNum']?></em>
<?php
	}
?>
        	<p>报名人数</p>
        </li>
    </ul>
    <div style="clear:both;"></div>
</div>

<div class="base_info block">
  <ul>
    <li><label>主办社团：</label><span><?php echo $society['sName']?></span></li>
    <li><label>活动类型：</label><span><?php echo $aInfo['actType'].'/'.$aInfo['isApply'].'/'.$aInfo['actRange']?></span></li>
    <li><label>活动时间：</label><span><?php echo substr($aInfo['actBeginDate'],5).' '.$aInfo['actBeginTime'].'～'.substr($aInfo['actEndDate'],5).' '.$aInfo['actEndTime']?></span></li>
    <li><label>活动地点：</label><p><?php echo $aInfo['actPlace']?></p></li> 
    <li><label>报名时间：</label><p><?php echo $aInfo['applyBeginDate']!=NULL?substr($aInfo['applyBeginDate'],5).' '.$aInfo['applyBeginTime'].'～'.substr($aInfo['applyEndDate'],5).' '.$aInfo['applyEndTime']:''?></p></li> 
  </ul>
</div>

<div class="board block">
	<strong>公告栏</strong>
    <p><span style="margin-right:29px;"></span><?php echo $aInfo['actBoard']?$aInfo['actBoard']:'当前暂无公告！';?></p>
</div>

<div class="freshNews block">
	<strong>活动简介</strong>
    <p><span style="margin-right:29px;"></span><?php echo $aInfo['actDesc']?></p>
</div>

<div class="freshDetail block">
	<strong>详细说明</strong>
    <p><pre id="detail"><?php echo $aInfo['actDetail']?></pre></p>
</div>

<a href="M_activityApply.php?actId=<?php echo $actId?>&sSchool=<?php $society['sSchool']?>" id="goOn"><div class="join">报名参加</div></a>

<script src="M_js/M_activityVisitor.js" type="text/javascript"></script>
</body>
</html>