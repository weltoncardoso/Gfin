<meta charset="utf-8">
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">

<style type="text/css">
th {text-align: left; }
</style>

<div align="right"><img  src="./assets/images/luart.png"  width="250px" height="130px" /> </div>

<h1>Relatório de Vendas</h1>
<fieldset>
<?php
if(isset($filters['client_name']) && !empty($filters['client_name'])){
	echo "Filtrado pelo Cliente: ".$filters['client_name']."<br/>";
}

if(isset($filters['salesman_name_vendedor']) && !empty($filters['salesman_name_vendedor'])){
	echo "Filtrado pelo Vendedor: ".$filters['salesman_name_vendedor']."<br/>";
}

if(isset($filters['period1']) && !empty($filters['period2'])){
	echo "No Período: ".date('d/m/Y', 
		strtotime($filters['period1']))." a ".date('d/m/Y',strtotime($filters['period2']))."<br/>";
}

if($filters['status'] != ''){
	echo "Filtrado com status: ".$statuses[$filters['status']];
}

if($filters['forma'] != ''){
	echo "Filtrado com Forma de Pagamento: ".$formases[$filters['forma']];
}

?>

</fieldset>
<table border="1" width="100%">

	<tr>
			<th>Cliente</th>
			<th>Funcionário</th>
			<th>Data</th>
			<th>Status</th>
			<th>Forma de Pag</th>
			<th>Valor</th>
			

	</tr>


		<?php foreach($sales_list as $sale_item): ?>



	<tr>
		<td width="120"><?php  echo $sale_item['name']; ?></td>
		<td width="120"><?php  echo $sale_item['name_vendedor']; $sales_item ?></td>
		<td width="120"><?php  echo date('d/m/Y', strtotime($sale_item['date_sale'])); ?></td>
		<td width="80"><?php echo $statuses[$sale_item['status']]; ?></td>
		<td width="130"><?php echo $formases[$sale_item['forma']]; ?></td>
		<td width="120">R$: <?php echo number_format($sale_item['total_price'], 2,',','.'); ?></td>
	

	</tr>
		

		<?php endforeach; ?>
	</table>
