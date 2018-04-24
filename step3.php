<html>
<meta charset="UTF-8">
<?php
		$id = rand(1,9999);
?>
	<title>
		DiZer 2.0
	</title>
	
<body topmargin=0 leftmargin=0 class="corpo">
<table class="corpo_tabela" cellpadding="0" cellspacing="0" align="center">
	<tr>
		<td>
			<img src="IMGS/topo.gif" border=0>
			<p><a href="index.php"><img src="IMGS/bt_home.gif" alt="P·gina Inicial" border=0></a>
		</td>
	</tr>
	<tr>
	<input type="hidden" value="<?php echo $id;?>">
		<td style="padding-left:10pt; font-family:calibri, tahoma, arial, helvetica; font-size:14px; width:700">
			<p> &nbsp;</p>
			<?php
				$cod = $_POST['cod'];
				$metodo = $_POST['metodo'];
				if ($metodo == "greedy")
				{
					$numberTrees = $_POST['numberTrees'];
				}
				if ($metodo == "marcu")
				{
					$restricao = $_POST['restricao'];
					if ($restricao == "on")
					{
						$restricao = 1;
					}
					else
					{
						$restricao = 0;
					}
				}
				
				$compact = $_POST['compact'];
				if ($compact == "on")
				{
					$compact = 1;
				}
				else
				{
					$compact = 0;
				}

				$s = $_POST['s'];
				$text = $_POST['texto'];
				$arq = fopen("text/texto_".$id.".txt","w");
				fwrite($arq,$text);
				fclose($arq);

				$arq = fopen("bin/text/texto_".$id.".txt","w");
				fwrite($arq,$text);
				fclose($arq);
				
				if ($cod == "RSTParser")
				{
					print "<b>RSTParser classifier selected to identify intra-sentential relations</b><br>";
				}
				else
				{
					$rep = split("-",$cod);
					print "<b>Rhetorical repository in use:</b> ".$rep[0]." <b>created by: </b>".$rep[1]." <br>";
				}
				if ($metodo == "greedy")
				{
					print "<b>Method to construct the trees:</b> Greedy, with $numberTrees trees<p>";
				}
				if ($metodo == "marcu")
				{
					print "<b>Method to construct the trees:</b> Marcu algorithm<p>";
				}
				print "<img src='IMGS/results.gif' border=0><p>";
				if ($s == "unchecked")
				{
					# exception to call RST_parser
					if ($cod == "RSTParser")
					{
						system("perl bin/preProcessor.pl ".$id." text/texto_".$id.".txt");
						system("perl bin/segmenter.pl ".$id);
						system("perl bin/controllerModel.pl ".$id);
					}
					else
					{
						if ($rep[0] == "Português")
						{
							system ("perl bin/pre_proc.pl ".$id." >/dev/null 2>&1");
							system ("perl bin/tagging.pl ".$id." >/dev/null 2>&1");
							system ("perl bin/dispatcher.pl ".$id." >/dev/null 2>&1");
						}
						elseif ($rep[0] == "Español")
						{
							system ("perl bin/pre_proc_spanish.pl ".$id." >/dev/null 2>&1");
							system ("perl bin/proc_spanish.pl ".$id." >/dev/null 2>&1");
						}
						elseif ($rep[0] == "English")
						{
							system ("perl bin/proc_english.pl ".$id." >/dev/null 2>&1");
						}
					
					}
				}
				else
				{
					if ($cod == "RSTParser")
					{
					}
					else
					{
						if ($rep[0] == "Português")
						{	
							system ("perl bin/tagging2.pl ".$id." >/dev/null 2>&1");
						}
						elseif ($rep[0] == "Español")
						{
							system ("perl bin/pre_proc_spanish.pl ".$id." >/dev/null 2>&1");
							system ("perl bin/proc_spanish.pl ".$id." >/dev/null 2>&1");
						}
						elseif ($rep[0] == "English")
						{
							#o que fazer para segmentar e etiquetar
						}
					}
				}
				if ($cod == "RSTParser")
				{
				}
				else
				{
					system("perl bin/pre_relate.pl ".$id." >/dev/null 2>&1");
					system("perl bin/relate.pl ".$rep[1]." ".$id." ".$compact." ".$metodo.">/dev/null 2>&1");
				}

				if ($metodo == "marcu")
				{
					system ("perl bin/grammar.pl ".$restricao." ".$id." >/dev/null 2>&1");
					system ("perl bin/execute.pl ".$restricao. " ".$id);
				}
				elseif ($metodo == "greedy")
				{
					system ("python bin/program.py ".$id." ".$numberTrees." >/dev/null 2>&1");
				}
				
				
				#leitura dos resultados
				if ($results = fopen("bin/results_".$id.".txt","r"))
				{
					$relations = array();
					while (!feof ($results)) 
					{ 
						//se extraio uma linha do arquivo e nao eh false 
						if ($linha = fgets($results))
						{ 
						   print "<p>";
						   $rep = split(", '",$linha);
						   $rep = split("',",$rep[1]);
						   $prob = split(")",$rep[1]);
						   if (strpos($prob[0],'e'))
						   {
								$partes = split("e-",$prob[0]);
								$new_probability = "0.";
								for($i=1;$i<$partes[1];$i++)
								{
									$new_probability .= "0";
								}
								$new_probability .= "1";
								#array_push($relations,$new_probability."==".$rep[0]);
								array_push($relations,$rep[0]);
						   }
						   else
						   {
								#array_push($relations,$prob[0]."==".$rep[0]);
								array_push($relations,$rep[0]);
						   }
						}
					}
					fclose($results);
					
					$trees = fopen("bin/trees_".$id.".txt","w");
					$trees2 = fopen("bin/segments/segments_clear_".$id.".txt","a");
					fwrite($trees2,"Trees:\n");
					$ant = "";
					for ($i=0; $i<sizeof($relations); $i++) 
					{ 
						if ($relations[$i] != $ant)
						{
							print "<hr size='1' noshade> <a href='tree_vis.php?id=".$id."&tree=".$i."' style='text-decoration:none'><img src='IMGS/tree_view.png'></a><br>";
							print $relations[$i]; 
							fwrite($trees,$relations[$i].";\n");
							fwrite($trees2,$relations[$i].";\n");
						}
						$ant = $relations[$i];
					}
					print "<hr size='1' noshade> ";
					fclose($trees);
					fclose($trees2);
				}
				else
				{
					echo "<h1>Some problem occurred. </h1>
					<ul>
					<li> Verify if the input text can be segmented in more than one segment, OR
					<li> Verify the patterns and lists of ".$rep[0]." created by ".$rep[1].". <br>Access the Rhetorical Repository and click on 'Warnings' button
					</ul>";
					
				}
								
			?>
			<br>
			<script>
				function detalhes()
				{
					document.getElementById('details').style.visibility = "visible";
				}
			</script>
			<a href="javascript:detalhes()"><img src="IMGS/details.gif" border=0 valign=bottom></a> <a href="bin/segments/segments_clear_<?php echo $id;?>.txt"><img src="IMGS/bt_down.gif" border=0 valign=bottom></a>
			<div id="details" name="details" style="visibility:hidden; background: #EEEEEE; width:400px; padding-left:30px;">
			 Segments  - <a href='bin/segments/segments_<?php echo $id;?>.txt'>view</a><br>
			 Found patterns  - <a href='bin/patterns_<?php echo $id;?>.txt'>view</a><br>
			 Relations identified - <a href='bin/relations_<?php echo $id;?>.txt'>view</a><br>
			</div>
			
			<hr size=1 noshade color=#CCCCCC>
			<p> &nbsp;</p>
			<center>
			<a href="tree.php?id=<?php echo $id;?>"><img src="IMGS/bt_tree_view.gif" border=0></a>
			<p>
			<p>
				<img src="IMGS/line.gif"><p>
				<img src="IMGS/bt_step3.gif">
			
			
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
