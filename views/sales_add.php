<h1>Vendas <small> - Adicionar</small></h1>
</br>
		<form method="POST">

		<!-- ADICIONAR VENDAS -->
<fieldset>

<legend></h4>Adicionar Produto</h4></legend>
<input type="text" name="add_prod" id="add_prod" data-type="search_products" "  />
</fieldset>

  </br>
  <fieldset>

<!-- TABELA DE PRODUTOS-->

<legend><h4>Produtos</h4></legend>

<table border="1" width="100%" id="products_table">
	
	<tr>
		<th>Cód.</th>
		<th>Produto</th>
		<th>QTDE</th>
		<th>Preço Unit.</th>
		<th>Sub-Total</th>
		<th>Excluir</th>

	</tr>
  

</table>
</fieldset>

  </br>

		<!-- TABELA DADOS DA VENDA-->

<fieldset>
<legend><h4>Dados da Venda</h4></legend>
<table border="1" width="100%">
	<tr>
   		<td width="50%">
    <label  for="client_name">Nome do Cliente</label></br>
	<input type="hidden" name="client_id" />
	<input type="text" name="client_name"   id="client_name" data-type="search_clients"/>
	&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
	<div class="button "  ><a href="<?php echo BASE_URL;?>/clients/add">Adicionar Cliente</a></div>
   		</td>
   <td>
   <label for="salesman_name">Nome do Funcionário</label></br>
	<input type="hidden" name="salesman_id"  />
	<input width="90" style="align:left" type="text" name="salesman_name" id="salesman_name" data-type="search_salesman" required />
	<div style="clear:both"></div>
   	</td>
    </tr>
<tr>
   <td  width="50%">
	<label for="forma">Forma de Pagamento</label></br>
	<select name="forma" id="forma">
	<option value="0">À Vista (Dinheiro) </option>
	<option value="1">Débito</option>
	<option value="2">Credito À Vista</option>
	<option value="3">Credito Parcelado</option>
	<option value="4">Crediário</option>   
  	</select></br>
  	</td>
   <td>
   <label for="desconto">Desconto</label><br>
<input type="text" name="desconto" value="0,00" />
<div style="clear:both"></div>

   </td>
  </tr>

  <tr>
   <td>

    <label for="status">Status da Venda</label></br>
<select name="status" id="status">
<option value="0">Pago</option>
<option value="1">Cancelado</option>
<option value="2">Orçamento</option>
</select></br>
   </td>
   <td>
<label for="total_price">Preço da Venda</label></br>
<input type="text" name="total_price" readonly="true" /></br>
<div style="clear:both"></div>
   </td>
  </tr>

 </table>
 </fieldset>
<div style="clear:both"></div> <br>
<div class="addVenda">
   <input type="submit" style="background-color:green; width: 200px"  value="Adicionar Venda" />
</div>

</form>	

<script type="text/javascript" src="<?php echo BASE_URL; ?>/assets/js/jquery.mask.js"></script>
<script type="text/javascript" src="<?php echo BASE_URL; ?>/assets/js/script_sales_add.js"></script>
<script type="text/javascript" src="<?php echo BASE_URL; ?>/assets/js/script_clients_add.js"></script>
<script type="text/javascript" src="<?php echo BASE_URL; ?>/assets/js/script_desc_add.js"></script>
<script type="text/javascript" src="<?php echo BASE_URL; ?>/assets/js/script_clients_cpf.js"></script>
