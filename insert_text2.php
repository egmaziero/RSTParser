<html>
<meta charset="UTF-8">
	<title>
		DiZer 2.0
	</title>

<body topmargin=0 leftmargin=0 class="corpo">
<table class="corpo_tabela" cellpadding="0" cellspacing="0" align="center">
	<tr>
		<td>
			<img src="IMGS/topo.gif">
			<p><a href="index.php"><img src="IMGS/bt_home.gif" alt="P·gina Inicial" border=0></a>
		</td>
	</tr>
	<tr>
		<td style="padding-left:10pt; font-family:calibri, tahoma, arial, helvetica">
			<p> &nbsp;</p>
			<?php
			$cod = $_GET['cod'];
			$s = $_GET['seg'];
			?>
			<script>
			function carregar()
			{
				document.step2.texto.value="Os resultados da análise de inteligibilidade de córpus podem ajudar a guiar a tarefa de simplificação textual,";
				document.step2.texto.value+="\nfornecendo quais características realmente tornam um texto mais simples de ser entendido por pessoas dos mais diversos níveis de letramento.[s]";
				document.step2.texto.value+="\nApesar de ter sido criada para este fim,";
				document.step2.texto.value+="\na ferramenta pode ser utilizada";
				document.step2.texto.value+="\npara quaisquer fins que necessitem de tais informações.[s][p]";
			}
			</script>
			<form name="step2" action="step3.php" method="POST">
				<input type="hidden" value="<?php print $cod?>" name="cod">
			<font style="font-size:12px">
<?php
	if ($s == "checked")
	{
		
		print "Type one segment per line. You must indicate the sentences and paragraphs, as follows:<p>"; 
		print "<img src='IMGS/example.gif'>";
		print "<p align=right>"; 
		print '<a href=javascript:carregar()>Load example</a><br>';
		print '<center>';
		print '<textarea name="texto" style="width:650px; height:300px">';
		print "Segments here, one per line"; 
	}
	else 
	{
		print '<textarea name="texto" style="width:650px; height:300px">';
		print "Text here";
	}
?>
</textarea><br>
</font>
				<input type="hidden" value="<?php print $s?>"  name="s"><p>
				<center>
				<table style="width:700px">
				 <tr>
					<td valign=center align=center style="background:#EEEEEE">
						<input type="submit" value="Continue"> 
					</td>
					<td>
						<input type="checkbox" name="restricao"> Apply nuclei restriction<br>
						<input type="checkbox" name="compact"> Join trees with similar structures</font>
					</td>
				 <tr>
				</table>
				</center>				
			</form>
			<?php
	if ($s == "checked")
	{
		print "<center><img src='IMGS/bt_step2b.gif'><p></center>"; 
	}
	else 
	{
		print "<center><img src='IMGS/bt_step2a.gif'><p></center>"; 
	}
?>
			<p> &nbsp;</p>
		</td>
	</tr>
	<tr>
		<td align=center class="rodape">
			<hr size=1 noshade color="#CCCCCC">
			Portable DiZer :: NILC : 2010
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