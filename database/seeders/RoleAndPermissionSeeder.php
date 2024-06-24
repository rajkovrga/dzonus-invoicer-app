<?php

namespace Database\Seeders;

use App\Utils\Permission;
use App\Utils\Roles;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;

class RoleAndPermissionSeeder extends Seeder
{
    protected array $userPermissions = [
        Permission::ViewAllUsers,
        Permission::ViewUsers,
        Permission::CreateUser,
        Permission::EditUser,
        Permission::DeleteUser,
        Permission::CreateEmployeeUserRelation,
        Permission::DeleteEmployeeUserRelation
    ];

    protected array $invoicePermissions = [
        Permission::ViewAllInvoices,
        Permission::ViewInvoices,
        Permission::EditInvoice,
        Permission::DeleteInvoice,
        Permission::CreateInvoice
    ];

    protected array $companyPermissions = [
        Permission::ViewAllCompanies,
        Permission::EditCompany,
        Permission::DeleteCompany
    ];

    protected array $currencyPermissions = [
        Permission::ViewCurrencies,
        Permission::EditCurrency,
        Permission::DeleteCurrency
    ];

    protected array $bankAccountPermissions = [
        Permission::ViewAllBankAccounts,
        Permission::ViewBankAccounts,
        Permission::EditBankAccount,
        Permission::DeleteBankAccount,
        Permission::DeleteAllBankAccount
    ];

    protected array $companyDraftPermissions = [
        Permission::ViewAllCompanyEmailDrafts,
        Permission::ViewCompanyEmailDrafts,
        Permission::EditCompanyEmailDraft,
        Permission::DeleteCompanyEmailDraft
    ];

    protected array $clientPermissions = [
        Permission::ViewAllClients,
        Permission::ViewCompanyClients,
        Permission::EditAllClients,
        Permission::DeleteCompanyClient,
        Permission::DeleteCompanyClientRelation,
        Permission::EditCompanyClients
    ];

    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $permissions = [
            ...$this->clientPermissions,
            ...$this->userPermissions,
            ...$this->invoicePermissions,
            ...$this->companyDraftPermissions,
            ...$this->companyPermissions,
            ...$this->currencyPermissions,
            ...$this->bankAccountPermissions,
        ];

        foreach ($permissions as $permission) {
            \Spatie\Permission\Models\Permission::create(['name' => $permission]);
        }

        $roles = [
            Roles::Admin => [
                ...collect($this->clientPermissions)
                    ->toArray(),
                ...collect($this->userPermissions)
                    ->toArray(),
                ...collect($this->invoicePermissions)
                    ->toArray(),
                ...collect($this->companyDraftPermissions)
                    ->toArray(),
                ...collect($this->companyPermissions)
                    ->toArray(),
                ...collect($this->currencyPermissions)
                    ->toArray(),
                ...collect($this->bankAccountPermissions)
                    ->toArray(),
            ],
            Roles::CompanyManager => [
                ...collect($this->userPermissions)
                    ->filter(fn($permission) => !in_array($permission, [
                        Permission::ViewAllUsers,
                        Permission::EditUser,
                        Permission::DeleteUser,
                        Permission::CreateUser
                    ]))
                    ->toArray(),
                ...collect($this->clientPermissions)
                    ->filter(fn($permission) => !in_array($permission, [
                        Permission::ViewAllClients,
                        Permission::EditAllClients,
                        Permission::DeleteCompanyClient,
                    ]))
                    ->toArray(),
                ...collect($this->invoicePermissions)
                    ->filter(fn($permission) => $permission != Permission::ViewAllInvoices)
                    ->toArray(),
                ...collect($this->companyDraftPermissions)
                    ->filter(fn($permission) => $permission != Permission::ViewAllCompanyEmailDrafts)
                    ->toArray(),
                ...collect($this->bankAccountPermissions)
                    ->filter(fn($permission) => !in_array($permission, [
                        Permission::ViewAllBankAccounts,
                        Permission::DeleteAllBankAccount
                    ]))
                    ->toArray(),
            ],
            Roles::User => [
                Permission::ViewCompanyEmailDrafts,
                Permission::ViewCompanyClients,
                Permission::ViewInvoices,
                Permission::ViewBankAccounts,
                Permission::ViewCurrencies,
                Permission::CreateInvoice
            ]
        ];

        foreach ($roles as $key => $value) {
            $newRole = Role::create(['name' => $key]);
            $newRole->givePermissionTo($value);
        }
    }
}
