<?php

namespace App\Imports;

use App\Models\Ninja;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class NinjaImport implements ToModel, WithHeadingRow
{

    public function model(array $row)
    {
        dd($row);
        // Pastikan kolom-kolom yang diperlukan ada dalam array $row
        if (!empty($row['Kecamatan']) && !empty($row['Kota']) && !empty($row['PROV']) && !empty($row['Region'])) {
            // Validasi untuk kolom data numerik (misal: Cilacap, Jakarta, Surabaya, Medan)
            $numericColumns = ['Cilacap', 'Jakarta', 'Surabaya', 'Medan'];
            foreach ($numericColumns as $column) {
                if (!is_numeric($row[$column])) {
                    // Jika salah satu kolom numerik tidak berisi nilai numerik, lewati baris ini
                    return null;
                }
            }

            $ninja = new Ninja([
                'kecamatan' => $row['Kecamatan'],
                'kota' => $row['Kota'],
                'prov' => $row['PROV'],
                'region' => $row['Region'],
                'cilacap' => $row['Cilacap'],
                'jakarta' => $row['Jakarta'],
                'surabaya' => $row['Surabaya'],
                'medan' => $row['Medan'],
            ]);

            try {
                $ninja->save(); // Simpan objek model ke dalam database
                return $ninja;
            } catch (\Exception $e) {
                // Tampilkan pesan kesalahan jika ada
                dd($e->getMessage());
            }
        }

        // Jika kolom yang diperlukan tidak ada, lewati baris ini
        return null;
    }

}
