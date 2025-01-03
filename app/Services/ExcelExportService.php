<?php

namespace App\Services;

use App\Filament\Pages\Settings;
use App\Models\Company;
use App\Utils\Currencies;
use Carbon\Carbon;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Style\Alignment;
use PhpOffice\PhpSpreadsheet\Style\Border;
use PhpOffice\PhpSpreadsheet\Writer\Exception;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

class ExcelExportService
{
    /**
     * @throws Exception
     */
    public function exportKpo(Company $company): string
    {
        $spreadsheet = new Spreadsheet();
        $sheet = $spreadsheet->getActiveSheet();

        $sheet->setCellValue('C2', 'Obrazac KPO');
        $sheet->getStyle('C2')->getFont()->setBold(true)->setSize(16);
        $sheet->mergeCells('C2:E2');
        $sheet->getStyle('C2:E2')->getAlignment()->setHorizontal(Alignment::HORIZONTAL_CENTER);

        $sheet->setCellValue('C2', 'Obrazac KPO');
        $sheet->setCellValue('A3', 'PIB');
        $sheet->setCellValue('B3', $company->vat_id);
        $sheet->setCellValue('A4', 'Obveznik');
        $sheet->setCellValue('B4', $company->name);
        $sheet->getStyle('B4')->getAlignment()->setHorizontal(Alignment::HORIZONTAL_RIGHT);

        $sheet->setCellValue('A5', 'Šifra poreskog obveznika');
        $sheet->setCellValue('B5', $company->registration_number);
        $sheet->setCellValue('A6', 'Šifra delatnosti');
        $sheet->setCellValue('B6', $company->activity_code . ' ' . $company->activity_description);
        $sheet->getStyle('B6')->getAlignment()->setHorizontal(Alignment::HORIZONTAL_RIGHT);

        $sheet->setCellValue('A9', 'KNJIGA O OSTVARENOM PROMETU');
        $sheet->mergeCells('A9:E9');
        $sheet->getStyle('A9:E9')->getFont()->setBold(true);
        $sheet->getStyle('A9:E9')->getAlignment()->setHorizontal(Alignment::HORIZONTAL_CENTER);

        $sheet->setCellValue('A10', 'PAUŠALNO OPOREZOVANI OBVEZNIKA');
        $sheet->mergeCells('A10:E10');
        $sheet->getStyle('A10:E10')->getFont()->setBold(true);
        $sheet->getStyle('A10:E10')->getAlignment()->setHorizontal(Alignment::HORIZONTAL_CENTER);

        $sheet->setCellValue('A11', 'Redni broj');
        $sheet->mergeCells('A11:A12');
        $sheet->getStyle('A11')->getAlignment()->setVertical(Alignment::VERTICAL_CENTER);

        $sheet->setCellValue('B11', 'Datum i opis knjiženja');
        $sheet->mergeCells('B11:B12');
        $sheet->getStyle('B11')->getAlignment()->setVertical(Alignment::VERTICAL_CENTER);

        $sheet->setCellValue('C11', 'PRIHOD OD DELATNOSTI');
        $sheet->mergeCells('C11:D11');
        $sheet->getStyle('C11')->getAlignment()->setHorizontal(Alignment::HORIZONTAL_CENTER);

        $sheet->setCellValue('C12', 'od prodaje proizvoda');
        $sheet->setCellValue('D12', 'od izvršenih usluga');

        $sheet->setCellValue('E11', 'SVEGA');
        $sheet->mergeCells('E11:E12');
        $sheet->getStyle('E11')->getAlignment()->setVertical(Alignment::VERTICAL_CENTER);
        $sheet->setCellValue('E12', 'PRIHODI OD DELATNOSTI (3 + 4)');

        $sheet->setCellValue('A13', '1');
        $sheet->setCellValue('B13', '2');
        $sheet->setCellValue('C13', '3');
        $sheet->setCellValue('D13', '4');
        $sheet->setCellValue('E13', '5');

        $headerStyle = [
            'borders' => [
                'allBorders' => [
                    'borderStyle' => Border::BORDER_THIN,
                    'color' => ['rgb' => '000000'],
                ],
            ],
            'alignment' => [
                'horizontal' => Alignment::HORIZONTAL_CENTER,
                'vertical' => Alignment::VERTICAL_CENTER,
            ],
        ];
        $sheet->getStyle('A9:E13')->applyFromArray($headerStyle);

        foreach (['A', 'B', 'C', 'D', 'E'] as $col) {
            $sheet->getColumnDimension($col)->setAutoSize(true);
        }

        $row = 14;
        foreach ($company->invoices as $index => $invoice) {
            $sheet->setCellValue("A$row", $index + 1);
            $sheet->setCellValue("B$row", Carbon::parse($invoice->value_date)->format('d.m.Y') . ' - ' . $invoice->company->name);
            $sheet->setCellValue("C$row",
                round(
                    $invoice->invoiceItems->where('is_sale', true)->sum('converted_price'),
                    2)
            );
            $sheet->setCellValue("D$row",
                round(
                    $invoice->invoiceItems->where('is_sale', false)->sum('converted_price'),
                    2));
            $sheet->setCellValue("E$row",
                round(
                    $invoice->invoiceItems->sum('converted_price'),
                    2)
            );
            $sheet->getStyle("A$row:E$row")->getBorders()->getAllBorders()->setBorderStyle(Border::BORDER_THIN);
            $row++;
        }

        $writer = new Xlsx($spreadsheet);
        $tempDir = sys_get_temp_dir();
        $filePath = $tempDir . DIRECTORY_SEPARATOR . 'KPO.xlsx';
        $writer->save($filePath);

        return $filePath;
    }
}
