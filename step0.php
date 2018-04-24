<html>
<meta charset="UTF-8">
	<title>
		PDiZer
	</title>
<script>
function go()
{
	document.repname.nome.value = document.escolha_rep.lingua.value;
	document.repname.submit();
}
</script>

<body topmargin=0 leftmargin=0 class="corpo">
<table class="corpo_tabela" cellpadding="0" cellspacing="0" align="center">
	<tr>
		<td>
			<img src="IMGS/topo.gif">
			<p><a href="index.php"><img src="IMGS/bt_home.gif" alt="P·gina Inicial" border=0></a>
		</td>
	</tr>
	<tr>
		<td align="center">
			<p> &nbsp;</p>
			<p>
			<?php
			echo "<center><p style='background:#FFA500;font-size:15px;text-align:center;width:150px'>".$_GET['msg']."</p></center>";
			?>
			<form name="escolha_lan" action="step1.php" method="POST">
				<select name="lingua">
					<option value="-">Choose a language</option>
					<?php
					$busca = "SELECT lingua from usuarios group by lingua";
					$connection = mysql_connect('localhost','dizer','dizer');
					mysql_set_charset('utf8');
					$conn = mysql_select_db('dizer_rep', $connection);
					$result = mysql_query($busca);
					while ($row = mysql_fetch_array($result, MYSQL_NUM))
					{
					print "<option value='".$row[0]."'>".$row[0]."</option>";
					}
					mysql_free_result($result);
					?>
					
				</select><p><img src="IMGS/bt_next.gif" onClick="javascript:document.escolha_lan.submit();" style="cursor:hand">

				<br>
				</form>
				<p>
				<img src="IMGS/line.gif"><p>
				<img src="IMGS/bt_step1.gif">
			<p> &nbsp;</p>
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
