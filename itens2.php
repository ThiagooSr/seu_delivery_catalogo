<?php 
require_once("cabecalho.php");
$url = $_GET['url'];

$query = $pdo->query("SELECT * FROM categorias where url = '$url'");
$res = $query->fetchAll(PDO::FETCH_ASSOC);
$total_reg = @count($res);
if($total_reg > 0){
$nome = $res[0]['nome'];
$descricao = $res[0]['descricao'];
$id = $res[0]['id'];
$mais_sabores = $res[0]['mais_sabores'];
}

$sabores = @$_GET['sabores'];

if($sabores != "2"){
	$sabores = 1;
}

 ?>

<div class="container">

	<nav class="navbar bg-light" style="box-shadow: 0px 3px 5px rgba(0, 0, 0, 0.20);">
		<div class="container">
			<div class="navbar-brand" >
				<a href="index"><big><i class="bi bi-arrow-left"></i></big></a>
				<span style="margin-left: 15px"><?php echo mb_strtoupper($nome) ?></span>
			</div>

			<?php require_once("icone-carrinho.php") ?>

		</div>
	</nav>

<?php if($mais_sabores == 'Sim'){ ?>
<div class="sabores row" style="margin-top: 65px; margin-bottom: 10px">	
	<div class="col-6">
		<a href="categoria-<?php echo $url ?>&sabores=<?php echo $sabores ?>" class="link-neutro">
	<div class="sabores-itens" >
	<img src="img/1sabor.png" width="35px"><br>
 1 Sabor
	</div>
</a>
</div>
	<div class="col-6">	
	<div class="sabores-itens" style="background-color: #e6f8ff">
		<img src="img/2sabor.png" width="35px"><br>
2 Sabores
	</div>
	
</div>
</div>
<ol class="list-group ">
<?php }else{ ?>
	<ol class="list-group " style="margin-top: 65px">
<?php } ?>

		<?php 
		$query = $pdo->query("SELECT * FROM produtos where categoria = '$id' and ativo = 'Sim'");
		$res = $query->fetchAll(PDO::FETCH_ASSOC);
		$total_reg = @count($res);
		if($total_reg > 0){
			for($i=0; $i < $total_reg; $i++){
				foreach ($res[$i] as $key => $value){}
				$id = $res[$i]['id'];
				$foto = $res[$i]['foto'];
				$nome = $res[$i]['nome'];
				$url = $res[$i]['url'];
				$estoque = $res[$i]['estoque'];
				$tem_estoque = $res[$i]['tem_estoque'];
				$valor = $res[$i]['valor_venda'];
				$valorF = number_format($valor, 2, ',', '.');

				if($tem_estoque == 'Sim' and $estoque <= 0){
					$mostrar = '';
					$url_produto = '#';					
				}else{
					$mostrar = 'ocultar';
					$url_produto = 'produto-'.$url.'&sabores='.$sabores;
					
				}

				


				?>

		<a href="<?php echo $url_produto ?>" class="link-neutro">
		<li class="list-group-item d-flex justify-content-between align-items-start "> 
			<div class="me-auto">
				<img class="<?php echo $mostrar ?>" src="img/esgotado.png" width="75px" height="75px" style="position:absolute; right:0; top:0px">
				<div class="fw-bold titulo-item"><?php echo $nome ?></div>
				<span class="valor-item">
					<?php 
$query2 = $pdo->query("SELECT * FROM variacoes where produto = '$id' and ativo = 'Sim'");
		$res2 = $query2->fetchAll(PDO::FETCH_ASSOC);
		$total_reg2 = @count($res2);		
		if($total_reg2 > 0){
			for($i2=0; $i2 < $total_reg2; $i2++){
				foreach ($res2[$i2] as $key => $value){}
					$sigla = $res2[$i2]['sigla'];
				$valorvar = $res2[$i2]['valor'];
				$valorvarF = number_format($valorvar, 2, ',', '.');

				echo '('.$sigla.') R$ '.$valorvarF;
				if($i2 < $total_reg2 - 1){
					echo ' / ';
				}

				 } 
				}else{
					echo 'R$ '.$valorF;
					}
				  ?>
				
			</span>
			</div>
			
		</li>
		</a>

	<?php } } ?>


		
	</ol>


</div>

</body>
</html>
