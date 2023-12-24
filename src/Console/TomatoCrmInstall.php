<?php

namespace TomatoPHP\TomatoCrm\Console;

use Illuminate\Console\Command;
use TomatoPHP\ConsoleHelpers\Traits\RunCommand;
use TomatoPHP\TomatoCategory\Models\Type;

class TomatoCrmInstall extends Command
{
    use RunCommand;

    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $name = 'tomato-crm:install';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'install package and publish assets';

    public function __construct()
    {
        parent::__construct();
    }


    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $this->info('Publish Vendor Assets');
        $this->callSilent('optimize:clear');
        $this->artisanCommand(["migrate"]);
        $this->artisanCommand(["optimize:clear"]);
        $typesArray = [
            [
                "name" => [
                    "ar" => "عميل",
                    "en" => "Customer"
                ],
                "key" => "customer",
                "for" => "accounts",
                "type" => "type"
            ],
            [
                "name" => [
                    "ar" => "مورد",
                    "en" => "Supplier"
                ],
                "key" => "supplier",
                "for" => "accounts",
                "type" => "type"
            ],
            [
                "name" => [
                    "ar" => "زائر",
                    "en" => "Lead"
                ],
                "key" => "lead",
                "for" => "accounts",
                "type" => "type"
            ]
        ];
        foreach ($typesArray as $item){
            $checkFirst = Type::query()->where('key',$item['key'])->first();
            if(!$checkFirst){
                Type::query()->create($item);
            }
        }
        $this->info('Tomato Crm installed successfully.');
    }
}
