<?php

namespace App\Utils;

class Permission
{
    //users
    public const ViewAllUsers = 'view all users';
    public const ViewUsers = 'view users';
    public const CreateUser = 'create users';
    public const CreateEmployeeUserRelation = 'create employee user relation';
    public const DeleteEmployeeUserRelation = 'edit employee user';
    public const EditUser = 'edit user';
    public const DeleteUser = 'delete user';

    //invoices
    public const ViewAllInvoices = 'view all invoices';
    public const ViewInvoices = 'view invoices';
    public const CreateInvoice = 'create invoice';
    public const EditInvoice = 'edit invoice';
    public const DeleteInvoice = 'delete invoice';

    //company

    public const ViewAllCompanies = 'view all companies';
    public const EditCompany = 'edit company';
    public const DeleteCompany = 'delete company';

    //currencies
    public const ViewCurrencies = 'view currencies';
    public const EditCurrency = 'edit currency';
    public const DeleteCurrency = 'delete currency';

    //bank account

    public const ViewAllBankAccounts = 'view all bank accounts';
    public const ViewBankAccounts = 'view bank accounts';
    public const EditBankAccount = 'edit bank account';
    public const DeleteBankAccount = 'delete bank account';
    public const DeleteAllBankAccount = 'delete all bank account';

    //company draft

    public const ViewAllCompanyEmailDrafts = 'view all company drafts';
    public const ViewCompanyEmailDrafts = 'view company drafts';
    public const EditCompanyEmailDraft = 'edit company draft';
    public const DeleteCompanyEmailDraft = 'delete company draft';

    //clients

    public const ViewAllClients = 'view all clients';
    public const ViewCompanyClients = 'view company clients';
    public const EditCompanyClients = 'edit company clients';
    public const EditAllClients = 'edit all clients';
    public const DeleteCompanyClient = 'delete company client';
    public const DeleteCompanyClientRelation = 'delete company client relation';

    public static function all(): array
    {
        return [
            self::ViewAllUsers,
            self::ViewUsers,
            self::CreateUser,
            self::CreateEmployeeUserRelation,
            self::EditUser,
            self::DeleteUser,
            self::ViewAllInvoices,
            self::ViewInvoices,
            self::EditInvoice,
            self::DeleteInvoice,
            self::ViewAllCompanies,
            self::EditCompany,
            self::DeleteCompany,
            self::ViewCurrencies,
            self::EditCurrency,
            self::DeleteCurrency,
            self::ViewAllBankAccounts,
            self::ViewBankAccounts,
            self::EditBankAccount,
            self::DeleteBankAccount,
            self::ViewAllCompanyEmailDrafts,
            self::ViewCompanyEmailDrafts,
            self::EditCompanyEmailDraft,
            self::DeleteCompanyEmailDraft,
            self::ViewAllClients,
            self::ViewCompanyClients,
            self::EditCompanyClients,
            self::EditAllClients,
            self::DeleteCompanyClient,
            self::DeleteCompanyClientRelation,
            self::DeleteAllBankAccount,
            self::DeleteEmployeeUserRelation,
            self::CreateInvoice
        ];
    }
}
