<?php
namespace App\Http\Livewire;

use App\Models\sale;
use Spatie\Permission\Models\Role;
use Livewire\WithFileUploads;
use Livewire\WithPagination;
use Livewire\Component;
use App\Models\User;




class UsersController extends Component
{
    use WithPagination;
    use WithFileUploads;
    
    
    public $name,$phone,$email,$status,$image,$password,$selected_id,$fileLoaded,$profile;
    public $pageTitle, $componentName,$search;
    private $pagination;

    public function index(){
    return view('users.index');
    }
    public function paginationView()
    {
        return 'Vendor.Livewire.bootstrap';
    }

    public function mount()
    {
        $this->pageTitle = 'Listado';
        $this->componentName = 'Usuarios';
        $this->status ='Elegir';
        $this->pagination= 10;
    }

    public function render()
    {
        if(strlen($this->search) > 0)
        $data = User::where('name','like', '%' .$this->search . '%')
        ->select('*')->orderBy('name','asc')->get();
        else
        $data = User::orderBy('name','asc')->get();

        
        return view('livewire.users.component',[
            'data' => $data,
            'roles' => Role::orderBy('name','asc')->get()
        ])
        ->extends('layouts.theme.app')
        ->section('content');
    }

    public function resetUI()
    {
        $this->name='';
        $this->email='';
        $this->password='';
        $this->phone='';
        $this->image='';
        $this->search='';
        $this->status='Elegir';
        $this->selected_id=0;
        $this->resetValidation();
        $this->resetPage();
    }
    public function Agregar()
    {
        $this->resetUI();
        $this->emit('show-modal', 'show modal!');
    }
    public function Edit(User $user)
    {
        $this->selected_id = $user->id;
        $this->name = $user->name;
        $this->phone = $user->phone;
        $this->profile = $user->profile;
        $this->status = $user->status;
        $this->email = $user->email;
        $this->password ='';
        
        // dd('HOLA');
        $this->emit('modal-show','open!');
    }


    protected $listeners =[
        'deleteRow' => 'destroy',
        'resetUI' => 'resetUI'
    
    ];

    public function Store()
    { 
    
         $rules =[
             'name' => 'required|min:3',
             'email' => 'required|unique:users|email',
             'status' => 'required|not_in:Elegir',
             'profile' => 'required|not_in:Elegir',
             'password' => 'required|min:3'
         ];

         $messages =[
             'name.required' => 'Ingresa el nombre',
             'name.min' => 'El nombre del usuario debe tener al menos 3 caracteres',
             'email.required' => 'Ingresa el correo',
             'email.email' => 'Ingrese un correo valido',
             'email.unique' => 'El email ya existe en sistema',
             'status.required' => 'Selecciona el estatus del usuario',
             'status.not_in' => 'Selecciona el estatus',
             'profile.required' => 'Selecciona el perfil/role del usuario',
             'profile.not_in' => 'Selecciona un perfil/role distinto a Elegir',
            'password.required' => 'Ingrese el password',
             'password.min' => 'El password debe tener al menos 3 caracteres' 
         ];

         $this->validate($rules,$messages);
           
        $user = User::create([
            'name' => $this->name,
            'email' => $this->email,
            'phone' => $this->phone,
            'status' => $this->status,
            'profile' => $this->profile,
            'password' => bcrypt($this->password)
        ]);

        if($this->image)
        {
            $customFileName = uniqid() .'_.' . $this->image->extension();
            $this->image->storeAs('public/users', $customFileName);
            $user->image = $customFileName;
            $user->save();
        }

        $this->resetUI();
        $this->emit('user-added','Usuario Registrado');
    }

    public function Update()
    {
        $rules =[
            'email' => "required|email|unique:users,email,{$this->selected_id}",
            'name' => 'required|min:3',
            'status' => 'required|not_in:Elegir',
            'profile' => 'required|not_in:Elegir',
            'password' => 'required|min:3'
        ];

        $messages =[
            'name.required' => 'Ingresa el nombre',
            'name.min' => 'El nombre del usuario debe tener al menos 3 caracteres',
            'email.required' => 'Ingresa el correo',
            'email.email' => 'Ingrese un correo valido',
            'email.unique' => 'El email ya existe en sistema',
            'status.required' => 'Selecciona el estatus del usuario',
            'status.not_in' => 'Selecciona el estatus',
            'profile.required' => 'Selecciona el perfil/role del usuario',
            'profile.not_in' => 'Selecciona un perfil/role distinto a Elegir',
            'password.required' => 'Ingrese el password',
            'password.min' => 'El password debe tener al menos 3 caracteres' 
        ];

        
        $this->validate($rules,$messages);

        $user = User::find($this->selected_id);
        $user->Update([
                'name' => $this->name,
                'email' => $this->email,
                'phone' => $this->phone,
                'status' => $this->status,
                'profile' => $this->profile,
                'password' => bcrypt($this->password)
        ]);

    if($this->image)
    {
        $customFileName = uniqid() .'_.' . $this->image->extension();
        $this->image->storeAs('public/users', $customFileName);
        $imageTem = $user->image;

        $user->image = $customFileName;
        $user->save();

        if($imageTemp != null)
        {
            if(file_exists('storage/users/' . $imageTemp)) {
                unlink('storage/users' . $imageTemp);
            }
        }
    }

    $this->resetUI();
    $this->emit('user-updated','Usuario Actualizado');
}

public function destroy(User $user)
{
    if($user) {
        $sales = sale::where('user_id', $user->id)->count();
        if($sales > 0){
            $this->emit('user-withsales','No es posible eliminar el usuario porque tiene ventas registradas');
        }else {
            $user->delete();
            $this->resetUI();
            $this->emit('user-deleted','Usuario Eliminado');
        }
    }
}




}