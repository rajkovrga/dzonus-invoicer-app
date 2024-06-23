<?php

namespace App\Utils;

class Permission
{
    //users
    public const ViewAllUsers = 'view all users';
    public const ViewUsers = 'view users';
    public const CreateUser = 'create users';
    public const CreateEmployeeUser = 'create employee user';
    public const EditUser = 'edit user';
    public const DeleteUser = 'delete user';

    //invoices
    public const ViewAllInvoices = 'view all invoices';
    public const ViewInvoices = 'view invoices';
    public const EditInvoice = 'edit invoice';
    public const DeleteInvoice = 'delete invoice';

    //company

    public const ViewAllCompanies = 'view all companies';
    public const ViewCompanies = 'view companies';
    public const EditCompany = 'edit company';
    public const DeleteCompany = 'delete company';

    //currencies
    public const ViewAllCurrencies = 'view all currencies';
    public const ViewCurrencies = 'view currencies';
    public const EditCurrency = 'edit currency';
    public const DeleteCurrency = 'delete currency';

    //bank account

    public const ViewAllBankAccounts = 'view all bank accounts';
    public const ViewBankAccounts = 'view bank accounts';
    public const EditBankAccount = 'edit bank account';
    public const DeleteBankAccount = 'delete bank account';

    //company draft

    public const ViewAllCompanyDrafts = 'view all company drafts';
    public const ViewCompanyDrafts = 'view company drafts';
    public const EditCompanyDraft = 'edit company draft';
    public const DeleteCompanyDraft = 'delete company draft';

    //clients

    public const ViewAllClients = 'view all clients';
    public const ViewCompanyClients = 'view company clients';
    public const EditCompanyClients = 'edit company clients';
    public const EditAllClients = 'edit all clients';
    public const DeleteCompanyClient = 'delete company client';
    public const DeleteCompanyClientRelation = 'delete company client relation';

    public static function all()
    {
        return [
            self::ViewAllUsers,
            self::ViewUsers,
            self::CreateUser,
            self::CreateEmployeeUser,
            self::EditUser,
            self::DeleteUser,
            self::ViewAllInvoices,
            self::ViewInvoices,
            self::EditInvoice,
            self::DeleteInvoice,
            self::ViewAllCompanies,
            self::ViewCompanies,
            self::EditCompany,
            self::DeleteCompany,
            self::ViewAllCurrencies,
            self::ViewCurrencies,
            self::EditCurrency,
            self::DeleteCurrency,
            self::ViewAllBankAccounts,
            self::ViewBankAccounts,
            self::EditBankAccount,
            self::DeleteBankAccount,
            self::ViewAllCompanyDrafts,
            self::ViewCompanyDrafts,
            self::EditCompanyDraft,
            self::DeleteCompanyDraft,
            self::ViewAllClients,
            self::ViewCompanyClients,
            self::EditCompanyClients,
            self::EditAllClients,
            self::DeleteCompanyClient,
            self::DeleteCompanyClientRelation
        ];
    }
}
