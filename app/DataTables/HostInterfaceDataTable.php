<?php

namespace App\DataTables;

use App\Model\HostInterface;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Html\Editor\Editor;
use Yajra\DataTables\Html\Editor\Fields;
use Yajra\DataTables\Services\DataTable;

class HostInterfaceDataTable extends DataTable
{
    /**
     * Build DataTable class.
     *
     * @param mixed $query Results from query() method.
     * @return \Yajra\DataTables\DataTableAbstract
     */
    public function dataTable($query)
    {
        return datatables()
            ->eloquent($query)
            ->addColumn('action', 'hostinterface.action');
    }

    /**
     * Get query source of dataTable.
     *
     * @param \App\Model\HostInterface $model
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function query(HostInterface $model)
    {
        return $model->newQuery();
    }

    /**
     * Optional method if you want to use html builder.
     *
     * @return \Yajra\DataTables\Html\Builder
     */
    public function html()
    {
        return $this->builder()
                    ->setTableId('hostinterface-table')
                    ->columns($this->getColumns())
                    ->minifiedAjax()
                    ->dom('Bfrtip')
                    ->orderBy(1)
                    ->buttons(
                        Button::make('create'),
                        Button::make('export')
                    );
    }

    /**
     * Get columns.
     *
     * @return array
     */
    protected function getColumns()
    {
        return [
            'host_id',
            'ifname',
            'iftype',
            'ifspeed',
            'ifindex',
            'ifoperstatus',
            'ifalias',
            'portid',
            'is_mgmt',
            'discovery_protocol_id',
            'snmp_host_interface_id',
//            Column::computed('action')
//                  ->exportable(false)
//                  ->printable(false)
//                  ->width(60)
//                  ->addClass('text-center'),
//            Column::make('host_id'),
//            Column::make('ifname'),
//            Column::make('iftype'),
//            Column::make('ifspeed'),
//            Column::make('ifindex'),
//            Column::make('ifoperstatus'),
//            Column::make('ifalias'),
//            Column::make('portid'),
//            Column::make('is_mgmt'),
//            Column::make('discovery_protocol_id'),
//            Column::make('snmp_host_interface_id'),
        ];
    }

    /**
     * Get filename for export.
     *
     * @return string
     */
    protected function filename()
    {
        return 'HostInterface_' . date('YmdHis');
    }
}
