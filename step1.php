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
<?php
$lang = $_GET['lingua'];

if (!empty($lang))
{
	$vect = preg_split("/\-/", $lang);
	$lang = $vect[0];
	if ($lang == ""){$lang="-";}
	if ($lang == "-")
	{
		?>
			<script>
				document.location = "step0.php?msg=Choose a language!";
			</script>
		<?php
	}
}
if (!empty($_POST['lingua']))
{
	$lang = $_POST['lingua'];
	if ($lang == "-")
	{
		?>
			<script>
				document.location = "step0.php?msg=Choose a language!";
			</script>
		<?php
	}
}
?>
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
			<form name="escolha_rep" action="step2.php" method="POST">
					<?php
					$busca = "SELECT nome, lingua, descricao from usuarios where lingua = '".$lang."'";
					$connection = mysql_connect('localhost','dizer','dizer');
					mysql_set_charset('utf8');
					$conn = mysql_select_db('dizer_rep', $connection);
					$result = mysql_query($busca);

					?>
					<select name="lingua">
					<option value="-">Choose a repository</option>
					<?php
					while ($row = mysql_fetch_array($result, MYSQL_NUM))
					{
					print "<option value='".$row[1]."-".$row[0]."-".$row[2]."'>".$row[1]." by ".$row[0]."</option>";
					}
					mysql_free_result($result);
					?>
					<option value='RSTParser'>RSTParser Classifier (Portuguese)</option>	
				</select>&nbsp;&nbsp;<a href="javascript:go()"><img src="IMGS/bt_view_rep.gif" border=0 align=absmiddle></a><br>
				<br>
				</form>
				<form name="repname" method="post" action="vis_rep_action.php">
					<input name="nome" type="hidden" value="-">
				</form>
				<img src="IMGS/bt_previous.gif" onClick="javascript:document.location='step0.php';" style="cursor:hand">
<img src="IMGS/bt_next.gif" onClick="javascript:document.escolha_rep.submit();" style="cursor:hand">

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
