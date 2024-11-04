<?php

namespace App\Http\Livewire\Admin;

use App\Models\Ordene;
use Livewire\Component;
use Livewire\WithPagination;

class ListadoOrdenes extends Component
{
    use WithPagination;

    public $search = '';
    protected $statusTypes = ["PENDIENTE", "PROCESANDO", "COMPLETADA", "CANCELADA"];

    protected $listeners = ['orderUpdated' => '$refresh'];

    public function updateOrderStatus($orderId, $status)
    {
        $order = Ordene::find($orderId);

        if (!$order) {
            session()->flash('error', 'Orden no encontrada');
            return;
        }

        $order->update([
            'estado' => $status
        ]);

        session()->flash('message', 'Estado de orden actualizado correctamente');
    }

    public function render()
    {
        $orders = Ordene::with(['user', 'ordersDetails.producto'])
            ->where(function($query) {
                $query->where('nombre', 'like', '%' . $this->search . '%')
                    ->orWhere('transaction_uuid', 'like', '%' . $this->search . '%')
                    ->orWhere('telefono', 'like', '%' . $this->search . '%');
            })
            ->orderBy('created_at', 'desc')
            ->paginate(10);

        return view('livewire.admin.listado-ordenes', [
            'orders' => $orders,
            'statusTypes' => $this->statusTypes
        ]);
    }
}
