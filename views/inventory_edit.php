<h1>Produtos - Editar</h1>
</br>
<?php if(isset($error_msg) && !empty($error_msg)): ?>
	<div class="warn"><?php echo $error_msg; ?></div>
<?php endif; ?>

<form method="POST">
<table border="1" width="100%">
	<tr>
		<td>
	<label form="code">Código</label><br/>
	<input type="number" name="code" value="<?php echo $inventory_info['code']; ?>" required/><br/><br/>
</td>
<td>
	<label form="name">Nome</label><br/>
	<input type="text" name="name" value="<?php echo $inventory_info['name']; ?>" required/><br/><br/>
</td>
</tr>
<tr>
	<td>
<label form="category">Categoria</label><br/>
	<select name="category" id="category">

<option value="0"<?php echo($inventory_info['category']=='0')?'selected="selected"':'';?>>Vendas Diretas</option>
<option value="1"<?php echo($inventory_info['category']=='1')?'selected="selected"':'';?>>Serviços</option>

	</select><br/><br/>
</td>
<td>

    <label form="price">Preço</label><br/>
	<input type="text" name="price" value="<?php echo number_format($inventory_info['price'],2); ?>"  required/><br/><br/>
</td>
</tr>
<tr>
	<td>
    <label form="quant">Quantidade Em Estoque</label><br/>
	<input type="number" name="quant" value="<?php echo $inventory_info['quant']; ?>"  required/><br/><br/>
</td>
<td>
    <label form="min_quant">Quantidade Minima em Estoque</label><br/>
	<input type="number" name="min_quant" value="<?php echo $inventory_info['min_quant']; ?>"  required/><br/><br/>	
</td>
</tr>
</table>

<div style="clear:both"></div>
<div style="text-align:center">
</br>
	<input type="submit" value="Salvar"/>
</div>


</form>

<script type="text/javascript" src="<?php echo BASE_URL; ?>/assets/js/jquery.mask.js"></script>
<script type="text/javascript" src="<?php echo BASE_URL; ?>/assets/js/script_inventory_add.js"></script>
