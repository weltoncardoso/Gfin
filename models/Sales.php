<?php 

class Sales extends model{

    public function getList($offset, $id_company){
        $array = array();


            $sql = $this->db->prepare("SELECT * FROM sales WHERE  id_company = :id_company LIMIT $offset, 10");
            $sql->bindValue(":id_company", $id_company);
            $sql->execute();

            if($sql->rowCount() > 0){
                $array = $sql->fetchAll();
            }


        $sql = $this->db->prepare("
            SELECT 
                sales.id, 
                sales.date_sale,
                sales.desconto,
                sales.total_price,
                sales.status,
                sales.forma,
                sales.nfe_key,
                clients.name,
                clients.cpf,
                clients.cnpj,
                clients.adress_zipcode,
                clients.adress,
                clients.adress_number,
                clients.adress_neighb,
                clients.adress_state,
                clients.adress_city,
                salesman.name_vendedor
            FROM sales
            LEFT JOIN clients ON clients.id = sales.id_client  LEFT JOIN salesman ON salesman.id = sales.id_salesman  
            WHERE 
                sales.id_company = :id_company
            ORDER BY  sales.date_sale DESC
            LIMIT $offset, 10");


     $sql->bindValue(":id_company", $id_company);
        $sql->execute();

        if($sql->rowCount() > 0){
            $array = $sql->fetchAll();
        }

        return $array;
    }   



public function getCount($id_company){
    $r = 0;

    $sql = $this->db->prepare("SELECT COUNT(*) as s FROM sales WHERE id_company = :id_company");
    $sql->bindValue(":id_company" , $id_company);
    $sql->execute();


    $row = $sql->fetch();
        $r = $row['s'];

    return $r;

}


public function getAllInfo($id_sale, $id_company){
        $array = array();

            $sql = "SELECT * FROM sales WHERE id = :id";

            $sql = $this->db->prepare($sql);
            $sql->bindValue(":id", $id_sale);
            $sql->execute();

             if($sql->rowCount() > 0){
            $array['info'] = $sql->fetch();
         

        }

        $sql = "SELECT id_product, quant, sale_price FROM sales_products WHERE id_sale = :id_sale";
    $sql = $this->db->prepare($sql);
    $sql->bindValue(":id_sale", $id_sale);
    $sql->execute();


       
     
            if($sql->rowCount() > 0){
            $array['products'] = $sql->fetchAll();
                    $i = new Inventory();

            foreach ($array['products'] as $pkey => $pval) {
                    $array['products'][$pkey]['c'] = $i->getInfo($pval['id_product'], $id_company);


            }

        }

        return $array;

}

public function setNFEKey($chave, $id_sale){

    $sql = $this->db->prepare("UPDATE sales SET nfe_key = :nfe_key WHERE id = :id ");
    $sql->bindValue(":nfe_key", $chave);
    $sql->bindValue(":id", $id_sale);
    $sql->execute();
}



    public function cdd($id_company, $name,  $email = '', $cpf = '', $cnpj = '', $phone = '', $stars = '3', $internal_obs = '', $adress_zipcode = '', $adress = '', $adress_number = '', $adress_neighb = '', $adress2 = '', $adress_city = '', $adress_state = '', $adress_country = '', $adress_citycode = ''){
$sql = $this->db->prepare("INSERT INTO clients SET id_company = :id_company, name = :name, email = :email,  cpf = :cpf, cnpj = :cnpj, phone = :phone, stars = :stars, internal_obs = :internal_obs, adress_zipcode = :adress_zipcode, adress = :adress, adress_number = :adress_number, adress_neighb = :adress_neighb, adress2 = :adress2, adress_city = :adress_city, adress_citycode = :adress_citycode, adress_state = :adress_state, adress_country = :adress_country, adress_countrycode = 1058");

$sql->bindValue(":id_company", $id_company);
$sql->bindValue(":name", $name);
$sql->bindValue(":email", $email);
$sql->bindValue(":cpf", $cpf);
$sql->bindValue(":cnpj", $cnpj);
$sql->bindValue(":phone", $phone);
$sql->bindValue(":stars", $stars);
$sql->bindValue(":internal_obs", $internal_obs);
$sql->bindValue(":adress_zipcode", $adress_zipcode);
$sql->bindValue(":adress", $adress);
$sql->bindValue(":adress_number", $adress_number);
$sql->bindValue(":adress_neighb", $adress_neighb);
$sql->bindValue(":adress2", $adress2);
$sql->bindValue(":adress_city", $adress_city);
$sql->bindValue(":adress_citycode", $adress_citycode);
$sql->bindValue(":adress_state", $adress_state);
$sql->bindValue(":adress_country", $adress_country);
$sql->execute();

    return $this->db->lastInsertId();


    }


   public function addSale($id_company, $id_client, $id_salesman, $user_id, $quant, 
    $status, $forma, $desconto = '',  $name,  $email = '', $cpf = '', $cnpj = '', $phone = '', $stars = '3', $internal_obs = '', $adress_zipcode = '', $adress = '', $adress_number = '', $adress_neighb = '', $adress2 = '', $adress_city = '', $adress_state = '', $adress_country = '', $adress_citycode = ''){
        $i = new Inventory();
         
        //inserindo a venda
        $sql = $this->db->prepare("INSERT INTO sales SET id_company = :id_company,
         id_client = :id_client, id_salesman = :id_salesman,
          id_user = :id_user, date_sale = NOW(), total_price = :total_price,
           status = :status, forma = :forma, desconto = :desconto");
    
        $sql->bindValue(":id_company", $id_company);
        $sql->bindValue(":id_client", $id_client);
        $sql->bindValue(":id_salesman", $id_salesman);
        $sql->bindValue(":id_user", $user_id);
        $sql->bindValue(":total_price",  '0');
        $sql->bindValue(":desconto", $desconto);
        $sql->bindValue(":status", $status);
        $sql->bindValue(":forma", $forma);

        $sql->execute();

        $id_sale = $this->db->lastInsertId();
        

//inserido produtos
       $total_price = 0;
        

        foreach ($quant as $id_prod => $quant_prod) {
            $sql = $this->db->prepare("SELECT price FROM inventory WHERE id = :id AND
            id_company = :id_company");

        $sql->bindValue(":id_company", $id_company);
        $sql->bindValue(":id", $id_prod);
        $sql->execute();

        if($sql->rowCount() > 0){
            $row = $sql->fetch();
            $price = $row['price'];
            $sqlp = $this->db->prepare("INSERT INTO sales_products SET id_company = :id_company, id_sale = :id_sale,
             id_product = :id_product, quant = :quant, sale_price = :sale_price");
            $sqlp->bindValue(":id_company", $id_company);
            $sqlp->bindValue(":id_sale", $id_sale);
            $sqlp->bindValue(":id_product", $id_prod);
            $sqlp->bindValue(":sale_price", $price);
            $sqlp->bindValue(":quant", $quant_prod);
            $sqlp->execute();



//removendo produto do estoque
            $i->downInventory($id_prod, $id_company, $quant_prod, $user_id );


            $total_price += $price * $quant_prod;
             }

        }

//atualiza o preço final da venda
        $sql = $this->db->prepare("UPDATE sales SET total_price = :total_price WHERE id = :id");
        $sql->bindValue(":total_price", $total_price-$desconto);
        $sql->bindValue(":id", $id_sale);
        $sql->execute();
    }

    public function getInfo($id, $id_company){
        $array = array();

        $sql = $this->db->prepare("
        SELECT
         *,
         ( select clients.name from clients where clients.id = sales.id_client ) as client_name,
         ( select salesman.name_vendedor from salesman where salesman.id = sales.id_salesman ) as salesman_name_vendedor
        FROM sales 
        WHERE
         id = :id AND
          id_company = :id_company");

 $sql->bindValue(":id", $id);
        $sql->bindValue(":id_company", $id_company);
        $sql->execute();

          if($sql->rowCount() > 0){
            $array['info'] = $sql->fetch();

        }




        $sql = $this->db->prepare("
            SELECT
               sales_products.quant,
               sales_products.sale_price,
               inventory.name,
               inventory.code
               FROM sales_products
               LEFT JOIN inventory
                ON inventory.id = sales_products.id_product
               WHERE
                 sales_products.id_sale = :id_sale AND
                 sales_products.id_company = :id_company");
        $sql->bindValue(":id_sale", $id);
        $sql->bindValue(":id_company", $id_company);
        $sql->execute();
           


          if($sql->rowCount() > 0){
            $array['products'] = $sql->fetchAll();

        }
   


        return $array;
    }

    public function changeStatus($status, $id, $id_company){
        $sql = $this->db->prepare("UPDATE sales SET status = :status WHERE id = :id AND id_company = :id_company");
        $sql->bindValue(":status", $status);
        $sql->bindValue(":id", $id);
        $sql->bindValue(":id_company", $id_company);
        $sql->execute();

    }


    public function getSalesFiltered($client_name, $salesman_name_vendedor, $period1, $period2, $status, $forma, $order, $id_company){
        $array = array();
                $sql = "SELECT 
                clients.name,
                salesman.name_vendedor,
                sales.date_sale,
                sales.status,
                sales.forma,
                sales.total_price
                FROM sales
                 LEFT JOIN clients ON clients.id = sales.id_client  LEFT JOIN salesman ON salesman.id = sales.id_salesman
                 WHERE ";

                $where = array();
                $where[] = "sales.id_company = :id_company";

                if(!empty($client_name)){
                    $where[] = "clients.name LIKE '%".$client_name."%'";
                }

                if(!empty($salesman_name_vendedor)){
                    $where[] = "salesman.name_vendedor LIKE '%".$salesman_name_vendedor."%'";
                }

                if(!empty($period1) && !empty($period2)){
                    $where[] = "sales.date_sale BETWEEN :period1 AND :period2";
                }

                if($status != ''){
                    $where[] = "sales.status = :status";
                }

                 if($forma != ''){
                    $where[] = "sales.forma = :forma";
                }

                $sql .= implode(' AND ', $where);

                    

                switch ($order) {
                    case 'date_desc':
                    default:
                        $sql .=" ORDER BY sales.date_sale DESC";
                        break;

                    case 'date_asc':
                        $sql .=" ORDER BY sales.date_sale ASC";
                        break;

                    case 'status':
                        $sql .=" ORDER BY sales.status";
                        break;

                    case 'forma':
                        $sql .=" ORDER BY sales.forma";
                        break;
                }

                    
                $sql = $this->db->prepare($sql);
                $sql->bindValue(":id_company", $id_company);


                if(!empty($period1) && !empty($period2)){
                    $sql->bindValue(":period1", $period1);
                    $sql->bindValue(":period2", $period2);
                }

                if($status != ''){
                    $sql->bindValue(":status", $status);
                }

                 if($forma != ''){
                    $sql->bindValue(":forma", $forma);
                }
                
                $sql->execute();

                if($sql->rowCount() > 0){
                $array = $sql->fetchAll();
            }

        return $array;
    }


    public function getTotalRevenue($period1, $period2, $id_company){
        $float = 0;

        $sql = "SELECT SUM(total_price) as total FROM sales WHERE id_company =
         :id_company AND date_sale BETWEEN :period1 AND :period2";
        
        $sql = $this->db->prepare($sql);
        $sql->bindValue(':id_company', $id_company);
        $sql->bindValue(':period1', $period1);
        $sql->bindValue(':period2', $period2);

        $sql->execute();
     

         $n = $sql->fetch();
        $float = $n['total'];                                                                                              

        return $float;
    }


 public function getTotalExpenses($period1, $period2, $id_company){
        $float = 0;

        $sql = "SELECT SUM(total_price) as total FROM purchases WHERE id_company = :id_company 
        AND date_purchase BETWEEN :period1 AND :period2";
        
        $sql = $this->db->prepare($sql);
        $sql->bindValue(':id_company' , $id_company);
        $sql->bindValue(':period1', $period1);
        $sql->bindValue(':period2', $period2);

        $sql->execute();
        
        $n = $sql->fetch();
        $float = $n['total'];

        return $float;
    }



public function getSoldProducts($period1, $period2, $id_company){
       $int = 0;

        $sql = "SELECT id FROM sales WHERE id_company = :id_company 
        AND date_sale BETWEEN :period1 AND :period2";
        //die(var_dump($sql));
        $sql = $this->db->prepare($sql);
        $sql->bindValue(':id_company' , $id_company);
        $sql->bindValue(':period1', $period1);
        $sql->bindValue(':period2', $period2);
        $sql->execute();

        if($sql->rowCount() >0){
            $p = array();
            foreach ($sql->fetchAll() as $sale_item) {
                $p[] = $sale_item['id'];
                
                }
                $sql = "SELECT COUNT(*) as total FROM sales_products WHERE id_sale IN (".implode(',', $p).")";
                //die(var_dump($sql));
                $sql = $this->db->query($sql);

                $n = $sql->fetch();
               $int = $n['total'];


        }


       return $int;
    }
 
 public function getRevenueList($period1, $period2, $id_company) {
        $array = array();
        $currentDay = $period1;
        while($period2 != $currentDay) {
            $array[$currentDay] = 0;
            $currentDay = date('Y-m-d', strtotime('+1 day', strtotime($currentDay)));
        }

        $sql = "SELECT DATE_FORMAT(date_sale, '%Y-%m-%d') as date_sale, SUM(total_price) as total FROM sales 
        WHERE id_company = :id_company AND date_sale BETWEEN :period1 AND :period2 GROUP BY DATE_FORMAT(date_sale, '%Y-%m-%d')";
        $sql = $this->db->prepare($sql);
        $sql->bindValue(':id_company', $id_company);
        $sql->bindValue(':period1', $period1);
        $sql->bindValue(':period2', $period2);
        $sql->execute();

        if($sql->rowCount() > 0) {
            $rows = $sql->fetchAll();

            foreach($rows as $sale_item) {
                $array[$sale_item['date_sale']] = $sale_item['total'];
            }
        }


        return $array;
    }


    public function getExpensesList($period1, $period2, $id_company) {
        $array = array();
        $currentDay = $period1;
        while($period2 != $currentDay) {
            $array[$currentDay] = 0;
            $currentDay = date('Y-m-d', strtotime('+1 day', strtotime($currentDay)));
        }

        $sql = "SELECT DATE_FORMAT(date_purchase, '%Y-%m-%d') as date_purchase, SUM(total_price) as total FROM purchases WHERE id_company = :id_company AND date_purchase BETWEEN :period1 AND :period2 GROUP BY DATE_FORMAT(date_purchase, '%Y-%m-%d')";
        $sql = $this->db->prepare($sql);
        $sql->bindValue(':id_company', $id_company);
        $sql->bindValue(':period1', $period1);
        $sql->bindValue(':period2', $period2);
        $sql->execute();

        if($sql->rowCount() > 0) {
            $rows = $sql->fetchAll();

            foreach($rows as $sale_item) {
                $array[$sale_item['date_purchase']] = $sale_item['total'];
            }
        }


        return $array;
    }

    public function getFormaStatusList($period1, $period2, $id_company) {
        $array = array('0'=>0, '1'=>0, '2'=>0, '3'=>0, '4'=>0);

        $sql = "SELECT COUNT(id) as total, forma FROM sales WHERE id_company = :id_company AND date_sale BETWEEN :period1 AND :period2 GROUP BY forma ORDER BY forma ASC";
        $sql = $this->db->prepare($sql);
        $sql->bindValue(':id_company', $id_company);
        $sql->bindValue(':period1', $period1);
        $sql->bindValue(':period2', $period2);
        $sql->execute();

        if($sql->rowCount() > 0) {
            $rows = $sql->fetchAll();

            foreach($rows as $sale_item) {
                $array[$sale_item['forma']] = $sale_item['total'];
            }
        }

        return $array;
    }

}


   
