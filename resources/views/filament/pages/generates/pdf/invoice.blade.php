@php use Carbon\Carbon; @endphp


    <!DOCTYPE  html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN"
    "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8"/>
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Invoice</title>
    <meta charset="utf-8">
    <style type="text/css">
        body {
            font-family: "dejavu sans", serif;
            font-size: 11px;
            color: #000;
        }

        @media print {
            .no-print {
                display: none;
            }
        }

        @page {
            size: A4;
            margin: 0;
        }
    </style>
</head>
<body>
<div
    style="width: 100%; padding:10px; min-height: 1123px; font-size: 0.875rem; position: fixed; top: 0; left:0; box-sizing: border-box;">
    <div style="width: 98%; min-height: 1123px; box-sizing: border-box;">
        <table style="width: 100%; border-bottom: 2px solid black; padding-bottom: 24px;">
            <tr>
                <td style="width: 50%; padding-top: 12px; padding-right: 44px; text-align: right;">
                    <h3 style="font-size: 1.25rem; font-weight: bold;">Invoice /
                        Faktura: {{ str_pad($invoice->invoice_number, 4, '0', STR_PAD_LEFT) }}
                        /{{ Carbon::parse($invoice->value_date)->format('Y') }}</h3>
                </td>
                <td style="width: 50%; padding-top: 12px; text-align: right;">
                    <table style="width: 100%;">
                        <tr>
                            <td style="width: 50%; padding-bottom: 12px;">
                                <p style="margin: 0;">Dated /</p>
                                <p style="margin: 0;">Datum fakture:</p>
                                <p style="margin: 0;">{{ Carbon::parse($invoice->dated)->format('d.m.Y') }}</p>
                            </td>
                            <td style="width: 50%; padding-bottom: 12px;">
                                <p style="margin: 0;">Value date /</p>
                                <p style="margin: 0;">Datum prometa:</p>
                                <p style="margin: 0;">{{ Carbon::parse($invoice->value_date)->format('d.m.Y') }}</p>
                            </td>
                        </tr>
                        <tr>
                            <td style="width: 50%; padding-bottom: 12px;">
                                <p style="margin: 0;">Trading place /</p>
                                <p style="margin: 0;">Mesto prometa:</p>
                                <p style="margin: 0;">{{ strtoupper($invoice->user->company->city) }}</p>
                            </td>
                        </tr>
                    </table>
                </td>
            </tr>
        </table>
        <div style="width: 100%;">
            <table style="width: 100%; border-collapse: collapse; table-layout: fixed;">
                <tr>
                    <td style="width: 50%; padding: 0; vertical-align: top; word-wrap: break-word; word-break: break-word;">
                        <p style="margin: 0;">From / Od:</p>
                        <h3 style="margin: 0;  padding:20px 0; font-size: 1.25rem; font-weight: bold;">{{ $invoice->user->company->name }}</h3>
                        <p style="margin: 0;">{{ $invoice->user->company->name }}</p>
                        <p style="margin: 0;">{{ $invoice->user->company->address }}</p>
                        <p style="margin: 0;">{{ $invoice->user->company->city }} {{ $invoice->user->company->zip_code }}</p>
                        <p style="margin: 0;">Vat No / PIB: {{ $invoice->user->company->vat_id }}</p>
                        <p style="margin: 0;">ID No / MB: {{ $invoice->user->company->registration_number }}</p>
                        <p style="margin: 0;">E-mail: {{ $invoice->user->company->email }}</p>
                        @if($invoice->bank_account_id !== null)
                            <p style="margin: 0;">Bank Acc Number:</p>
                            <p style="margin: 0;">
                                {{ $invoice->bankAccount->number ? $invoice->bankAccount->number : $invoice->bankAccount->iban }}
                            </p>
                        @endif
                    </td>
                    <td style="width: 50%; padding: 0; vertical-align: top; word-wrap: break-word; word-break: break-word;">
                        <p style="margin: 0;">Bill to / Komitent:</p>
                        <h3 style="margin: 0; padding:20px 0px; font-size: 1.25rem; font-weight: bold;">{{ $invoice->company->name }}</h3>
                        <p style="margin: 0;">{{ $invoice->company->name }}</p>
                        <p style="margin: 0;">{{ $invoice->user->company->address }}</p>
                        <p style="margin: 0;">{{ $invoice->company->city }} {{ $invoice->company->zip_code }}</p>
                        <p style="margin: 0;">Vat No / PIB: {{ $invoice->company->vat_id }}</p>
                        <p style="margin: 0;">ID No / MB: {{ $invoice->company->registration_number }}</p>
                        @if(!empty($invoice->company->registration_agent))
                            <p style="margin: 0;">Reg. Agent / Zakonski zastupnik:</p>
                            <p style="margin: 0;">{{ $invoice->company->registration_agent }}</p>
                        @endif
                    </td>
                </tr>
            </table>
        </div>

        <div style="width: 100%;">
            <table style="width: 100%; border-collapse: collapse;">
                <thead>
                <tr style="border-bottom: 2px solid black;">
                    <td style="padding: 8px; text-align: left;">
                        <p style="font-weight: bold; margin: 0;">ITEM</p>
                        <p style="margin: 0;">(VRSTA USLUGE)</p>
                    </td>
                    <td style="padding: 8px; text-align: left;">
                        <p style="font-weight: bold; margin: 0;">UNIT</p>
                        <p style="margin: 0;">(JED. MERE)</p>
                    </td>
                    <td style="padding: 8px; text-align: left;">
                        <p style="font-weight: bold; margin: 0;">QUANTITY</p>
                        <p style="margin: 0;">(KOLIČINA)</p>
                    </td>
                    <td style="padding: 8px; text-align: left;">
                        <p style="font-weight: bold; margin: 0;">PRICE</p>
                        <p style="margin: 0;">(CENA)</p>
                    </td>
                    <td style="padding: 8px; text-align: left;">
                        <p style="font-weight: bold; margin: 0;">TOTAL</p>
                        <p style="margin: 0;">(TOTAL)</p>
                    </td>
                </tr>
                </thead>
                <tbody>
                @foreach($invoice->invoiceItems as $item)
                    <tr>
                        <td style="padding: 4px; padding-right: 7px;">{{ $item->title }}</td>
                        <td style="padding: 4px;">{{ $item->unit->name }}</td>
                        <td style="padding: 4px;">{{ number_format($item->quantity, 2, ',', '.') }}</td>
                        <td style="padding: 4px;">{{ number_format($item->price, 2, ',', '.') }}</td>
                        <td style="padding: 4px;">{{ number_format($item->quantity * $item->price, 2, ',', '.') }}</td>
                    </tr>
                @endforeach
                </tbody>
            </table>

            <div style="border-top: 2px solid black; border-bottom: 2px solid black;">
                <table style="width: 100%;">
                    <tr>
                        <td style="padding-top: 12px; padding-left: 16px; font-weight: bold; text-align: left;">AMOUNT
                            DUE / UKUPNO ({{ $invoice->currency->iso }})
                        </td>
                        <td style="text-align: right; padding: 10px 20px 10px 10px; background-color: #e2e8f0; font-weight: bold;">
                            {{ number_format($invoice->invoiceItems->sum(fn($item) => $item->quantity * $item->price), 2, ',', '.') }}
                        </td>
                    </tr>
                </table>
            </div>
        </div>

        <div style="width: 75%; background-color: #e2e8f0; margin-top: 16px; margin-left: 24px;">
            @if(!empty($invoice->user->company->invoice_company_description))
                <div style="padding-bottom: 16px;">
                    <p style="font-weight: bold; margin: 0;">NOTE / KOMENTAR:</p>
                    <p style="margin: 0;">{{ $invoice->user->company->invoice_company_description }}</p>
                </div>
            @endif
            @if(empty($invoice->user->company->vat_id))
                <p style="margin: 0;">Not in the VAT system /</p>
                <p style="margin: 0;">Poreski obveznik nije u sistemu PDV-a</p>
            @else
                <p style="margin: 0;">In the VAT system /</p>
                <p style="margin: 0;">Poreski obveznik jeste u sistemu PDV-a</p>
            @endif
            <p style="margin: 0;">
                Place / Mesto izdavanja: {{ $invoice->user->company->city }} ({{ $invoice->user->company->address }}
                ) {{ $invoice->user->company->zip_code }}
            </p>
        </div>

        @if($invoice->user->company->stamp_url)
            <div style="width: 25%; margin-left: 20px; margin-top: 28px; height: 120px; background-color: #cbd5e1;">
                <img src="{{ $invoice->user->company->stamp_url }}" alt="Stamp"
                     style="width: 100%; height: 100%; object-fit: contain;">
            </div>
        @endif

        @if($invoice->user->company->logo_url)
            <div
                style="position: absolute; bottom: 0; margin-bottom: 20px; left: 50%; transform: translateX(-50%); text-align: center; background-color: black; height: 40px; width: 120px;">
                <img src="{{ $invoice->user->company->logo_url }}" alt="Logo"
                     style="height: 100%; object-fit: contain;">
            </div>
        @endif
    </div>
</div>
</body>
</html>
