<?php

namespace App\Http\Livewire\Admin;

use App\Models\User as ModelsUser;
use Livewire\Component;
use Livewire\WithPagination;

class User extends Component
{
    use WithPagination;
    protected $paginationTheme = 'bootstrap';

    public $admin, $petugas, $peminjam;

    public function admin()
    {
        $this->format();
        $this->admin = true;
    }
  
    public function petugas()
    {
        $this->format();
        $this->petugas = true;
    }
  
    public function peminjam()
    {
        $this->format();
        $this->peminjam = true;
    }

    public function render()
    {
        if ($this->admin) {
            $user = ModelsUser::role('admin')->paginate(5);
        }elseif ($this->petugas) {
            $user = ModelsUser::role('petugas')->paginate(5);
        }elseif ($this->peminjam) {
            $user = ModelsUser::role('peminjam')->paginate(5);
        } else {
            $user = ModelsUser::paginate(5);
        }
        
        return view('livewire.admin.user', compact('user'));
    }

    public function format()
    {
        $this->admin = false;
        $this->petugas = false;
        $this->peminjam = false;
    }
}
