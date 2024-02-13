<?php
class APIController{
    public $db;
    private $help;
    function __construct(){
        $this->db = DBConfig::config();
    }

    public function storeData(){
        $Svr = new CallbackServices($this->db);
        $Svr->add();
    }

    public function reportIncome(){
        $f3    = Base::instance();
        $custom = new CustomFunctions();

        $arrType = $custom->getIncomeType();
        $type    = $f3->get('GET.type') ?? '';
        $start   = $f3->get('GET.start') ?? date('Y-m-d');
        $end     = $f3->get('GET.end') ?? date('Y-m-d');

        $items = $this->db->exec("SELECT * FROM tblincome WHERE type_income = ? AND date_income BETWEEN ? AND ?",[$type,date('Y-m-d',strtotime($start)),date('Y-m-d',strtotime($end))]);
        $total_amount = 0;
        $arr          = [];
        foreach ($items as $row) {
            $arr[] = array(
                'id'          => $row['id'],
                'type_income' => $arrType[$row['type_income']],
                'amount'      => $row['amount'],
                'date_income' => date('d-m-Y',strtotime($row['date_income'])),
                'note'        => $row['note'],
                'created_at'  => $row['created_at'],
            );
            $total_amount += $row['amount'];
        }
        API::success(['success'=>true,'items'=>$arr,'total_amount'=>$total_amount]);
    }

    public function reportPayment(){
        $f3           = Base::instance();
        $start        = $f3->get('GET.start') ?? date('Y-m-d');
        $end          = $f3->get('GET.end') ?? date('Y-m-d');

        $items   = $this->db->exec("SELECT * FROM tblpayments WHERE payment_date BETWEEN ? AND ?",[date('Y-m-d',strtotime($start)),date('Y-m-d',strtotime($end))]);
        $total_amount = 0;
        $arr          = [];
        $arrCreator   = [];
      
        foreach ($items as $row) {
            $listItems = $this->db->exec("SELECT * FROM  tblpayment_lists WHERE bill_no = ?",[$row['bill_no']]);
            $arrList = array();
            foreach ($listItems as $value) {
                $arrList[] = $value;
            }
            $arr[] = array(
                'bill_no'            => $row['bill_no'],
                'reference_no'       => $row['reference_no'],
                'description'        => $row['description'],
                'total_amount'       => $row['total_amount'],
                'payment_date'       => date('d-m-Y',strtotime($row['payment_date'])),
                'created_by_user_id' => $row['created_by_user_id'],
                'created_at'         => $row['created_at'],
                'items'=> $arrList,
            );
            $total_amount += $row['total_amount'];
        }
        API::success(['success' => true,'items'=>$arr,'total_amount'=>$total_amount]);
    }
}