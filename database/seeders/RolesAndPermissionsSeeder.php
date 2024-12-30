<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use App\Models\User;
use Illuminate\Support\Facades\Log;


class RolesAndPermissionsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //izinler
        if(!Permission::where('name','film_ekle')->exists()){
            Permission::create(['name' => 'film_ekle']);
        }
        if(!Permission::where('name', 'kitap_ekle')->exists()){
            Permission::create(['name' => 'kitap_ekle']);
        }
        if(!Permission::where('name', 'yorum_yap')->exists()){
            Permission::create(['name' => 'yorum_yap']);
        }

        //Roller
        /*$adminRole = Role::create(['name' => 'admin']);
        $userRole = Role::create(['name' => 'user']);

        //admingücü,
        $adminRole->givePermissionTo('film_ekle');
        $adminRole->givePermissionTo('kitap_ekle');
        $adminRole->givePermissionTo('yorum_yap');
        //user:D
        $userRole->givePermissionTo('yorum_yap');*/
        $adminRole = Role::firstOrCreate(['name' => 'admin']);
        $userRole = Role::firstOrCreate(['name' => 'user']);
        $adminRole->givePermissionTo('film_ekle');
        $adminRole->givePermissionTo('kitap_ekle');
        $adminRole->givePermissionTo('yorum_yap');


        
        
        $fatihUser = User::find(2);
        if($fatihUser){
            $fatihUser->assignRole($adminRole);
            Log::info("Success: Fatih ID ile arandı admin rolü atandı.");
            $this->command->info("admin rolü atama başarılı");
            $fatihUser->givePermissionTo($adminRole->getAllPermissions());
            Log::info("Success: Fatih ID admin yetkileri atandı");
            $this->command->info("admin yetkileri atama başarılı");
            
        }else{
            Log::error("Kullanıcı bulunamadı: Fatih ID ile arandı.");
        }
    }
}
