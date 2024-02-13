<?php
class MemberServices extends BaseSQLMapperService
{
    private $f3;
    public $db;

    function __construct($db)
	{
		$this->f3 = Base::instance();
        $this->db = $db;
		parent::__construct($db,"tblmember");
	}

    function add()
    {
        if ($_SERVER['REQUEST_METHOD'] == 'POST')
        {
            $id             = $this->f3->get('POST.id');
            $first_name     = $this->f3->get('POST.first_name');
            $last_name      = $this->f3->get('POST.last_name');
            $contact        = $this->f3->get('POST.contact');
            $amount         = $this->f3->get('POST.amount');
            $address        = $this->f3->get('POST.address');

            if($id>0){
                $this->load(['id = ?',$id]);
                $this->first_name      = $first_name;
                $this->last_name       = $last_name;
                $this->contact         = $contact;
                $this->amount          = $amount;
                $this->address         = $address;
                $this->update();
                $data = ['success'=> true, 'message'=> 'ແກ້ໄຂສຳເລັດແລ້ວ'];
            }else{
                $this->first_name   = $first_name;
                $this->last_name    = $last_name;
                $this->contact      = $contact;
                $this->amount       = $amount;
                $this->address      = $address;
                $this->save();
                $data = ['success'=> true, 'message'=> 'ເພີ່ມສຳເລັດແລ້ວ'];
            }
        }
        API::success($data);
    }
}