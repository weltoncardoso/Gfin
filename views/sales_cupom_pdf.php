<?php 
include "QRCodeGenerator.class.php";
?>
<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8">
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">

<link rel="stylesheet" type="text/css" href="">

<style type="text/css" media="all">
            body { color: #000; }
            #wrapper { max-width: 480px; margin: 0 auto; padding-top: 20px; }
            .btn { border-radius: 0; margin-bottom: 5px; }
            .table { border-radius: 3px; }
            .table th { color: #E0FFFF; background: #696969; }
            .table th, 
            .table td { vertical-align: middle !important; }
            h3 { margin: 5px 0; }

            @media print {
                .no-print { display: none; }
                #wrapper { text-align: center; max-width: 480px; width: 100%; min-width: 250px; margin: 0 auto; }
            }        
</style>
</head>
<body>

<div id="wrapper" align="center">
<img src="<?php echo BASE_URL; ?>/assets/images/logo.png" width="100" height="40" border="0" />
<h6 align="center">GK CENTRO AUTOMOTIVO <br>
LTDA ME <br>
QR 311 CONJ 08 LOTE 04 <br>
LOJA 03 CEP 72307-008<br> 
SAMAMBAIA- DF<br>
CNPJ-10595655/0001-03 <br>
Cupom - Sem Valor Fiscal </h6>
<h6 align="center"> Descrição dos Produtos </h6>
<table class="table table-striped table-condensed" align="center"> 
 <thead>
<tr>
   

                        <th class="text-center">Cod</th>
                        <th class="text-center">Nome</th>
                        <th class="text-center"> Qtd</th>
                        <th class="text-center">Unit</th>
                        <th class="text-center">Total</th>
</tr>

<?php foreach($sales_info['products'] as $productitem): ?>
<tr>
	<td align="center"><?php echo $productitem['code']; ?></td>
	<td align="center"><?php echo $productitem['name']; ?></td>
	<td align="center"><?php echo $productitem['quant']; ?></td>
	<td align="center"><?php echo number_format($productitem['sale_price'], 2, ',', '.'); ?></td>
	<td align="center"><?php echo number_format($productitem['sale_price'] * $productitem['quant'], 2, ',', '.'); ?></td>

</tr>
</thead>
<?php endforeach; ?>
</table>
<h6 align="center"> Descrição da Venda </h6>
 <table class="table table-striped table-condensed" align="center">
                <thead>
                    <tr>
                        <th class="text-center">Cliente</th>
                        <th class="text-center">Funcionário</th>
                        <th class="text-center">Status</th>
                        <th class="text-center">F.pag</th>
                        <th class="text-center">Data</th>
                        <th class="text-center">Desc</th>
                        <th class="text-center">Total</th>
                    </tr>
                    <tr>

    <td width="20"><?php echo $sales_info['info']['client_name'];  ?></td>
    <td width="30"><?php echo $sales_info['info']['salesman_name_vendedor']; ?></td>
    <td width="30"><?php echo $statuses[$sales_info['info']['status']]; ?></td>
    <td width="30"><?php echo $formases[$sales_info['info']['forma']]; ?></td>
    <td width="30"><?php echo date('d/m/Y', strtotime($sales_info['info']['date_sale'])); ?></td>
    <td width="30"><?php echo number_format($sales_info['info']['desconto'], 2, ',', '.'); ?></td>
    <td width="30"><?php echo number_format($sales_info['info']['total_price'], 2, ',', '.'); ?></td>
    
</tr>
</thead>
    
</table>
=================
<div style="clear:both;"></div>
<?php 

 $ex1 = new QRCodeGenerator('http://www.nfe.fazenda.gov.br/portal/consulta.aspx?tipoConsulta=completa&tipoConteudo=XbSeqxE8pl8=MobLanche_weltonvcardoso@gmail.com');
                echo "<img src=".$ex1->generate().">";
 ?>
</div>
<h6 align="center">Obrigado e Volte Sempre!<br>
Procon 151<br>
Venâncio 2000 - SCS Quadra 08 <br>
Bloco B-60 Sala 240<br>
Brasilia DF<br></h6>
</body>
</html>