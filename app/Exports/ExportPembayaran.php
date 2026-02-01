<?php

namespace App\Exports;

use Maatwebsite\Excel\Concerns\FromArray;

class ExportPembayaran implements FromArray
{
    protected $pembayaran;

    public function __construct(array $pembayaran)
    {
        $this->pembayaran = $pembayaran;
    }

    public function array(): array
    {
        return $this->pembayaran;
    }
}
