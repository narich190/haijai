<?php
	//value to set in form fill for send to payment gw
	$memberID = $logdata[0]['member_member_id']; 
	$donationLog = $logdata[0]['donationlog_id']; 
	$money = (int)$logdata[0]['money'];

?>

					<form method="post" id="form2" action="https://www.paysbuy.com/paynow.aspx?lang=t" style="display:none;"> 
						<input type="Hidden" Name="psb" value="psb"/> 
						<input Type="Hidden" Name="biz" value="eemmoonna35@hotmail.com"/>
						<!--memberID_projectID_logid-->
						<input Type="Hidden" Name="inv" value="<?=$donationLog.'_'.$memberID?>"/> 
						<input Type="Hidden" Name="itm" value="<?=$donationLog?>"/> 
						<input Type="Hidden" Name="amt" value="<?=$money?>"/> 
						<input Type="Hidden" Name="postURL" value="http://haijai.ml/project/checkpaysbuy"/> 
						            
						<input type="image" src="https://www.paysbuy.com/imgs/powerby1.jpg" border="0" name="submit" alt="Make it easier,PaySbuy - it's fast,free and secure!"/> 
						        
					</form >

					<script type="text/javascript">
					    window.onload=function(){
					    	document.forms["form2"].submit();
					    }
					</script>