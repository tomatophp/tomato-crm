<?php

namespace TomatoPHP\TomatoCrm\Tables;

use Illuminate\Http\Request;
use ProtoneMedia\Splade\AbstractTable;
use ProtoneMedia\Splade\Facades\Toast;
use ProtoneMedia\Splade\SpladeTable;

class AccountTable extends AbstractTable
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
        return \TomatoPHP\TomatoCrm\Models\Account::query();
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
            ->withGlobalSearch(label: trans('tomato-admin::global.search'),columns: ['id','name','username',])
            ->bulkAction(
                label: trans('tomato-admin::global.crud.delete'),
                each: fn (\TomatoPHP\TomatoCrm\Models\Account $model) => $model->delete(),
                after: fn () => Toast::danger(__('Account Has Been Deleted'))->autoDismiss(2),
                confirm: true
            )
            ->export()
            ->defaultSort('id')
            ->column(
                key: 'id',
                label: __('Id'),
                sortable: true)
            ->column(
                key: 'name',
                label: __('Name'),
                sortable: true)
            ->column(
                key: 'username',
                label: __('Username'),
                sortable: true)
            ->column(
                key: 'loginBy',
                label: __('LoginBy'),
                sortable: true)
            ->column(
                key: 'address',
                label: __('Address'),
                sortable: true)
            ->column(
                key: 'otp_code',
                label: __('Otp code'),
                sortable: true)
            ->column(
                key: 'last_login',
                label: __('Last login'),
                sortable: true)
            ->column(
                key: 'agent',
                label: __('Agent'),
                sortable: true)
            ->column(
                key: 'host',
                label: __('Host'),
                sortable: true)
            ->column(
                key: 'attempts',
                label: __('Attempts'),
                sortable: true)
            ->column(
                key: 'login',
                label: __('Login'),
                sortable: true)
            ->column(
                key: 'activated',
                label: __('Activated'),
                sortable: true)
            ->column(
                key: 'blocked',
                label: __('Blocked'),
                sortable: true)
            ->column(key: 'actions',label: trans('tomato-admin::global.crud.actions'))
            ->paginate(15);
    }
}
