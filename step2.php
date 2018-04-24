<html>
	<title>
		PDiZer
	</title>

<body topmargin=0 leftmargin=0 class="corpo">
<table class="corpo_tabela" cellpadding="0" cellspacing="0" align="center">
	<tr>
		<td>
			<img src="IMGS/topo.gif">
			<p><a href="index.php"><img src="IMGS/bt_home.gif" alt="Página Inicial" border=0></a>
		</td>
	</tr>
	<tr>
		<td style="padding-left:10pt; font-family:calibri, tahoma, arial, helvetica; font-size:14px">
			<p> &nbsp;</p>
			<center>
				<?php
					$cod = $_POST['lingua'];
					if ($cod == "-")
					{
						print "Choose a rethorical repository.<p>";
					}
					else
					{
				?>
				<a href="insert_text.php?cod=<?php print $cod;?>&seg=checked"><img src="IMGS/bt_segmented.gif" border=0 align=absmiddle></a>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<b>or</b>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
				<a href="insert_text.php?cod=<?php print $cod;?>&seg=unchecked"><img src="IMGS/bt_segment.gif" border=0 align=absmiddle></a>
				<?php
					}
				?>
				<p>&nbsp;<p>
				<img src="IMGS/bt_previous.gif" onClick="javascript:document.location='step0.php';" style="cursor:hand">
				<p>
				<img src="IMGS/line.gif"><p>
				<img src="IMGS/bt_step2.gif">
				<p>&nbsp;<p>
				
		</td>
	</tr>
	<tr>
		<td align=center class="rodape">
			<hr size=1 noshade color="#CCCCCC">
			Portable DiZer :: NILC : 2016
		</td>
	</tr>
</table>
</body>
<style>
	.rodape
	{
		font-size:10px;
		font-family:calibri, arial, tahoma, helvetica;
		color:#BBBBBB;
	}
</style>
</html>
