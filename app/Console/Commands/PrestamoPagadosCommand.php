<?php

namespace App\Console\Commands;

use App\Models\Prestamo;
use Illuminate\Console\Command;

class PrestamoPagadosCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'prestamos:pagados';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Actualizar prestamos pagados';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $prestamo = Prestamo::where('estatus', '=', Prestamo::AUTORIZADA)
        ->whereDate('fecha_pago', '<', date('Y-m-d'))
        ->get();

        foreach ($prestamo as $key => $value) {
            $value->estatus = Prestamo::ADEUDO;
            $value->save();
            $this->info($value->id);
        }
        $this->info($prestamo->count());
    }
}
