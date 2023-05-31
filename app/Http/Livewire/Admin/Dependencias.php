<?php

namespace App\Http\Livewire\Admin;

use Livewire\Component;
use App\Models\Dependencia;
use Livewire\WithPagination;
use DB;
use App\Traits\Admin\RoleOrPermissionSpatie;

class Dependencias extends Component
{
    use RoleOrPermissionSpatie;
    use WithPagination;
    public function __construct()
    {
      $this->handlePermission('Administrador de Base de Datos|DBA Junior|admin|adming');
    }
    public function render()
    {
        return view('livewire.admin.dependencias');
    }
}
