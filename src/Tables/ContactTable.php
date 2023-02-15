<?php

namespace TomatoPHP\TomatoCrm\Tables;

use Illuminate\Http\Request;
use ProtoneMedia\Splade\AbstractTable;
use ProtoneMedia\Splade\Facades\Toast;
use ProtoneMedia\Splade\SpladeTable;

class ContactTable extends AbstractTable
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
        return \TomatoPHP\TomatoCrm\Models\Contact::query();
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
            ->withGlobalSearch(label: trans('tomato-admin::global.search'),columns: ['id','type.name','status.name','name','email','phone',])
            ->bulkAction(
                label: trans('tomato-admin::global.crud.delete'),
                each: fn (\TomatoPHP\TomatoCrm\Models\Contact $model) => $model->delete(),
                after: fn () => Toast::danger(__('Contact Has Been Deleted'))->autoDismiss(2),
                confirm: true
            )
            ->export()
            ->defaultSort('id')
            ->column(
                key: 'type.name',
                label: __('Type'),
                sortable: true,
                searchable: true)
            ->column(
                key: 'status.name',
                label: __('Status'),
                sortable: true,
                searchable: true)
            ->column(
                key: 'name',
                label: __('Name'),
                sortable: true)
            ->column(
                key: 'subject',
                label: __('Subject'),
                sortable: true)
            ->column(
                key: 'active',
                label: __('Active'),
                sortable: true)
            ->column(key: 'actions',label: trans('tomato-admin::global.crud.actions'))
            ->paginate(15);
    }
}
