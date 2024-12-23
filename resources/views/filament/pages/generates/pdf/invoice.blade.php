<!DOCTYPE  html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN"
    "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
    <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Invoice</title>
    @vite('resources/css/app.css')

    <style>
        @media print {
            .no-print {
                display: none;
            }
        }
    </style>
</head>
<body class="flex h-[1123px] w-full p-4 px-24 w-794">
<div class="flex h-[1123px] w-full  text-sm relative">
    <div class="w-full pt-9 p-4 px-24 h-[1123px]">
        <div class="flex justify-center border-b-2 border-black pb-3">
            <div class="mt-3 w-1/2 pr-11 pt-3 text-right">
                <h3 class="text-xl font-bold">Invoice / Faktura: 0021/2024</h3>
            </div>
            <div class="flex w-1/2 flex-wrap justify-end">
                <div class="w-1/2 pb-3">
                    <p>Dated /</p>
                    <p>Datum fakture:</p>
                    <p>18.03.2024</p>
                </div>
                <div class="w-1/2 pb-3">
                    <p>Value date /</p>
                    <p>Datum prometa:</p>
                    <p>18.03.2024</p>
                </div>
                <div class="w-1/2 pb-3">
                    <p>Trading place /</p>
                    <p>Mesto prometa:</p>
                    <p>BEOGRAD</p>
                </div>
            </div>
        </div>

        <div class="flex border-black pb-4 border-b-2">
            <div class="w-1/2 ml-4 ">
                <p>From / Od:</p>
                <h3 class="py-4 text-xl font-bold">Vrga DEV</h3>
                <p>Vrga DEV</p>
                <p>Episkopa Nikolaja 11/25</p>
                <p>Beograd (Zemun) 11081</p>
                <p>Vat No / PIB: 113460262</p>
                <p>ID No / MB: 66841251</p>
                <p>E-mail: rajkovrga.it@gmail.com</p>
                <p>Bank Acc Number:</p>
                <p>265-1660310005042-68</p>
            </div>
            <div class="w-1/2">
                <p>Bill to / Komitent:</p>
                <h3 class="py-4 text-xl font-bold">Sectro DOO</h3>
                <p>Sectra DOO</p>
                <p>Hajduk Veljkov Venac 4</p>
                <p>Beograd, 11000</p>
                <p>Vat No / PIB: 104780639</p>
                <p>ID No / MB: 20232692</p>
                <p>Reg. Agent / Zakonski zastupnik:</p>
                <p>Goran Radosavljević</p>
            </div>
        </div>

        <div class=''>
            <table class="table-auto w-full border-collapse">
                <thead>
                <tr class='border-b-2 border-black'>
                    <td class="p-2 text-left"><p class='font-bold'>ITEM</p><p>(VRSTA USLUGE)</p></td>
                    <td class="p-2 text-left"><p class='font-bold'>UNIT</p><p>(JED. MERE)</p></td>
                    <td class="p-2 text-left"><p class='font-bold'>QUANTITY</p><p>(KOLIČINA)</p></td>
                    <td class="p-2 text-left"><p class='font-bold'>PRICE</p><p>(CENA)</p></td>
                    <td class="p-2 text-left"><p class='font-bold'>TOTAL</p><p>(TOTAL)</p></td>
                </tr>
                </thead>
                <tbody>
                <tr>
                    <td class="p-1">Obavljanje informacionih usluga</td>
                    <td class="p-1">Piece (Komad)</td>
                    <td class="p-1">1,00</td>
                    <td class="p-1">242 000</td>
                    <td class="p-1">242 000</td>
                </tr>
                </tbody>
            </table>
            <div class="border-y border-black">
                <table class="table-auto w-full">
                    <tr>
                        <td class="py-3 pl-4 font-bold text-left">AMOUNT DUE / UKUPNO (DIN)</td>
                        <td class="text-right pr-5 bg-gray-200 font-bold">242 000, 00</td>
                    </tr>
                </table>
            </div>
        </div>

        <div class="w-3/4 bg-slate-200 mt-4 ml-6">
            <div class="pb-4">
                <p class="font-bold">NOTE / KOMENTAR:</p>
                <p>The transfer amount is expected to be delivered in full to the beneficiary.</p>
                <p>Payment is required within 7 bussiness days of the invoice date. Plase send remittance to
                    rajkovrga.it@gmail.com</p>
            </div>
            <p>Not in the VAT system /</p>
            <p>Poreski obveznik nije u sistemu PDV-a</p>
            <p>Place / Mesto izdavanja: Beograd(Zemun) 11081</p>


        </div>

        <div class='w-1/4 ml-5 mt-7 h-[120px] bg-slate-300'>
            STAMP
        </div>
        <div class="absolute bottom-0 mb-5 left-1/2 transform -translate-x-1/2 text-center bg-black h-[40px] w-[120px]">
            LOGO
        </div>
    </div>
</div>
</body>
</html>
