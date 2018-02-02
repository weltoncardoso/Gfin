<?php

class inventoryController extends controller{


	 public function __construct() {
        parent::__construct();

        $u = new Users();
        if($u->isLogged() == false){
        	header("Location: ".BASE_URL."/login");
        	exit;
        	
        }
    }


    public function index(){

        $data = array();
        $u = new Users();
        $u->setLoggedUser();
        $company = new Companies($u->getCompany());
        $data['company_name'] = $company->getName();
        $data['user_email'] = $u->getEmail();

         $data['categoriases'] = array(
                '0'=>'Infantil',
                '1'=>'Chuteiras',
                '2'=>'Artigos Esportivos',
                '3'=>'Sapato Social Mas',
                '4'=>'Tênis',
                '5'=>'Sapatenis/Mocassim',
                '6'=>'Sandalia Masc',
                '7'=>'Bota Mas',
                '8'=>'Bota Fem',
                '9'=>'Sapatilha fem',
                '10'=>'Plataforma',
                '11'=>'Scarpann',
                '12'=>'Sapato Salto',
                '13'=>'Sandalia Salto ',
                '14'=>'Rasteirinhas',
                '15'=>'Ortopedicas',
                '16'=>'Acessórios'

            );

            if($u->hasPermission('inventory_view')){
                $i = new Inventory();
                $offset = 0;
                $data['p'] = 1;
                if(isset($_GET['p']) && !empty($_GET['p'])){
                    $data['p'] = intval($_GET['p']);
                    if($data['p'] == 0){
                        $data['p'] = 1;
                    }
                }

                $offset = ( 10 * ($data['p']-1));

                $data['inventory_count'] = $i->getCount($u->getCompany());
                $data['p_count'] = ceil($data['inventory_count'] / 10);

                $data['inventory_list'] = $i->getList($offset, $u->getCompany());
                $data['edit_permission'] = $u->hasPermission('inventory_edit');
                $data['add_permission'] = $u->hasPermission('inventory_add');



                $this->loadTemplate('inventory', $data);
        }else{
            header("Location: ".BASE_URL);

        } 

    }

     public function add(){
              $data = array();
        $u = new Users();
        $u->setLoggedUser();
        $company = new Companies($u->getCompany());
        $data['company_name'] = $company->getName();
        $data['user_email'] = $u->getEmail();

            if($u->hasPermission('inventory_add')){
                if(isset($_POST['name']) && !empty ($_POST['name'])){

                    $i = new Inventory();
                        $code = addslashes($_POST['code']);
                        $name = addslashes($_POST['name']);
                        $category = addslashes($_POST['category']);
                        $price = addslashes($_POST['price']);
                        $quant = addslashes($_POST['quant']);
                        $min_quant = addslashes($_POST['min_quant']);
                        $cEAN = addslashes($_POST['cEAN']);
                        $NCM = addslashes($_POST['NCM']);
                        $EXTIPI = addslashes($_POST['EXTIPI']);
                        $CFOP = addslashes($_POST['CFOP']);
                        $uCom = addslashes($_POST['uCom']);
                        $cEANTrib = addslashes($_POST['cEANTrib']);
                        $uTrib = addslashes($_POST['uTrib']);
                        $vFrete = addslashes($_POST['vFrete']);
                        $vSeg = addslashes($_POST['vSeg']);
                        $vDesc = addslashes($_POST['vDesc']);
                        $vOutro = addslashes($_POST['vOutro']);
                        $indTot = addslashes($_POST['indTot']);
                        $xPed = addslashes($_POST['xPed']);
                        $nItemPed = addslashes($_POST['nItemPed']);
                        $nFCI = addslashes($_POST['nFCI']);
                        $cst = addslashes($_POST['cst']);
                        $pPIS = addslashes($_POST['pPIS']);
                        $pCOFINS = addslashes($_POST['pCOFINS']);
                        $csosn = addslashes($_POST['csosn']);
                        $pICMS = addslashes($_POST['pICMS']);
                        $orig = addslashes($_POST['orig']);
                        $modBC = addslashes($_POST['modBC']);
                        $vICMSDeson = addslashes($_POST['vICMSDeson']);
                        $pRedBC = addslashes($_POST['pRedBC']);
                        $modBCST = addslashes($_POST['modBCST']);
                        $pMVAST = addslashes($_POST['pMVAST']);
                        $pRedBCST = addslashes($_POST['pRedBCST']);
                        $vBCSTRet = addslashes($_POST['vBCSTRet']);
                        $vICMSSTRet = addslashes($_POST['vICMSSTRet']);
                        $qBCProd = addslashes($_POST['qBCProd']);
                        $vAliqProd = addslashes($_POST['vAliqProd']);
                        
                        $price = str_replace('.', '', $price);
                        $price = str_replace(',', '.', $price);

                       $b = $i->add($code, $name, $category, $price, $quant, $min_quant, $u->getCompany(), $u->getId(),
                        $cEAN, $NCM, $EXTIPI, $CFOP, $uCom, $cEANTrib, $uTrib, $vFrete, $vSeg, $vDesc, $vOutro, $indTot,
                        $xPed, $nItemPed, $nFCI, $cst, $pPIS, $pCOFINS, $csosn, $pICMS, $orig, $modBC, $vICMSDeson, $pRedBC,
                        $modBCST, $pMVAST, $pRedBCST, $vBCSTRet, $vICMSSTRet, $qBCProd, $vAliqProd);

                              if($b =='1'){

                       header("Location: " .BASE_URL."/inventory");
                            }else{
                                $data ['error_msg'] = "Produto já esta Cadastrado! Use outro Código/Nome. !";
                            }
                      

                }
              
               


                $this->loadTemplate('inventory_add', $data);
        }else{
            header("Location: ".BASE_URL."/clients");

        }
}


 public function edit($id){
              $data = array();
        $u = new Users();
        $u->setLoggedUser();
        $company = new Companies($u->getCompany());
        $data['company_name'] = $company->getName();
        $data['user_email'] = $u->getEmail();


         $data['categoriases'] = array(
                '0'=>'Infantil',
                '1'=>'Chuteiras',
                '2'=>'Artigos Esportivos',
                '3'=>'Sapato Social Mas',
                '4'=>'Tênis',
                '5'=>'Sapatenis/Mocassim',
                '6'=>'Sandalia Masc',
                '7'=>'Bota Mas',
                '8'=>'Bota Fem',
                '9'=>'Sapatilha fem',
                '10'=>'Plataforma',
                '11'=>'Scarpann',
                '12'=>'Sapato Salto',
                '13'=>'Sandalia Salto ',
                '14'=>'Rasteirinhas',
                '15'=>'Ortopedicas',
                '16'=>'Acessórios'

            );

         
                         $i = new Inventory();

            if($u->hasPermission('inventory_edit')){

                if(isset($_POST['name']) && !empty ($_POST['name'])){

                        $code = addslashes($_POST['code']);
                        $name = addslashes($_POST['name']);
                        $category = addslashes($_POST['category']);
                        $price = addslashes($_POST['price']);
                        $quant = addslashes($_POST['quant']);
                        $min_quant = addslashes($_POST['min_quant']);
                        $price = str_replace('.', '', $price);
                        $price = str_replace(',', '.', $price);

                        $i->edit($id, $code, $name, $category, $price, $quant, $min_quant, $u->getCompany(), $u->getId());

                        header("Location: ".BASE_URL."/inventory");

                }
              $data['inventory_info'] = $i->getInfo($id, $u->getCompany());

                $this->loadTemplate('inventory_edit', $data);
     

        }
}

public function delete($id){

        $u = new Users();
        $u->setLoggedUser();
      

            if($u->hasPermission('inventory_edit')){
                $i = new Inventory();
                $i->delete($id, $u->getCompany(), $u->getId());

                header("Location: ".BASE_URL."/inventory");

            }

}

}