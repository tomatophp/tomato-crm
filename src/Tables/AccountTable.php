<?php

namespace TomatoPHP\TomatoCrm\Tables;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;
use ProtoneMedia\Splade\AbstractTable;
use ProtoneMedia\Splade\Facades\Toast;
use ProtoneMedia\Splade\SpladeTable;
use TomatoPHP\TomatoCategory\Models\Type;

class AccountTable extends AbstractTable
{
    /**
     * Create a new instance.
     *
     * @return void
     */
    public function __construct(
        public ?Builder $query
    )
    {
       if(!$this->query){
           $this->query = config('tomato-crm.model')::query();
       }
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
        return $this->query;
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
            ->withGlobalSearch(label: trans('tomato-admin::global.search'),columns: ['id','name','username','email', 'phone'])
            ->bulkAction(
                label: trans('tomato-admin::global.crud.delete'),
                each: function ($model){
                    $model = config('tomato-crm.model')::find($model->id);
                    $model->delete();
                },
                after: fn () => Toast::danger(__('Account Has Been Deleted'))->autoDismiss(2),
                confirm: true
            )
            ->export()
            ->selectFilter('type_id',
                remote_url: route('admin.types.api'),
                option_label: 'name.'.app()->getLocale(),
                label: __('Type'))
            ->boolFilter(
                key: 'is_active',
                label: __('Activated')
            )
            ->defaultSort('id')
            ->column(
                key: 'name',
                label: __('Name'),
                sortable: true)
            ->column(
                key: 'username',
                label: __('Username'),
                sortable: true)
            ->column(
                key: 'last_login',
                label: __('Last login'),
                sortable: true)
            ->column(
                key: 'is_active',
                label: __('Activated'),
                sortable: true);

        if(config('tomato-crm.features.groups')){
            $table->column(
                key: 'groups',
                label: __('Groups'),
                sortable: false
            );
        }


        foreach (\TomatoPHP\TomatoCrm\Facades\TomatoCrm::getTableCols() as $key=>$item){
            $table->column(
                key: $key,
                label: $item,
                sortable: false,
            );
        }

        $table->column(key: 'actions',label: trans('tomato-admin::global.crud.actions'))
        ->paginate(15);
    }
}
