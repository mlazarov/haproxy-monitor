<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<title>Haproxy monitor</title>
	<link href="/css/bootstrap.css" rel="stylesheet">
	<link href="/css/bootstrap-responsive.css" rel="stylesheet">
	<link href="/css/custom.css?" rel="stylesheet">
	<meta http-equiv="refresh" content="10">
</head>
<body>

<div class="container">
	<center><?php echo date("d.m.Y H:i:s");?></center>
	<div class="row">
				<?php
				$i=0;
				foreach($data as $bk_group=>$bk_list){
					$bk_group_tmp = $bk_list;
					$bk_group_count = 0;
					if(count($bk_list)==1 && $bk_list['FRONTEND']){
						continue;
					}
//					foreach($bk_group_tmp as $bk_name=>$bk){
//						if($bk_name=='FRONTEND' || $bk_name=='BACKEND'){continue;}
//						$bk_group_count+=$bk['scur'];
//					}
					?>
					<div class="span4">
					<table class="table table-bordered table-condensed table-striped">
					<tr>
						<th colspan="1"><?php echo $bk_group;?> <span class="pull-right"></span></th>
						<th width="10%" style="text-align:right;"><?php echo $bk_list['BACKEND']['scur'];?></th>
						<th width="20%" style="text-align:right;">Tr.In</th>
						<th width="20%" style="text-align:right;">Tr.Out</th>
						<th width="10%" style="text-align:right;"></th>
					</tr>
					<?php
					foreach($bk_list as $bk_name=>$bk){
						//var_dump($bk);
						if($bk_name=='FRONTEND' || $bk_name=='BACKEND'){continue;}
						if($bk['status']=='UP') $class = 'success';
						else $class = 'error';
					?>
					<tr class="<?php echo $class;?>">
						<td><?php echo $bk_name;?></td>
						<td style="text-align:right;"><?php echo $bk['scur'];?></td>
						<td style="text-align:right;"><?php echo byte_format($bk['bin']);?></td>
						<td style="text-align:right;"><?php echo byte_format($bk['bout']);?></td>
						<td style="text-align:center;"><?php echo $bk['status'];?></td>
					</tr>
					<?php
					}
					?>
					</table></div>
					<?php
					if($i>=2){echo '</div><div class="row">';$i=0;}
					else $i++;
				}
				?>	
	</div>

</div>

</body>
</html>
