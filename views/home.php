<div class="db-row row1">
<div class="grid-1">
	<div class="db-grid-area">
	<div class="db-grid-area-count"><?php echo $products_sold; ?></div>
	<div class="db-grid-area-legend">Produtos Vendidos</div>
	</div>
</div>



<div class="grid-1">
		<div class="db-grid-area">
			<div class="db-grid-area-count">R$ <?php echo number_format($revenue, 2); ?></div>
	<div class="db-grid-area-legend">Receitas</div>


		</div>

</div>




<div class="db-row row2">
	<div class="grid-2">
		<div class="db-info">
				<div class="db-info-title">Relatório de Despesas e receitas dos últimos 30 dias</div>
			<div class="db-info-body" style="height:250px">
					<canvas id="rel1"></canvas>
				</div>
	</div>


	</div>


	<div class="grid-1">
				<div class="db-info">
				<div class="db-info-title">Forma de Pagamento</div>
				<div class="db-info-body" style="height:250px">
					<canvas id="rel2" style="height:600%"></canvas>
	</div>
	</div>

</div>
<script type="text/javascript">
 var days_list = <?php echo json_encode($days_list); ?>;
 var revenue_list = <?php echo json_encode(array_values($revenue_list)); ?>;
var forma_name_list = <?php echo json_encode(array_values($formases)); ?>;
var forma_list = <?php echo json_encode(array_values($forma_list)); ?>;

</script>
<script type="text/javascript" src ="<?php echo BASE_URL; ?>/assets/js/Chart.min.js"></script>
<script type="text/javascript" src ="<?php echo BASE_URL; ?>/assets/js/script_home.js"></script>
