<?php
class ActionController{
    private $f3;
    private $tmp;
    private $Svr;
    public $serviceName, $fileName, $nav, $subnav, $strAction;
    function __construct($serviceName,$fileName,$nav,$subnav,$strAction){
        $this->f3 = Base::instance();
        $this->tmp = new Template;
        $objectReflection = new ReflectionClass($serviceName);
		$this->Svr = $objectReflection->newInstanceArgs(array($this->db));
        $this->nav = $nav;
	    $this->subnav = $subnav;
	    $this->strAction = $strAction;
	    $this->fileName = $fileName;
    }

    public function edit(){
        if ($this->f3->get('PARAMS.id') == null){
        	$this->f3->set('strAction',"ເພີ່ມ".$this->strAction);
        	$this->f3->set('method', 'POST');
        	$this->f3->set('item', []);
        } else {
    	   $this->f3->set('strAction',"ແກ້ໄຂ".$this->strAction);
    	   $this->f3->set('method', 'PUT');
           $this->f3->set('item',$this->Svr->getById($this->f3->get('PARAMS.id')));
        }
        $this->f3->set('nav', $this->nav);
        $this->f3->set('subnav', $this->subnav);
		$this->f3->set('strPage', $this->strAction);
        $this->f3->set('id', $this->f3->get('PARAMS.id') ?? 0);
        echo($this->tmp->render($this->fileName));
    }

    public function delete(){
		$id = $this->f3->get('PARAMS.id');
		if ($this->Svr->delete($id)){
			$data = ['success' => true, 'message' => 'ລຶບສຳເລັດແລ້ວ!'];
		} else {
			$data = ['success' => false, 'message' => 'ກະລຸນາລອງໃໝ່ອີກຄັ້ງ!'];
		}
		API::success($data);
	}

    public function delData(){
        $this->Svr->delData();
    }
    
    public function profile(){
        $this->f3->set('strAction',$this->strAction);
        $this->f3->set('method', 'PUT');
        $this->f3->set('nav', $this->nav);
        $this->f3->set('subnav', $this->nav);
        $this->f3->set('strPage', $this->strAction);
        $this->f3->set('id', $this->f3->get('LOGON_USER_ID'));
        $this->f3->set('item',$this->Svr->getById($this->f3->get('LOGON_USER_ID')));
        echo($this->tmp->render($this->fileName));
    }

    public function storeAccess(){
        $this->Svr->access();
    }

    public function storeStatus(){
        $this->Svr->status();
    }

    public function storeProfile(){
        $this->Svr->profile();
    }

    public function storeOrderNum(){
        $this->Svr->orderNum();
    }
    function storeUser(){
        $this->Svr->add();
    }
    function storeMember(){
        $this->Svr->add();
    }
}