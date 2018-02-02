<html>
    <head>
        <meta charset="utf-8">
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1" />
        <title>Painel - <?php echo $viewData['company_name']; ?></title>
        <link href="<?php echo BASE_URL; ?>/assets/css/template.css" rel="stylesheet" />

        <link  href="<?php echo BASE_URL; ?>/assets/css/bootstrap.min.css" rel="stylesheet" />
       <script type="text/javascript" src="<?php echo BASE_URL; ?>/assets/js/jquery.min.js"></script>
        <script type="text/javascript" src="<?php echo BASE_URL; ?>/assets/js/bootstrap.min.js"></script>
        <script type="text/javascript">var BASE_URL = '<?php echo BASE_URL; ?>' ;</script>
        <script type="text/javascript" src="<?php echo BASE_URL; ?>/assets/js/script.js"></script>

    </head>
    <body>


<nav class="navbar navbar-inverse navbar-fixed-top">
  <div class="container-fluid">
    <div class="navbar-header">
      <a class="navbar-brand" href="<?php echo BASE_URL; ?>"><?php echo $viewData['company_name']; ?></a>
    </div>
    <ul class="nav navbar-nav">
            <li><a href="<?php echo BASE_URL; ?>/permissions"> Permissões</a></li>
        <li class="dropdown">
        <a href="" class="dropdown-toggle" data-toggle="dropdown" >Cadastrar
        <span class="caret"></span></a>
        <ul class="dropdown-menu">
            <li><a href="<?php echo BASE_URL; ?>/inventory"> Produtos</a></li>
            <li><a href="<?php echo BASE_URL; ?>/users"> Usuários</a></li>
            <li><a href="<?php echo BASE_URL; ?>/clients"> Clientes</a></li>
            <li><a href="<?php echo BASE_URL; ?>/salesman"> Funcionários</a></li>
        </ul>
      </li>
               
    <li class="active"><a href="<?php echo BASE_URL; ?>/sales"> Vendas</a></li>

    <li class="dropdown">
        <a href="" class="dropdown-toggle" data-toggle="dropdown" >Relatorios
        <span class="caret"></span></a>
        <ul class="dropdown-menu">
            <li><a href="<?php echo BASE_URL; ?>/report/sales"> Vendas</a></li>
            <li><a href="<?php echo BASE_URL; ?>/report/inventory"> Estoque</a></li>
            <li><a href="<?php echo BASE_URL; ?>/report/accounts"> Contas</a></li>
            <li><a target="_blank" href="<?php echo BASE_URL; ?>/danfes"> NFC-e Mensal</a></li>
        </ul>
      </li>

            <li><a href="<?php echo BASE_URL; ?>/accounts"> Contas</a></li>
          </ul>
            <ul "nav navbar-nav navbar-right">
            <div class="top_right"><a href="<?php echo BASE_URL.'/login/logout'; ?>">Sair</a></div>
             <div class="top_right">Usuario: <?php echo $viewData['user_email']; ?></div>
           </ul>
    
  </div>

</nav>

  <div class="container"> 
      <div class="area">
      
     		<?php $this->loadViewInTemplate($viewName, $viewData); ?>
     	</div>	
     </div>
     </div>

    </body>
</html>
