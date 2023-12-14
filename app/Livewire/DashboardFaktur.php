<?php

namespace App\Livewire;

use App\Models\invoice;
use App\Models\toko;
use Livewire\Component;
use Livewire\WithPagination;

class DashboardFaktur extends Component
{
    use WithPagination;
    public $selesai, $proses;
    public function mount()
    {
        $this->selesai = invoice::where('status', 'selesai')->count();
        $this->proses = invoice::where('status', 'proses')->count();
    }

    public function render()
    {
        $data = invoice::inRandomOrder()->paginate(7);
        foreach ($data as $item) {
            $item->toko = toko::find($item->id_toko)->nama_toko;
        }
        return view('livewire.components.dashboard-faktur', [
            'data' => $data
        ]);
    }
}
