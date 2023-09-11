<?php

namespace TomatoPHP\TomatoCrm\Tables;

use Illuminate\Http\Request;
use ProtoneMedia\Splade\AbstractTable;
use ProtoneMedia\Splade\Facades\Toast;
use ProtoneMedia\Splade\SpladeTable;

class LocationTable extends AbstractTable
{
    /**
     * Create a new instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Determine if the user is authorized to perform bulk actions and exports.
     *
     * @return bool
     */
    public function authorize(Request $request)
    {
        return true;
    }

    /**
     * The resource or query builder.
     *
     * @return mixed
     */
    public function for()
    {
        return \TomatoPHP\TomatoCrm\Models\Location::query();
    }

    /**
     * Configure the given SpladeTable.
     *
     * @param \ProtoneMedia\Splade\SpladeTable $table
     * @return void
     */
    public function configure(SpladeTable $table)
    {
        $table
            ->withGlobalSearch(label: trans('tomato-admin::global.search'),columns: ['id','account.name',])
            ->bulkAction(
                label: trans('tomato-admin::global.crud.delete'),
                each: fn (\TomatoPHP\TomatoCrm\Models\Location $model) => $model->delete(),
                after: fn () => Toast::danger(__('Location Has Been Deleted'))->autoDismiss(2),
                confirm: true
            )
            ->export()
            ->defaultSort('id')
            ->column(
                key: 'id',
                label: __('Id'),
                sortable: true,
                hidden: true
            )
            ->column(
                key: 'account.name',
                label: __('Account'),
                sortable: true,
                searchable: true)
            ->column(
                key: 'street',
                label: __('Street'),
                sortable: true)
            ->column(
                key: 'area.name',
                label: __('Area'),
                sortable: true)
            ->column(
                key: 'city.name',
                label: __('City'),
                sortable: true)
            ->column(
                key: 'country.name',
                label: __('Country'),
                sortable: true)
            ->column(key: 'actions',label: trans('tomato-admin::global.crud.actions'))
            ->paginate(15);
    }
}
