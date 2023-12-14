<?php

namespace App\Livewire;

use App\Models\invoice;
use App\Models\InvoiceDetail;
use App\Models\Retur;
use App\Models\ReturDetail;
use App\Models\toko;
use Livewire\Component;

class DashboardHeader extends Component
{
    public $toko, $income, $invoice, $item, $selesai, $proses;


    public function render()
    {
        $this->toko = toko::where('status', 'Active')->count();
        $this->invoice = invoice::count();

        $invoiceDetail = InvoiceDetail::sum('qty');
        $returDetail = ReturDetail::sum('qty');
        $this->item = $invoiceDetail - $returDetail;

        $invoices = Invoice::where('tagihan', 'Lunas')->get();
        $total = 0;

        foreach ($invoices as $invoice) {
            $retur = Retur::where('no_faktur', $invoice->id)->first();

            if ($retur) {
                $total += $invoice->total - $retur->total;
            } else {
                $total += $invoice->total;
            }
        }

        $this->income = $total;
        return view('livewire.components.dashboard-header');
    }
}
