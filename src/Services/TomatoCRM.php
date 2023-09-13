<?php

namespace TomatoPHP\TomatoCrm\Services;

use Illuminate\Support\Facades\Config;
use TomatoPHP\TomatoCrm\Models\Account;

class TomatoCRM
{
    public function isHasMedia(): bool
    {
        return $this->has_media;
    }

    public function getMedia(): array
    {
        return $this->media;
    }

    public function getFilters(): array
    {
        return $this->filters;
    }

    public function getTableCells(): ?string
    {
        return $this->table_cells;
    }

    public function getTableCols(): array
    {
        return $this->table_cols;
    }

    public function getCreateForm(): ?string
    {
        return $this->create_form;
    }

    public function getEditForm(): ?string
    {
        return $this->edit_form;
    }

    public function getShow(): array
    {
        return $this->show;
    }

    public function getValidationCreate(): array
    {
        return $this->validation_create;
    }

    public function getValidationEdit(): array
    {
        return $this->validation_edit;
    }
    //Media
    /**
     * @var bool
     */
    public bool $has_media = false;
    /**
     * @var array
     */
    public array $media = [];

    //Filters
    /**
     * @var array
     */
    public array $filters = [];

    //Table
    /**
     * @var string|null
     */
    public ?string $table_cells = null;
    /**
     * @var array
     */
    public array $table_cols = [];

    //Create
    /**
     * @var string|null
     */
    public ?string $create_form = null;

    //Edit
    /**
     * @var string|null
     */
    public ?string $edit_form = null;

    //Show
    /**
     * @var array
     */
    public array $show = [];

    //Validation
    /**
     * @var array
     */
    public array $validation_create = [];
    /**
     * @var array
     */
    public array $validation_edit = [];

    /**
     * @var array
     */
    public array $api_validation_create = [];

    public function getApiValidationCreate(): array
    {
        return $this->api_validation_create;
    }

    public function getApiValidationEdit(): array
    {
        return $this->api_validation_edit;
    }
    /**
     * @var array
     */
    public array $api_validation_edit = [];

    public function getCreateInputs(): array
    {
        return $this->createInputs;
    }

    public function getEditInputs(): array
    {
        return $this->editInputs;
    }

    public array $createInputs = [];
    public array $editInputs = [];

    /**
     * @param string|null $form
     * @return $this
     */
    public function create(
        ?string $form = null
    ): static
    {
        $this->create_form = $form;
        return $this;
    }

    /**
     * @param string|null $form
     * @return $this
     */
    public function edit(
        ?string $form = null
    ): static
    {
        $this->edit_form = $form;
        return $this;
    }

    /**
     * @param array $show
     * @return $this
     */
    public function show(
        array $show = []
    ): static
    {
        $this->show = $show;
        return $this;
    }

    /**
     * @param array $cols
     * @param string|null $view
     * @return $this
     */
    public function table(
        array $cols = [],
        ?string $view = null
    ): static
    {
        $this->table_cols = $cols;
        $this->table_cells = $view;
        return $this;
    }

    /**
     * @param array $create
     * @param array $edit
     * @return $this
     */
    public function validation(
        array $create = [],
        array $edit = []
    ): static
    {
        $this->validation_create = $create;
        $this->validation_edit = $edit;
        return $this;
    }

    /**
     * @param array $filters
     * @return $this
     */
    public function filters(
        array $filters = []
    ): static
    {
        $this->filters = $filters;
        return $this;
    }

    /**
     * @param array $media
     * @return $this
     */
    public function media(
        array $media = []
    ): static
    {
        if(count($media)){
            $this->has_media = true;
            $this->media = $media;
        }
        return $this;
    }

    public function attach(
        string $key,
        string $label,
        string $type='text',
        ?string $create_valdation=null,
        ?string $update_valdation=null,
        bool $show_on_view = true,
        bool $show_on_create = true,
        bool $show_on_edit = true,
        bool $show_on_table = false,
        bool $allow_filter = false,

    ): static
    {
        if($create_valdation){
            $this->validation_create[$key] = $create_valdation;
        }
        if($update_valdation){
            $this->validation_edit[$key] = $update_valdation;
        }
        if($show_on_view){
            $this->show[$key] = [
                'label' => $label,
                'type' => $type
            ];
        }
        if($show_on_table){
            $this->table_cols[$key] = $label;
        }
        if($allow_filter){
            $this->filters[$key] = $key;
        }
        if($show_on_create){
            $this->createInputs[$key] = [
                'label' => $label,
                'type' => $type,
            ];
        }
        if($show_on_edit){
            $this->editInputs[$key] = [
                'label' => $label,
                'type' => $type,
            ];
        }
        if($type === 'media'){
            $this->has_media = true;
            $this->media[$key] = false;
        }

        return $this;
    }
}
