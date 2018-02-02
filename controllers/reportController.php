<?php

class reportController extends controller{


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

        $s = new Sales();

            if($u->hasPermission('report_view')){

        $data['days_list'] = array();
       $data['days_list'] = array();
        for($q=30;$q>0;$q--) {
            $data['days_list'][] = date('d/m', strtotime('-'.$q.' days'));
        }

         $data['revenue_list'] = $s->getRevenueList(date('Y-m-d', strtotime('-30 days')), date('Y-m-d'), $u->getCompany());


            

                $this->loadTemplate('report', $data);
        }else{
            header("Location: ".BASE_URL);

        } 

         
    }




public function sales(){
       $data = array();
        $u = new Users();
        $u->setLoggedUser();
        $company = new Companies($u->getCompany());
        $data['company_name'] = $company->getName();
        $data['user_email'] = $u->getEmail();

         $data['formases'] = array(
                '0'=>'À Vista (Dinheiro)',
                '1'=>'Débito',
                '2'=>'Credito À vista',
                '3'=>'Credito Parcelado',
                '4'=>'Crediario'

            );

        $data['statuses'] = array(
                '0'=>'Pago',
                '1'=>'Cancelado',
                '2'=>'Orçamento'
            );

            if($u->hasPermission('report_view')){
            

                $this->loadTemplate('report_sales', $data);
        }else{
            header("Location: ".BASE_URL);

        } 

}

public function sales_pdf(){

      $data = array();
        $u = new Users();
        $u->setLoggedUser();

         $data['formases'] = array(
                '0'=>'À Vista (Dinheiro)',
                '1'=>'Débito',
                '2'=>'Credito À vista',
                '3'=>'Credito Parcelado',
                '4'=>'Crediario'

            );

        $data['statuses'] = array(
                '0'=>'Pago',
                '1'=>'Cancelado',
                '2'=>'Orçamento'

            );

            if($u->hasPermission('report_view')){
                    $client_name = addslashes($_GET['client_name']);
                    $salesman_name_vendedor = addslashes($_GET['salesman_name_vendedor']);
                    $period1 = addslashes($_GET['period1']);
                    $period2 = addslashes($_GET['period2']);
                    $status = addslashes($_GET['status']);
                    $forma = addslashes($_GET['forma']);
                    $order = addslashes($_GET['order']);
                    
                    $s = new Sales();
                    $data['sales_list'] = $s->getSalesFiltered($client_name, $salesman_name_vendedor,
                     $period1, $period2, $status, $forma  ,$order, $u->getCompany());

                    $data['filters'] = $_GET;


                    $this->loadLibrary('mpdf60/mpdf');

            ob_start();
            $this->loadView("report_sales_pdf", $data);
            $html = ob_get_contents();
            ob_end_clean();

            $mpdf = new mPDF();
            $mpdf->WriteHTML($html);
            $mpdf->Output();


        }else{
            header("Location: ".BASE_URL);

        } 


}


public function inventory(){

      $data = array();
        $u = new Users();
        $u->setLoggedUser();
        $company = new Companies($u->getCompany());
        $data['company_name'] = $company->getName();
        $data['user_email'] = $u->getEmail();

          $data['categoriases'] = array(
                '0'=>'Vendas Diretas',
                '1'=>'Serviços'

            );

            if($u->hasPermission('report_view')){
            

                $this->loadTemplate('report_inventory', $data);
        }else{
            header("Location: ".BASE_URL);

        } 

}


public function inventory_pdf(){

      $data = array();
        $u = new Users();
        $u->setLoggedUser();

          $data['categoriases'] = array(
                '0'=>'Vendas Diretas',
                '1'=>'Serviços'

            );

            if($u->hasPermission('report_view')){
                    $category = addslashes($_GET['category']);
                    $i = new Inventory();

                    $data['inventory_list'] = $i->getInventoryFiltered($category, $u->getCompany());

                         $data['filters'] = $_GET;


                    $this->loadLibrary('mpdf60/mpdf');

            ob_start();
            $this->loadView("report_inventory_pdf", $data);
            $html = ob_get_contents();
            ob_end_clean();

            $mpdf = new mPDF();
            $mpdf->WriteHTML($html);
            $mpdf->Output();


        }else{
            header("Location: ".BASE_URL);

        } 


}



public function accounts(){
       $data = array();
        $u = new Users();
        $u->setLoggedUser();
        $company = new Companies($u->getCompany());
        $data['company_name'] = $company->getName();
        $data['user_email'] = $u->getEmail();

        
           $data['payses'] = array(
                '0'=>'NÃO',
                '1'=>'SIM'

            );

            if($u->hasPermission('report_view')){
            

                $this->loadTemplate('report_accounts', $data);
        }else{
            header("Location: ".BASE_URL);

        } 

}

public function accounts_pdf(){

      $data = array();
        $u = new Users();
        $u->setLoggedUser();

        

           $data['payses'] = array(
                '0'=>'NÃO',
                '1'=>'SIM'

            );


            if($u->hasPermission('report_view')){
                    $period1 = addslashes($_GET['period1']);
                    $period2 = addslashes($_GET['period2']);
                    $pay = addslashes($_GET['pay']);
                    
                    $s = new Accounts();
                    $data['accounts_list'] = $s->getAccountsFiltered($period1, $period2, $pay, $u->getCompany());

                    $data['filters'] = $_GET;


                    $this->loadLibrary('mpdf60/mpdf');

            ob_start();
            $this->loadView("report_accounts_pdf", $data);
            $html = ob_get_contents();
            ob_end_clean();

            $mpdf = new mPDF();
            $mpdf->WriteHTML($html);
            $mpdf->Output();


        }else{
            header("Location: ".BASE_URL);

        } 



    }


    }