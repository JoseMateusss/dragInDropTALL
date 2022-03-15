<?php

namespace App\Http\Livewire;

use App\Models\SalesOrder;
use lluminate\Database\Eloquent\Builder;
use Illuminate\Support\Collection;
use Asantibanez\LivewireStatusBoard\LivewireStatusBoard;

class SalesOrdersStatusBoard extends LivewireStatusBoard
{
    public function statuses() : Collection 
    {
        return collect([
            [
                'id' => 'registered',
                'title' => 'Atividade resgistrada',
            ],
            [
                'id' => 'awaiting_confirmation',
                'title' => 'Aguardando confirmação',
            ],
            [
                'id' => 'confirmed',
                'title' => 'Em andamento',
            ],
            [
                'id' => 'delivered',
                'title' => 'Entregue',
            ]
        ]);
    }

    public function records() : Collection 
    {
        
        return SalesOrder::orderBy('activity_order')->get();
           
        
    }

    public function onStatusSorted($recordId, $statusId, $orderedIds)
    {
        foreach ($orderedIds as $key => $value) {
            SalesOrder::where('id', $value)->update(['activity_order' => $key]);
        }
    }

    public function onStatusChanged($recordId, $statusId, $fromOrderedIds, $toOrderedIds)
    {
        foreach ($toOrderedIds as $key => $value) {
            SalesOrder::where('id', $value)->update(['activity_order' => $key]);
        }
        SalesOrder::where('id', $recordId)->update(['status' => $statusId]);
    }
    public function onRecordClick($recordId)
    {
        dd($recordId);
    }

    public function styles()
    {
        $baseStyles = parent::styles();

        $baseStyles['wrapper'] = 'w-full flex space-x-4 overflow-x-auto bg-blue-500 px-4 py-8';

        $baseStyles['statusWrapper'] = 'flex-1';

        $baseStyles['status'] = 'bg-gray-200 rounded px-2 flex flex-col flex-1';

        $baseStyles['statusHeader'] = 'text-sm font-medium py-2 text-gray-700';

        $baseStyles['statusRecords'] = 'space-y-2 px-1 pt-2 pb-2';

        $baseStyles['record'] = 'shadow bg-white p-2 rounded border text-sm text-gray-800';

        return $baseStyles;
    }
}
