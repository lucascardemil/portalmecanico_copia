<?php
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use Illuminate\Database\Seeder;

class PermissionsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $admin = Role::create(['name' => 'admin', 'description' => 'Administrador']);
        $mechanic = Role::create(['name' => 'mechanic', 'description' => 'Mecanico']);
        $client = Role::create(['name' => 'client', 'description' => 'Cliente']);

        //pagina de clientes
        $clients = Permission::create(['name' => 'clients', 'description' => 'Modulo Empresas/Proveedores']);
        $products = Permission::create(['name' => 'products', 'description' => 'Modulo Productos']);
        $codes = Permission::create(['name' => 'codes', 'description' => 'Modulo Codigos']);
        $stocks = Permission::create(['name' => 'stocks', 'description' => 'Modulo Inventario']);
        //pagina de vehículos
        $vehicles = Permission::create(['name' => 'vehicles', 'description' => 'Modulo Vehiculos']);
        //pagina de vehículos y mecánicos
        $mvehicles = Permission::create(['name' => 'mechanic-vehicles', 'description' => 'Modulo Vehiculos (Mecanico)']);
        $brands = Permission::create(['name' => 'brands', 'description' => 'Modulo Marcas']);
        $models = Permission::create(['name' => 'models', 'description' => 'Modulo Modelos']);
        $notes = Permission::create(['name' => 'notes', 'description' => 'Modulo Notas']);
        $sales = Permission::create(['name' => 'sales', 'description' => 'Modulo Ventas']);
        //pagina de cotizaciones
        $quotations = Permission::create(['name' => 'quotations', 'description' => 'Modulo Cotizaciones']);
        //pagina de cotizaciones simples
        $squotations = Permission::create(['name' => 'simple-quotations', 'description' => 'Modulo Cotizaciones Simples']);
        //pagina de importaciones
        $imports = Permission::create(['name' => 'imports', 'description' => 'Modulo Importaciones']);
        //pagina de usuarios
        $users = Permission::create(['name' => 'users', 'description' => 'Modulo Usuarios']);
        //pagina de clientes del mecanico
        $musers = Permission::create(['name' => 'mechanic-users', 'description' => 'Modulo Usuarios (Mecanico)']);
        //pagina de roles de usuario
        $roles = Permission::create(['name' => 'roles', 'description' => 'Modulo Roles']);
        $bills = Permission::create(['name' => 'bills', 'description' => 'Modulo Boleta']);
        $utility = Permission::create(['name' => 'utility', 'description' => 'Modulo Margenes Utilidad']);

        $admin->givePermissionTo([
                $clients, 
                $products, 
                $codes, 
                $stocks, 
                $vehicles,
                $mvehicles,
                $brands,
                $models,
                $notes,
                $sales,
                $quotations,
                $squotations,
                $imports,
                $users,
                $musers,
                $roles,
                $bills,
                $utility
        ]);

        $mechanic->givePermissionTo([
            $mvehicles,
            $brands,
            $notes,
            $musers
        ]);

        $client->givePermissionTo([
            $vehicles,
            $notes
        ]);
    }
    
}
