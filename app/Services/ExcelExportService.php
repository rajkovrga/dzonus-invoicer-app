<?php

namespace App\Services;

use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Exception;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

class ExcelExportService
{
    /**
     * @throws Exception
     */
    public function exportKpo($data): string
    {
        $spreadsheet = new Spreadsheet();
        $sheet = $spreadsheet->getActiveSheet();

        $sheet->setCellValue('A1', 'Obrazac KPO');
        $sheet->setCellValue('A3', 'PIB');
        $sheet->setCellValue('B3', '12345');
        $sheet->setCellValue('A4', 'Obveznik');
        $sheet->setCellValue('B4', 'Test');
        $sheet->setCellValue('A5', 'Šifra poreskog obveznika');
        $sheet->setCellValue('B5', '12345');
        $sheet->setCellValue('A6', 'Šifra delatnosti');
        $sheet->setCellValue('B6', '1234');

        $sheet->setCellValue('A8', 'Redni broj');
        $sheet->setCellValue('B8', 'Datum i opis knjiženja');
        $sheet->setCellValue('C8', 'Od prodaje proizvoda');
        $sheet->setCellValue('D8', 'Od izvršenih usluga');
        $sheet->setCellValue('E8', 'Svega prihodi od delatnosti (3 + 4)');

        $row = 9;
        foreach ($data as $index => $record) {
            $sheet->setCellValue("A$row", $index + 1);
            $sheet->setCellValue("B$row", $record['']);
            $sheet->setCellValue("C$row", $record['']);
            $sheet->setCellValue("D$row", $record['']);
            $sheet->setCellValue("E$row", $record['']);
            $row++;
        }

        $writer = new Xlsx($spreadsheet);
        $fileName = 'KPO.xlsx';
        $writer->save($fileName);

        return $fileName;
    }
}
