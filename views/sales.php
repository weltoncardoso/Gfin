<h1>Vendas</h1>
<link href="<?php echo BASE_URL; ?>/assets/css/template.css" rel="stylesheet" />
<script type="text/javascript" src="<?php echo BASE_URL; ?>/assets/js/jquery.mask.js"></script>
<script type="text/javascript" src="<?php echo BASE_URL; ?>/assets/js/script_sales_add.js"></script>
<script type="text/javascript" src="<?php echo BASE_URL; ?>/assets/js/script_desc_add.js"></script>
<script type="text/javascript" src="<?php echo BASE_URL; ?>/assets/js/script_clients_cpf.js"></script>

<div style="clear:both"></div>
<div style="text-align:center">
	<div class="button"><a href="<?php echo BASE_URL;?>/sales/add">Adicionar Venda</a></div>
</div>
<table border="1" width="100%">

	<tr>
			<th>Cliente</th>
			<th>Funcionário</th>
			<th>Data</th>
			<th>Status</th>
			<th>Form Pag.</th>
			<th>Valor</th>
			<th>Ações</th>

	</tr>


		<?php foreach($sales_list as $sale_item): ?>



	<tr>
		<td><?php  echo $sale_item['name']; ?></td>
		<td><?php  echo $sale_item['name_vendedor'];?></td>
		<td><?php  echo date('d/m/Y', strtotime($sale_item['date_sale'])); ?></td>
		<td><?php echo $statuses[$sale_item['status']]; ?></td>
		<td><?php echo $formases[$sale_item['forma']]; ?></td>
		<td>R$: <?php echo number_format($sale_item['total_price'], 2,',','.'); ?></td>
		<td>
			<div class="button button_small"><a href="<?php echo BASE_URL; ?>/sales/edit/<?php echo $sale_item['id']; ?>">Editar</a></div>
			<div class="button button_small"><a target="_blank" href="<?php echo BASE_URL; ?>/sales/cupom/<?php echo $sale_item['id']; ?>">Cupom</a></div>

			<?php if(!empty($sale_item['nfe_key'])): ?>

			<div class="button button_small"><a target="_blank" href="<?php echo BASE_URL; ?>/sales/view_nfe/<?php echo $sale_item['nfe_key']; ?>">Vizualizar NF-C</a></div>

		<?php else: ?>

					<div class="button button_small"><a target="_blank" href="<?php echo BASE_URL; ?>/sales/generate_nfe/<?php echo $sale_item['id']; ?>">Emitir NF-C</a></div>

	<?php endif; ?>
		</td>

	</tr>
		

		<?php endforeach; ?>
	</table>

 <div class="pagination">
		<?php for($q=1; $q<=$p_count;$q++): ?>
		<div class="pag_item <?php echo($q==$p)?'pag_ativo':''; ?>"><a href="<?php echo BASE_URL; ?>/sales?p=<?php echo $q; ?>"><?php echo $q; ?></a></div>


	<?php endfor; ?>

	<div style="clear:both"></div>
</div>



<script type="text/javascript" src="<?php echo BASE_URL; ?>/assets/js/jquery.mask.js"></script>
<script type="text/javascript" src="<?php echo BASE_URL; ?>/assets/js/script_sales_add.js"></script>
<script type="text/javascript" src="<?php echo BASE_URL; ?>/assets/js/script_desc_add.js"></script>
<script type="text/javascript" src="<?php echo BASE_URL; ?>/assets/js/script_clients_cpf.js"></script>
