<?php

namespace App\Exports;

use App\Import;
use App\Detailimport;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;
use Maatwebsite\Excel\Concerns\Exportable;

class DetailimportsExport implements FromView
{
    use Exportable;

    public function __construct(int $id)
    {
        $this->id = $id;

        return $this;
    }

    /**
    * @return \Illuminate\Support\Collection
    */
    public function view(): View
    {
        $import = Import::find( $this->id );
        $products = Import::findOrFail( $this->id )->detailimports;
        //$client = Quotationclient::find( $this->id )->client;

        return view('excel.importacion', compact([ 'import', 'products']) );
    }
}
