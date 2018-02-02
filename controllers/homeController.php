<?php
class homeController extends controller {

    public function __construct() {
        parent::__construct();

        $u = new Users();
        if($u->isLogged() == false){
        	header("Location: ".BASE_URL."/login");
        	exit;
        	
        }
    }

    public function index() {
        $data = array();
        $u = new Users();
        $u->setLoggedUser();
        $company = new Companies($u->getCompany());
        $data['company_name'] = $company->getName();
        $data['user_email'] = $u->getEmail();

        $s = new Sales();

          $data['formases'] = array(
                '0'=>'À Vista (Dinheiro)',
                '1'=>'Débito',
                '2'=>'Credito À vista',
                '3'=>'Credito Parcelado',
                '4'=>'Crediario'

            );

        $data['products_sold'] = $s->getSoldProducts(date('Y-m-d', strtotime('-30 days')), date('Y-m-d H:i:s'), $u->getCompany());
        $data['revenue'] = $s->getTotalRevenue(date('Y-m-d', strtotime('-30 days')), date('Y-m-d H:i:s'), $u->getCompany());
        $data['days_list'] = array();
       $data['days_list'] = array();
        for($q=30;$q>0;$q--) {
            $data['days_list'][] = date('d/m', strtotime('-'.$q.' days'));
        }

         $data['revenue_list'] = $s->getRevenueList(date('Y-m-d', strtotime('-30 days')), date('Y-m-d'), $u->getCompany());


        $data['forma_list'] = $s->getFormaStatusList(date('Y-m-d', strtotime('-30 days')), date('Y-m-d'), $u->getCompany());

        $this->loadTemplate('home', $data);
    }

}


