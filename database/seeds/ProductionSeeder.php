<?php

use App\Models\Menu;
use App\Models\Permission;
use App\Models\Role;
use App\Models\Route;
use App\User;
use App\Links;
use Illuminate\Database\Seeder;

class ProductionSeeder extends Seeder
{

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        ////////////////////////////////////
        // Load the routes
        Route::loadLaravelRoutes('/.*/');


        ////////////////////////////////////
        // Create basic set of permissions
        $permGuestOnly = Permission::create([
            'name'          => 'guest-only',
            'display_name'  => 'Acesso só para convidados',
            'description'   => 'Só os usuários (convidados) podem acessar este conteúdo.',
            'enabled'       => true,
        ]);
        $permOpenToAll = Permission::create([
            'name'          => 'open-to-all',
            'display_name'  => 'Aberto para todos',
            'description'   => 'Todos os usuários podem acessar este conteúdo, até os usuários não registrados (convidados).',
            'enabled'       => true,
        ]);
        $permBasicAuthenticated = Permission::create([
            'name'          => 'basic-authenticated',
            'display_name'  => 'Authenticação Basica',
            'description'   => 'Permissões basicas após a autenticação.',
            'enabled'       => true,
        ]);
        // Create a few permissions for the admin|security section
        $permManageMenus = Permission::create([
            'name'          => 'manage-menus',
            'display_name'  => 'Gerenciar menus',
            'description'   => 'Permite que o usuário altere as configurações dos menus.',
            'enabled'       => true,
        ]);
        $permManageUsers = Permission::create([
            'name'          => 'manage-users',
            'display_name'  => 'Gerenciar usuários',
            'description'   => 'Permite que o usuário altere as configurações dos usuários.',
            'enabled'       => true,
        ]);
        $permManageRoles = Permission::create([
            'name'          => 'manage-roles',
            'display_name'  => 'Gerenciar funções',
            'description'   => 'Permite que o usuário altere as configurações das funções.',
            'enabled'       => true,
        ]);
        $permManagePermissions = Permission::create([
            'name'          => 'manage-permissions',
            'display_name'  => 'Gerenciar permissões',
            'description'   => 'Permite que o usuário altere as configurações das permissões.',
            'enabled'       => true,
        ]);
        $permManageRoutes = Permission::create([
            'name'          => 'manage-routes',
            'display_name'  => 'Gerenciar rotas',
            'description'   => 'Permite que o usuário altere as configurações das rotas.',
            'enabled'       => true,
        ]);
        $permManageModules = Permission::create([
            'name'          => 'manage-modules',
            'display_name'  => 'Gerenciar módulos',
            'description'   => 'Permite que o usuário altere as configurações dos módulos.',
            'enabled'       => true,
        ]);
        // Create a few permissions for the admin|audit section
        $permAuditLogView = Permission::create([
            'name'          => 'audit-log-view',
            'display_name'  => 'Visualizar registro de auditoria',
            'description'   => 'Permite que o usuário visualise os registro de auditoria.',
            'enabled'       => true,
        ]);
        $permAuditReplay = Permission::create([
            'name'          => 'audit-log-replay',
            'display_name'  => 'Reproduzir itens do registro de auditoria',
            'description'   => 'Permite que o usuário reproduza itens do registro de auditoria.',
            'enabled'       => true,
        ]);
        $permAuditPurge = Permission::create([
            'name'          => 'audit-log-purge',
            'display_name'  => 'Limpar o registro de auditoria',
            'description'   => 'Permite que o usuário limpe itens antigos do registro de auditoria.',
            'enabled'       => true,
        ]);
        // Create permission to manage the site settings
        $permAdminSettings = Permission::create([
            'name'          => 'admin-settings',
            'display_name'  => 'Administrar configurações do site',
            'description'   => 'Permite que o usuário altere as configurações do site.',
            'enabled'       => true,
        ]);
        // Create a few permissions for the admin|errors section
        $permErrorLogView = Permission::create([
            'name'          => 'error-log-view',
            'display_name'  => 'Visualizar registro de erros',
            'description'   => 'Permite que o usuário visualize o registro de erros.',
            'enabled'       => true,
        ]);
        $permErrorPurge = Permission::create([
            'name'          => 'error-log-purge',
            'display_name'  => 'Limpar o registro de erros',
            'description'   => 'Permite que o usuário limpe itens antigos do registro de erro.',
            'enabled'       => true,
        ]);


        ////////////////////////////////////
        // Associate open-to-all permission to some routes
        $routeBackslash = Route::where('name', 'backslash')->get()->first();
        $routeBackslash->permission()->associate($permOpenToAll);
        $routeBackslash->save();
        $routeHome = Route::where('name', 'home')->get()->first();
        $routeHome->permission()->associate($permOpenToAll);
        $routeHome->save();
        $routeWelcome = Route::where('name', 'welcome')->get()->first();
        $routeWelcome->permission()->associate($permOpenToAll);
	$routeWelcome->save();
        $routeUnidades = Route::where('name', 'unidades')->get()->first();
        $routeUnidades->permission()->associate($permOpenToAll);
		$routeUnidades->save();

        $routeHistoria = Route::where('name', 'historia')->get()->first();
        $routeHistoria->permission()->associate($permOpenToAll);
		$routeHistoria->save();

        $routeContato = Route::where('name', 'contato')->get()->first();
        $routeContato->permission()->associate($permOpenToAll);
        $routeContato->save();
	
        $routeFaust = Route::where('name', 'faust')->get()->first();
        $routeFaust->permission()->associate($permOpenToAll);
        $routeFaust->save();

        $routeFaust = Route::where('name', 'sendemail')->get()->first();
        $routeFaust->permission()->associate($permOpenToAll);
        $routeFaust->save();
	
	$routeView = Route::where('name', 'like', "view.%")->get()->all();
        foreach ($routeView as $route)
        {
            $route->permission()->associate($permOpenToAll);
            $route->save();
        }
				
        // Associate basic-authenticated permission to some routes
        $routeDashboard = Route::where('name', 'dashboard')->get()->first();
        $routeDashboard->permission()->associate($permBasicAuthenticated);
        $routeDashboard->save();
        $routeUserProfile = Route::where('name', 'user.profile')->get()->first();
        $routeUserProfile->permission()->associate($permBasicAuthenticated);
        $routeUserProfile->save();
        $routeUserProfilePatch = Route::where('name', 'user.profile.patch')->get()->first();
        $routeUserProfilePatch->permission()->associate($permBasicAuthenticated);
	$routeUserProfilePatch->save();
        $routeNoticias = Route::where('name', 'like', "noticias.%")->get()->all();
        foreach ($routeNoticias as $route)
        {
            $route->permission()->associate($permBasicAuthenticated);
            $route->save();
        }
        $routeAtividades = Route::where('name', 'like', "atividades.%")->get()->all();
        foreach ($routeAtividades as $route)
        {
            $route->permission()->associate($permBasicAuthenticated);
            $route->save();
        }

	$routeAtividades = Route::where('name', 'like', "slides.%")->get()->all();
        foreach ($routeAtividades as $route)
        {
            $route->permission()->associate($permBasicAuthenticated);
            $route->save();
        }
	$routeLinks = Route::where('name', 'like', "links.%")->get()->all();
        foreach ($routeLinks as $route)
        {
            $route->permission()->associate($permBasicAuthenticated);
            $route->save();
        }
        $routePainel = Route::where('name', 'painel')->get()->first();
        $routePainel->permission()->associate($permBasicAuthenticated);
		$routePainel->save();

	$routeimageUpload = Route::where('name', 'like', "imageupload%")->get()->all();
        foreach ($routeimageUpload as $route)
        {
            $route->permission()->associate($permBasicAuthenticated);
            $route->save();
        }

	$routePosicao = Route::where('name', 'like', "posicao%")->get()->all();
        foreach ($routePosicao as $route)
        {
            $route->permission()->associate($permBasicAuthenticated);
            $route->save();
        }

        $routeGaleria = Route::where('name', 'galeria.index')->get()->first();
        $routeGaleria->permission()->associate($permOpenToAll);
        $routeGaleria->save();
        $routeGaleria = Route::where('name', 'galeria.show_album')->get()->first();
        $routeGaleria->permission()->associate($permOpenToAll);
        $routeGaleria->save();

        $routeGaleria = Route::where('name', 'galeria.create_album_form')->get()->first();
        $routeGaleria->permission()->associate($permBasicAuthenticated);
        $routeGaleria->save();
        $routeGaleria = Route::where('name', 'galeria.create_album')->get()->first();
        $routeGaleria->permission()->associate($permBasicAuthenticated);
        $routeGaleria->save();
        $routeGaleria = Route::where('name', 'galeria.delete_album')->get()->first();
        $routeGaleria->permission()->associate($permBasicAuthenticated);
        $routeGaleria->save();

	// Associate the audit-log permissions
        $routeAuditView = Route::where('name', 'admin.audit.index')->get()->first();
        $routeAuditView->permission()->associate($permAuditLogView);
        $routeAuditView->save();
        $routeAuditShow = Route::where('name', 'admin.audit.show')->get()->first();
        $routeAuditShow->permission()->associate($permAuditLogView);
        $routeAuditShow->save();
        $routeAuditPurge = Route::where('name', 'admin.audit.purge')->get()->first();
        $routeAuditPurge->permission()->associate($permAuditPurge);
        $routeAuditPurge->save();
        $routeAuditReplay = Route::where('name', 'admin.audit.replay')->get()->first();
        $routeAuditReplay->permission()->associate($permAuditReplay);
        $routeAuditReplay->save();
        // Associate manage-menus permissions to routes starting with 'admin.menus.'
        $manageMenusRoutes = Route::where('name', 'like', "admin.menus.%")->get()->all();
        foreach ($manageMenusRoutes as $route)
        {
            $route->permission()->associate($permManageMenus);
            $route->save();
        }
        // Associate manage-permission permissions to routes starting with 'admin.permissions.'
        $managePermRoutes = Route::where('name', 'like', "admin.permissions.%")->get()->all();
        foreach ($managePermRoutes as $route)
        {
            $route->permission()->associate($permManagePermissions);
            $route->save();
        }
        // Associate manage-roles permissions to routes starting with 'admin.roles.'
        $manageRoleRoutes = Route::where('name', 'like', "admin.roles.%")->get()->all();
        foreach ($manageRoleRoutes as $route)
        {
            $route->permission()->associate($permManageRoles);
            $route->save();
        }
        // Associate manage-routes permissions to routes starting with 'admin.routes.'
        $manageRouteRoutes = Route::where('name', 'like', "admin.routes.%")->get()->all();
        foreach ($manageRouteRoutes as $route)
        {
            $route->permission()->associate($permManageRoutes);
            $route->save();
        }
        // Associate manage-modules permissions to routes starting with 'admin.modules.'
        $manageModulesRoutes = Route::where('name', 'like', "admin.modules.%")->get()->all();
        foreach ($manageModulesRoutes as $route)
        {
            $route->permission()->associate($permManageModules);
            $route->save();
        }
        // Associate manage-users permissions to routes starting with 'admin.users.'
        $manageUserRoutes = Route::where('name', 'like', "admin.users.%")->get()->all();
        foreach ($manageUserRoutes as $route)
        {
            $route->permission()->associate($permManageUsers);
            $route->save();
        }
        // Associate the admin-settings permissions
        $routeSettingsIndex = Route::where('name', 'admin.settings.index')->get()->first();
        $routeSettingsIndex->permission()->associate($permAdminSettings);
        $routeSettingsIndex->save();
        $routeSettingsStore = Route::where('name', 'admin.settings.store')->get()->first();
        $routeSettingsStore->permission()->associate($permAdminSettings);
        $routeSettingsStore->save();
        $routeSettingsDestroy = Route::where('name', 'admin.settings.destroy')->get()->first();
        $routeSettingsDestroy->permission()->associate($permAdminSettings);
        $routeSettingsDestroy->save();
        $routeSettingsShow = Route::where('name', 'admin.settings.show')->get()->first();
        $routeSettingsShow->permission()->associate($permAdminSettings);
        $routeSettingsShow->save();
        $routeSettingsPatch = Route::where('name', 'admin.settings.patch')->get()->first();
        $routeSettingsPatch->permission()->associate($permAdminSettings);
        $routeSettingsPatch->save();
        $routeSettingsUpdate = Route::where('name', 'admin.settings.update')->get()->first();
        $routeSettingsUpdate->permission()->associate($permAdminSettings);
        $routeSettingsUpdate->save();
        $routeSettingsConfirmDelete = Route::where('name', 'admin.settings.confirm-delete')->get()->first();
        $routeSettingsConfirmDelete->permission()->associate($permAdminSettings);
        $routeSettingsConfirmDelete->save();
        $routeSettingsDelete = Route::where('name', 'admin.settings.delete')->get()->first();
        $routeSettingsDelete->permission()->associate($permAdminSettings);
        $routeSettingsDelete->save();
        $routeSettingsEdit = Route::where('name', 'admin.settings.edit')->get()->first();
        $routeSettingsEdit->permission()->associate($permAdminSettings);
        $routeSettingsEdit->save();
        $routeSettingsCreate = Route::where('name', 'admin.settings.create')->get()->first();
        $routeSettingsCreate->permission()->associate($permAdminSettings);
        $routeSettingsCreate->save();
        $routeSettingsLoad = Route::where('name', 'admin.settings.load')->get()->first();
        $routeSettingsLoad->permission()->associate($permAdminSettings);
        $routeSettingsLoad->save();
        // Associate the error-log permissions
        $routeErrorView = Route::where('name', 'admin.errors.index')->get()->first();
        $routeErrorView->permission()->associate($permErrorLogView);
        $routeErrorView->save();
        $routeErrorShow = Route::where('name', 'admin.errors.show')->get()->first();
        $routeErrorShow->permission()->associate($permErrorLogView);
        $routeErrorShow->save();
        $routeErrorPurge = Route::where('name', 'admin.errors.purge')->get()->first();
        $routeErrorPurge->permission()->associate($permErrorPurge);
        $routeErrorPurge->save();


        ////////////////////////////////////
        // Create role: admins
        $roleAdmins = Role::create([
            "name"          => "admins",
            "display_name"  => "Administratores",
            "description"   => "Administratores não têm restrição",
            "enabled"       => true
        ]);
        // Create role: users
        // Assign permission basic-authenticated
        $roleUsers = Role::create([
            "name"          => "users",
            "display_name"  => "Usuários",
            "description"   => "Todos os usuários autenticados.",
            "enabled"       => true
        ]);
        $roleUsers->perms()->attach($permBasicAuthenticated->id);
        // Create role: menu-manager
        // Assign permission manage-menus
        $roleMenuManagers = Role::create([
            "name"          => "menu-managers",
            "display_name"  => "Gestores de menu",
            "description"   => "Aos Gestores de menu são concedidas todas as permissões para as seções Adminstradores | Menus.",
            "enabled"       => true
        ]);
        $roleMenuManagers->perms()->attach($permManageMenus->id);
        // Create role: user-manager
        // Assign permission manage-users
        $roleUserManagers = Role::create([
            "name"          => "user-managers",
            "display_name"  => "Gestores de usuários",
            "description"   => "Aos Gestores de usuários são concedidas todas as permissões para as seções Administradores | Usuários.",
            "enabled"       => true
        ]);
        $roleUserManagers->perms()->attach($permManageUsers->id);
        // Create role: module-manager
        // Assign permission manage-modules
        $roleModuleManagers = Role::create([
            "name"          => "module-managers",
            "display_name"  => "Gestores de módulos",
            "description"   => "Aos Gestores de módulos são concedidas todas as permissões para as secções administradores | Módulos.",
            "enabled"       => true
        ]);
        $roleModuleManagers->perms()->attach($permManageModules->id);
        // Create role: role-manager
        // Assign permission: manage-roles
        $roleRoleManagers = Role::create([
            "name"          => "role-managers",
            "display_name"  => "Gestores de funções",
            "description"   => "Aos Gestores de funções são concedidas todas as permissões para as seções administradores | Funções.",
            "enabled"       => true
        ]);
        $roleRoleManagers->perms()->attach($permManageRoles->id);
        // Create role: audit-viewers
        // Assign permission: audit-log-view
        $roleAuditViewers = Role::create([
            "name"          => "audit-viewers",
            "display_name"  => "Visualizadores de auditoria",
            "description"   => "Os usuários podem visualizar o registro de auditoria.",
            "enabled"       => true
        ]);
        $roleAuditViewers->perms()->attach($permAuditLogView->id);
        // Create role: audit-replayers
        // Assign permission: audit-log-replay
        $roleAuditReplayers = Role::create([
            "name"          => "audit-replayers",
            "display_name"  => "Reproduzir auditoria",
            "description"   => "Os usuários estão autorizados a reproduzir os itens do registro de auditoria.",
            "enabled"       => true
        ]);
        $roleAuditReplayers->perms()->attach($permAuditReplay->id);
        // Create role: audit-purgers
        // Assign permission: audit-log-purge
        $roleAuditPurgers = Role::create([
            "name"          => "audit-purgers",
            "display_name"  => "Limpar auditoria",
            "description"   => "Os usuários estão autorizados a limpar itens antigos do registro de auditoria.",
            "enabled"       => true
        ]);
        $roleAuditPurgers->perms()->attach($permAuditPurge->id);
        // Create role: error-viewers
        // Assign permission: error-log-view
        $roleErrorViewers = Role::create([
            "name"          => "error-viewers",
            "display_name"  => "Visualizadores de erros",
            "description"   => "Os usuários podem visualizar o registro de erros.",
            "enabled"       => true
        ]);
        $roleErrorViewers->perms()->attach($permErrorLogView->id);
        // Create role: error-purgers
        // Assign permission: error-log-purge
        $roleErrorPurgers = Role::create([
            "name"          => "error-purgers",
            "display_name"  => "Limpadores de erros",
            "description"   => "Os usuários estão autorizados a limpar itens antigos do registro de erros.",
            "enabled"       => true
        ]);
        $roleErrorPurgers->perms()->attach($permErrorPurge->id);


        ////////////////////////////////////
        // Create user: root
        // Assign membership to role admins, membership to role users is
        // automatic.
        $userRoot = User::create([
            "first_name"    => "Root",
            "last_name"     => "SuperUser",
            "username"      => "root",
            "email"         => "root@email.com",
            "password"      => "l30nc10",
            "auth_type"     => "internal",
            "enabled"       => true
        ]);
        $userRoot->roles()->attach($roleAdmins->id);
/*        $LinkBanner = Links::create([
            "url"    => "banner_boton.jpg",
			"name"	=> "Banner",
        ]);
        $LinkFace = Links::create([
            "url"    => "https://www.facebook.com/colegiouniao.tc",
			"name" => "Facebook",
        ]);
        $Linkista = Links::create([
            "url"    => "#",
			"name" => "Instagram",
        ]);
        $LinkYoutube = Links::create([
            "url"    => "#",
			"name" => "Youtube",
        ]);

 */
        ////////////////////////////////////
        // Create menu: root
        $menuRoot = Menu::create([
//            'id'            => 0,                   // Hard-coded
            'name'          => 'root',
            'label'         => 'Root',
            'position'      => 0,
            'icon'          => 'fa fa-folder',      // No point setting this as root is not visible.
            'separator'     => false,
            'url'           => null,                // No URL, root is not rendered or visible.
            'enabled'       => true,                // Must be enabled or sub-menus will not be available.
//            'parent_id'     => 0,                   // Parent of itself.
            'route_id'      => null,                // No route, root cannot be reached.
            'permission_id' => $permOpenToAll->id,  // Must be visible to all, for all sub-menus to be visible.
        ]);
        // Force root parent to itself.
        $menuRoot->parent_id = $menuRoot->id;
        $menuRoot->save();
        // Create Home menu
        $menuHome = Menu::create([
            'name'          => 'home',
            'label'         => 'Casa',
            'position'      => 0,
            'icon'          => 'fa fa-home fa-colour-green',
            'separator'     => false,
            'url'           => '/',
            'enabled'       => true,
            'parent_id'     => $menuRoot->id,       // Parent is root.
            'route_id'      => $routeHome->id,      // Route to home
            'permission_id' => null,                // Get permission from route.
        ]);
        // Create Admin container.
        $menuAdmin = Menu::create([
            'name'          => 'admin',
            'label'         => 'Admin',
            'position'      => 999,                 // Artificially high number to ensure that it is rendered last.
            'icon'          => 'fa fa-cog',
            'separator'     => false,
            'url'           => null,                // No url.
            'enabled'       => true,
            'parent_id'     => $menuRoot->id,       // Parent is root.
            'route_id'      => null,                // No route
            'permission_id' => null,                // Get permission from sub-items. If the user has permission to see/use
                                                    // any sub-items, the admin menu will be rendered, otherwise it will
                                                    // not.
        ]);
        // Create Audit sub-menu
        $menuAudit = Menu::create([
            'name'          => 'audit',
            'label'         => 'Auditoria',
            'position'      => 0,
            'icon'          => 'fa fa-binoculars',
            'separator'     => false,
            'url'           => null,                // Get URL from route.
            'enabled'       => true,
            'parent_id'     => $menuAdmin->id,      // Parent is admin.
            'route_id'      => $routeAuditView->id,
            'permission_id' => null,                // Get permission from route.
        ]);
        // Create Error sub-menu
        $menuError = Menu::create([
            'name'          => 'error',
            'label'         => 'Erros',
            'position'      => 1,
            'icon'          => 'fa fa-binoculars',
            'separator'     => false,
            'url'           => null,                // Get URL from route.
            'enabled'       => true,
            'parent_id'     => $menuAdmin->id,      // Parent is admin.
            'route_id'      => $routeErrorView->id,
            'permission_id' => null,                // Get permission from route.
        ]);
        // Create Modules sub-menu
        $menuModules = Menu::create([
            'name'          => 'modules',
            'label'         => 'Módulos',
            'position'      => 2,
            'icon'          => 'fa fa-puzzle-piece',
            'separator'     => false,
            'url'           => null,                // Get URL from route.
            'enabled'       => true,
            'parent_id'     => $menuAdmin->id,      // Parent is admin.
            'route_id'      => Route::where('name', 'like', "admin.modules.index")->get()->first()->id,
            'permission_id' => null,                // Get permission from route.
        ]);
        // Create Security container.
        $menuSecurity = Menu::create([
            'name'          => 'security',
            'label'         => 'Segurança',
            'position'      => 3,
            'icon'          => 'fa fa-user-secret fa-colour-red',
            'separator'     => false,
            'url'           => null,                // No url.
            'enabled'       => true,
            'parent_id'     => $menuAdmin->id,      // Parent is admin.
            'route_id'      => null,                // No route
            'permission_id' => null,                // Get permission from sub-items.
        ]);
        // Create Menus sub-menu
        $menuMenus = Menu::create([
            'name'          => 'menus',
            'label'         => 'Menus',
            'position'      => 0,
            'icon'          => 'fa fa-bars',
            'separator'     => false,
            'url'           => null,                // Get URL from route.
            'enabled'       => true,
            'parent_id'     => $menuSecurity->id,   // Parent is security.
            'route_id'      => Route::where('name', 'like', "admin.menus.index")->get()->first()->id,
            'permission_id' => null,                // Get permission from route.
        ]);
        // Create separator
        $menuUsers = Menu::create([
            'name'          => 'menus-users-separator',
            'label'         => '-----',
            'position'      => 1,
            'icon'          => null,
            'separator'     => true,
            'url'           => null,                // Get URL from route.
            'enabled'       => true,
            'parent_id'     => $menuSecurity->id,   // Parent is security.
            'route_id'      => null,
            'permission_id' => null,                // Get permission from route.
        ]);
        // Create Users sub-menu
        $menuUsers = Menu::create([
            'name'          => 'users',
            'label'         => 'Usuários',
            'position'      => 2,
            'icon'          => 'fa fa-user',
            'separator'     => false,
            'url'           => null,                // Get URL from route.
            'enabled'       => true,
            'parent_id'     => $menuSecurity->id,   // Parent is security.
            'route_id'      => Route::where('name', 'like', "admin.users.index")->get()->first()->id,
            'permission_id' => null,                // Get permission from route.
        ]);
        // Create Roles sub-menu
        $menuRoles = Menu::create([
            'name'          => 'roles',
            'label'         => 'Funções',
            'position'      => 3,
            'icon'          => 'fa fa-users',
            'separator'     => false,
            'url'           => null,                // Get URL from route.
            'enabled'       => true,
            'parent_id'     => $menuSecurity->id,   // Parent is security.
            'route_id'      => Route::where('name', 'like', "admin.roles.index")->get()->first()->id,
            'permission_id' => null,                // Get permission from route.
        ]);
        // Create Permissions sub-menu
        $menuPermissions = Menu::create([
            'name'          => 'permissions',
            'label'         => 'Permissões',
            'position'      => 4,
            'icon'          => 'fa fa-bolt',
            'separator'     => false,
            'url'           => null,                // Get URL from route.
            'enabled'       => true,
            'parent_id'     => $menuSecurity->id,   // Parent is security.
            'route_id'      => Route::where('name', 'like', "admin.permissions.index")->get()->first()->id,
            'permission_id' => null,                // Get permission from route.
        ]);
        // Create Routes sub-menu
        $menuRoutes = Menu::create([
            'name'          => 'routes',
            'label'         => 'Rotas',
            'position'      => 5,
            'icon'          => 'fa fa-road',
            'separator'     => false,
            'url'           => null,                // Get URL from route.
            'enabled'       => true,
            'parent_id'     => $menuSecurity->id,   // Parent is security.
            'route_id'      => Route::where('name', 'like', "admin.routes.index")->get()->first()->id,
            'permission_id' => null,                // Get permission from route.
        ]);
        $menuNoticias = Menu::create([
            'name'          => 'noticias',
            'label'         => 'Not&#237;cias',
            'position'      => 998,                 // Artificially high number to ensure that it is rendered last.
            'icon'          => 'fa fa-newspaper-o',
            'separator'     => false,
            'url'           => null,                // No url.
            'enabled'       => true,
            'parent_id'     => $menuHome->id,       // Parent is root.
            'route_id'      => Route::where('name', 'like', "noticias.create")->get()->first()->id,                // No route
            'permission_id' => null,                // Get permission from sub-items. If the user has permission to see/use
                                                   // any sub-items, the admin menu will be rendered, otherwise it will
                                                    // not.
        ]);
		$menuNovaNoticia = Menu::create([
            'name'          => 'novanoticia',
            'label'         => 'Nova not&#237;cia',
            'position'      => 1,                 // Artificially high number to ensure that it is rendered last.
            'icon'          => 'fa fa-file-o',
            'separator'     => false,
            'url'           => null,                // No url.
            'enabled'       => true,
            'parent_id'     => $menuNoticias->id,       // Parent is root.
            'route_id'      => Route::where('name', 'like', "noticias.create")->get()->first()->id,
            'permission_id' => null,                // Get permission from sub-items. If the user has permission to see/use
                                                   // any sub-items, the admin menu will be rendered, otherwise it will
                                                    // not.
        ]);

        $menuPesquisarNoticia = Menu::create([
            'name'          => 'pesquisarnoticia',
            'label'         => 'Pesquisar not&#237;cia',
            'position'      => 2,                 // Artificially high number to ensure that it is rendered last.
            'icon'          => 'fa fa-search',
            'separator'     => false,
            'url'           => null,                // No url.
            'enabled'       => true,
            'parent_id'     => $menuNoticias->id,       // Parent is root.
            'route_id'      => Route::where('name', 'like', "noticias.index")->get()->first()->id,
            'permission_id' => null,                // Get permission from sub-items. If the user has permission to see/use
                                                   // any sub-items, the admin menu will be rendered, otherwise it will
                                                    // not.
        ]);

        $menuAtividades = Menu::create([
            'name'          => 'atividades',
            'label'         => 'Atividades',
            'position'      => 990,                 // Artificially high number to ensure that it is rendered last.
            'icon'          => 'fa fa-object-group',
            'separator'     => false,
            'url'           => null,                // No url.
            'enabled'       => true,
            'parent_id'     => $menuHome->id,       // Parent is root.
            'route_id'      => Route::where('name', 'like', "atividades.create")->get()->first()->id,                // No route
            'permission_id' => null,                // Get permission from sub-items. If the user has permission to see/use
                                                   // any sub-items, the admin menu will be rendered, otherwise it will
                                                    // not.
        ]);
        // Create Clientes container.
        $menuNovaAtividade = Menu::create([
            'name'          => 'novaatividades',
            'label'         => 'Nova atividade',
            'position'      => 1,                 // Artificially high number to ensure that it is rendered last.
            'icon'          => 'fa fa-file-o',
            'separator'     => false,
            'url'           => null,                // No url.
            'enabled'       => true,
            'parent_id'     => $menuAtividades->id,       // Parent is root.
            'route_id'      => Route::where('name', 'like', "atividades.create")->get()->first()->id,
            'permission_id' => null,                // Get permission from sub-items. If the user has permission to see/use
                                                   // any sub-items, the admin menu will be rendered, otherwise it will
                                                    // not.
        ]);

        $menuPesquisarAtividade = Menu::create([
            'name'          => 'pesquisaratividades',
            'label'         => 'Pesquisar atividades',
            'position'      => 2,                 // Artificially high number to ensure that it is rendered last.
            'icon'          => 'fa fa-search',
            'separator'     => false,
            'url'           => null,                // No url.
            'enabled'       => true,
            'parent_id'     => $menuAtividades->id,       // Parent is root.
            'route_id'      => Route::where('name', 'like', "atividades.index")->get()->first()->id,
            'permission_id' => null,                // Get permission from sub-items. If the user has permission to see/use
                                                   // any sub-items, the admin menu will be rendered, otherwise it will
                                                    // not.
        ]);
        $menuSlides = Menu::create([
            'name'          => 'slides',
            'label'         => 'Slides',
            'position'      => 999,                 // Artificially high number to ensure that it is rendered last.
            'icon'          => 'fa fa-slideshare',
            'separator'     => false,
            'url'           => null,                // No url.
            'enabled'       => true,
            'parent_id'     => $menuHome->id,       // Parent is root.
            'route_id'      => Route::where('name', 'like', "slides.create")->get()->first()->id,                // No route
            'permission_id' => null,                // Get permission from sub-items. If the user has permission to see/use
                                                   // any sub-items, the admin menu will be rendered, otherwise it will
                                                    // not.
        ]);
        // Create Clientes container.
        $menuNovoSlide = Menu::create([
            'name'          => 'novoslide',
            'label'         => 'Novo slide',
            'position'      => 1,                 // Artificially high number to ensure that it is rendered last.
            'icon'          => 'fa fa-file-image-o',
            'separator'     => false,
            'url'           => null,                // No url.
            'enabled'       => true,
            'parent_id'     => $menuSlides->id,       // Parent is root.
            'route_id'      => Route::where('name', 'like', "slides.create")->get()->first()->id,
            'permission_id' => null,                // Get permission from sub-items. If the user has permission to see/use
                                                   // any sub-items, the admin menu will be rendered, otherwise it will
                                                    // not.
        ]);

        $menuPesquisarSlide = Menu::create([
            'name'          => 'pesquisarslides',
            'label'         => 'Pesquisar slides',
            'position'      => 2,                 // Artificially high number to ensure that it is rendered last.
            'icon'          => 'fa fa-search',
            'separator'     => false,
            'url'           => null,                // No url.
            'enabled'       => true,
            'parent_id'     => $menuSlides->id,       // Parent is root.
            'route_id'      => Route::where('name', 'like', "slides.index")->get()->first()->id,
            'permission_id' => null,                // Get permission from sub-items. If the user has permission to see/use
                                                   // any sub-items, the admin menu will be rendered, otherwise it will
                                                    // not.
        ]);
        $menuLinks = Menu::create([
            'name'          => 'Links',
            'label'         => 'Links',
            'position'      => 996,                 // Artificially high number to ensure that it is rendered last.
            'icon'          => 'fa fa-slideshare',
            'separator'     => false,
            'url'           => null,                // No url.
            'enabled'       => true,
            'parent_id'     => $menuHome->id,       // Parent is root.
            'route_id'      => Route::where('name', 'like', "links.index")->get()->first()->id,                // No route
            'permission_id' => null,                // Get permission from sub-items. If the user has permission to see/use
                                                   // any sub-items, the admin menu will be rendered, otherwise it will
                                                    // not.
        ]);
	}
}
