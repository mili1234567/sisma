<?php

namespace App\Http\Livewire;

use Livewire\Component;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;
use Livewire\WithPagination;
use App\Models\User;
use DB;

class PermisosController extends Component
{
    use WithPagination;
    public $permissionName, $search, $selected_id, $pageTitle, $componentName;
    private $pagination = 10;

    public function paginationView()
    {
        return 'vendor.livewire.bootstrap';
    }

    public function mount()
    {
        $this->pageTitle = 'Listado';
        $this->componentName = 'Permisos';
    }

    public function render()
    {
        if(strlen($this->search) > 0)
            $permisos = Permission::where('name','like','%' . $this->search . '%')->paginate($this->pagination);
        else
            $permisos = Permission::orderBy('name','asc')->paginate($this->pagination);

        return view('livewire.permisos.component',[
            'permisos' => $permisos
        ])
        ->extends('layouts.theme.app')
        ->section('content');
    }


    public function Create_Permission()
    {
        $rules = ['permissionName' => 'required|min:2|unique:permissions,name'];

        $messages = [
            'permissionName.required' => 'el nombre del permiso es requerido',
            'permissionName.unique' => 'el permiso ya existe',
            'permissionName.min' => 'el nombre del permiso debe tener al menos 2 caracteres'
        ];

        $this->validate($rules, $messages);

        Permission::create(['name' => $this->permissionName]);
        $this->emit('permiso-added', 'se registro el permiso con exito');
        $this->resetUI();
    }

    public function Edit(Permission $permiso)
    {
        $this->selected_id = $permiso->id;
        $this->permissionName = $permiso->name;

        $this->emit('show-modal', 'show modal');
    }

    public function UpdatePermission()
    {
        $rules = ['permissionName' => "required|min:2|unique:permissions,name, {$this->selected_id}"];

        $messages = [
            'permissionName.required' => 'el nombre del permiso es requerido',
            'permissionName.unique' => 'el permiso ya existe',
            'permissionName.min' => 'el nombre del permiso debe tener al menos 2 caracteres'
        ];

        $this->validate($rules, $messages);

        $permiso = Permission::find($this->selected_id);
        $permiso->name = $this->permissionName;
        $permiso->save();

        $this->emit('permiso-updated', 'se actualizo el permiso con exito');
        $this->resetUI();
    }

    protected $listeners = ['destroy' => 'Destroy'];

    public function Destroy($id)
    {
        $rolesCount = Permission::find($id)->getRoleNames()->count();

        if ($rolesCount > 0) {
            $this->emit('item-error', 'No se puede eliminar el permiso por que tiene roles asociados');
            return;
        }

        Permission::find($id)->delete();
        $this->emit('item-deleted', 'Se eliminó el permiso con exito');
    }

    public function resetUI()
    {
        $this->permissionName = '';
        $this->search = '';
        $this->selected_id = 0;
        $this->resetValidation();
    }
}
