<?php

namespace Modules\AccountManagement\Http\Controllers;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Modules\AccountManagement\Entities\MasterAccess;

class MasterAccessController extends Controller
{
       public function all_master_access(){
              $items=MasterAccess::tree();
              echo  $items;
       }
}
