<?php

namespace Modules\StaffManagement\Livewire;

use Livewire\Component;
use session;

class RoleComponent extends Component
{
   public $pageroot;
   public $username;
   public $userid;       
   public $pagetitle;


   public function mount()
   {
       $this->username = session('username'); 
       $this->userid = session('userid');
   }
    public function render()
    {
        $pageroot = "Home";
        $pagetitle = "Role Model";
        $data = ['pageroot' => $pageroot,
                'pagetitle' => $pagetitle,
                'username' => $this->username,
                'userid' => $this->userid
    ];
        return view('staffmanagement::livewire.role-component')->layoutData($data);
    }
}
