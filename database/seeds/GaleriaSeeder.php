<?php

use App\Models\Menu;
use App\Models\Permission;
use App\Models\Route;

use Illuminate\Database\Seeder;

class GaleriaSeeder extends Seeder
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

	$permOpenToAll = Permission::where('name', 'like', "open-to-all")->get()->first();
	$permBasicAuthenticated = Permission::where('name', 'like', "basic-authenticated")->get()->first();

	$routeGaleriasView = Route::where('name', 'like', "galerias.view.%")->get()->all();
        foreach ($routeGaleriasView as $route)
        {
            $route->permission()->associate($permOpenToAll);
            $route->save();
        }

	$routeGaleriasAnos = Route::where('name', 'like', "galerias.anos.%")->get()->all();
        foreach ($routeGaleriasAnos as $route)
        {
            $route->permission()->associate($permBasicAuthenticated);
            $route->save();
        }

	$routeGaleriasUnidades = Route::where('name', 'like', "galerias.unidades.%")->get()->all();
        foreach ($routeGaleriasUnidades as $route)
        {
            $route->permission()->associate($permBasicAuthenticated);
            $route->save();
        }

	$routeGaleriasTurmas = Route::where('name', 'like', "galerias.turmas.%")->get()->all();
        foreach ($routeGaleriasTurmas as $route)
        {
            $route->permission()->associate($permBasicAuthenticated);
            $route->save();
        }

	$routeGaleriasAlbums = Route::where('name', 'like', "galerias.albums.%")->get()->all();
        foreach ($routeGaleriasAlbums as $route)
        {
            $route->permission()->associate($permBasicAuthenticated);
            $route->save();
        }

	$routeGaleriasFotos = Route::where('name', 'like', "galerias.fotos.%")->get()->all();
        foreach ($routeGaleriasFotos as $route)
        {
            $route->permission()->associate($permBasicAuthenticated);
            $route->save();
        }
	
        ////////////////////////////////////
        // Create menu: root
        $menuRoot = Menu::where('name', 'like', "root")->get()->first();
        // Force root parent to itself.
        // Create Home menu
        $menuHome = Menu::where('name', 'like', "home")->get()->first();

	$menuGaleria = Menu::create([
            'name'          => 'galeria',
            'label'         => 'Galeria',
            'position'      => 997,                 // Artificially high number to ensure that it is rendered last.
            'icon'          => 'fa fa-slideshare',
            'separator'     => false,
            'url'           => null,                // No url.
            'enabled'       => true,
            'parent_id'     => $menuHome->id,       // Parent is root.
            'route_id'      => null,                // No route
            'permission_id' => $permBasicAuthenticated,                // Get permission from sub-items. If the user has permission to see/use
                                                   // any sub-items, the admin menu will be rendered, otherwise it will
                                                    // not.
        ]);
        $menuGaleriaFotos = Menu::create([
            'name'          => 'fotos',
            'label'         => 'Fotos',
            'position'      => 1,                 // Artificially high number to ensure that it is rendered last.
            'icon'          => 'fa fa-slideshare',
            'separator'     => false,
            'url'           => null,                // No url.
            'enabled'       => true,
            'parent_id'     => $menuGaleria->id,       // Parent is root.
            'route_id'      => null,                // No route
            'permission_id' => $permBasicAuthenticated,                // Get permission from sub-items. If the user has permission to see/use
                                                   // any sub-items, the admin menu will be rendered, otherwise it will
                                                    // not.
        ]);
        $menuGaleriaFotosNovo = Menu::create([
            'name'          => 'fotosnovo',
            'label'         => 'Adicionar Fotos',
            'position'      => 1,                 // Artificially high number to ensure that it is rendered last.
            'icon'          => 'fa fa-slideshare',
            'separator'     => false,
            'url'           => null,                // No url.
            'enabled'       => true,
            'parent_id'     => $menuGaleriaFotos->id,       // Parent is root.
            'route_id'      => Route::where('name', 'like', "galerias.image.upload")->get()->first()->id,                // No route
            'permission_id' => null,                // Get permission from sub-items. If the user has permission to see/use
                                                   // any sub-items, the admin menu will be rendered, otherwise it will
                                                    // not.
        ]);
        $menuGaleriaFotosindex = Menu::create([
            'name'          => 'fotosindex',
            'label'         => 'Ver Foto',
            'position'      => 2,                 // Artificially high number to ensure that it is rendered last.
            'icon'          => 'fa fa-slideshare',
            'separator'     => false,
            'url'           => null,                // No url.
            'enabled'       => true,
            'parent_id'     => $menuGaleriaFotos->id,       // Parent is root.
            'route_id'      => Route::where('name', 'like', "galerias.fotos.index")->get()->first()->id,                // No route
            'permission_id' => null,                // Get permission from sub-items. If the user has permission to see/use
                                                   // any sub-items, the admin menu will be rendered, otherwise it will
                                                    // not.
        ]);
        $menuGaleriaAnos = Menu::create([
            'name'          => 'anos',
            'label'         => 'Anos',
            'position'      => 2,                 // Artificially high number to ensure that it is rendered last.
            'icon'          => 'fa fa-slideshare',
            'separator'     => false,
            'url'           => null,                // No url.
            'enabled'       => true,
            'parent_id'     => $menuGaleria->id,       // Parent is root.
            'route_id'      => null,                // No route
            'permission_id' => $permBasicAuthenticated->id,                // Get permission from sub-items. If the user has permission to see/use
                                                   // any sub-items, the admin menu will be rendered, otherwise it will
                                                    // not.
        ]);
        $menuGaleriaAnosNovo = Menu::create([
            'name'          => 'anosnovo',
            'label'         => 'Adicionar Ano',
            'position'      => 1,                 // Artificially high number to ensure that it is rendered last.
            'icon'          => 'fa fa-slideshare',
            'separator'     => false,
            'url'           => null,                // No url.
            'enabled'       => true,
            'parent_id'     => $menuGaleriaAnos->id,       // Parent is root.
            'route_id'      => Route::where('name', 'like', "galerias.anos.create")->get()->first()->id,                // No route
            'permission_id' => null,                // Get permission from sub-items. If the user has permission to see/use
                                                   // any sub-items, the admin menu will be rendered, otherwise it will
                                                    // not.
        ]);
        $menuGaleriaAnosindex = Menu::create([
            'name'          => 'anosindex',
            'label'         => 'Ver Anos',
            'position'      => 2,                 // Artificially high number to ensure that it is rendered last.
            'icon'          => 'fa fa-slideshare',
            'separator'     => false,
            'url'           => null,                // No url.
            'enabled'       => true,
            'parent_id'     => $menuGaleriaAnos->id,       // Parent is root.
            'route_id'      => Route::where('name', 'like', "galerias.anos.index")->get()->first()->id,                // No route
            'permission_id' => null,                // Get permission from sub-items. If the user has permission to see/use
                                                   // any sub-items, the admin menu will be rendered, otherwise it will
                                                    // not.
        ]);
        $menuGaleriaUnidades = Menu::create([
            'name'          => 'unidades',
            'label'         => 'Unidades',
            'position'      => 3,                 // Artificially high number to ensure that it is rendered last.
            'icon'          => 'fa fa-slideshare',
            'separator'     => false,
            'url'           => null,                // No url.
            'enabled'       => true,
            'parent_id'     => $menuGaleria->id,       // Parent is root.
            'route_id'      => null,                // No route
            'permission_id' => $permBasicAuthenticated,                // Get permission from sub-items. If the user has permission to see/use
                                                   // any sub-items, the admin menu will be rendered, otherwise it will
                                                    // not.
        ]);
        $menuGaleriaUnidadesNovo = Menu::create([
            'name'          => 'unidadesnovo',
            'label'         => 'Adicionar Unidade',
            'position'      => 1,                 // Artificially high number to ensure that it is rendered last.
            'icon'          => 'fa fa-slideshare',
            'separator'     => false,
            'url'           => null,                // No url.
            'enabled'       => true,
            'parent_id'     => $menuGaleriaUnidades->id,       // Parent is root.
            'route_id'      => Route::where('name', 'like', "galerias.unidades.create")->get()->first()->id,                // No route
            'permission_id' => null,                // Get permission from sub-items. If the user has permission to see/use
                                                   // any sub-items, the admin menu will be rendered, otherwise it will
                                                    // not.
        ]);
        $menuGaleriaUnidadesindex = Menu::create([
            'name'          => 'unidadesindex',
            'label'         => 'Ver Unidades',
            'position'      => 2,                 // Artificially high number to ensure that it is rendered last.
            'icon'          => 'fa fa-slideshare',
            'separator'     => false,
            'url'           => null,                // No url.
            'enabled'       => true,
            'parent_id'     => $menuGaleriaUnidades->id,       // Parent is root.
            'route_id'      => Route::where('name', 'like', "galerias.unidades.index")->get()->first()->id,                // No route
            'permission_id' => null,                // Get permission from sub-items. If the user has permission to see/use
                                                   // any sub-items, the admin menu will be rendered, otherwise it will
                                                    // not.
        ]);
        $menuGaleriaTurmas = Menu::create([
            'name'          => 'turmas',
            'label'         => 'Turmas',
            'position'      => 4,                 // Artificially high number to ensure that it is rendered last.
            'icon'          => 'fa fa-slideshare',
            'separator'     => false,
            'url'           => null,                // No url.
            'enabled'       => true,
            'parent_id'     => $menuGaleria->id,       // Parent is root.
            'route_id'      => null,                // No route
            'permission_id' => $permBasicAuthenticated,                // Get permission from sub-items. If the user has permission to see/use
                                                   // any sub-items, the admin menu will be rendered, otherwise it will
                                                    // not.
        ]);
        $menuGaleriaTurmasNovo = Menu::create([
            'name'          => 'turmanovo',
            'label'         => 'Adicionar Turma',
            'position'      => 1,                 // Artificially high number to ensure that it is rendered last.
            'icon'          => 'fa fa-slideshare',
            'separator'     => false,
            'url'           => null,                // No url.
            'enabled'       => true,
            'parent_id'     => $menuGaleriaTurmas->id,       // Parent is root.
            'route_id'      => Route::where('name', 'like', "galerias.turmas.create")->get()->first()->id,                // No route
            'permission_id' => null,                // Get permission from sub-items. If the user has permission to see/use
                                                   // any sub-items, the admin menu will be rendered, otherwise it will
                                                    // not.
        ]);
        $menuGaleriaTurmasindex = Menu::create([
            'name'          => 'turmasindex',
            'label'         => 'Ver Turmas',
            'position'      => 2,                 // Artificially high number to ensure that it is rendered last.
            'icon'          => 'fa fa-slideshare',
            'separator'     => false,
            'url'           => null,                // No url.
            'enabled'       => true,
            'parent_id'     => $menuGaleriaTurmas->id,       // Parent is root.
            'route_id'      => Route::where('name', 'like', "galerias.turmas.index")->get()->first()->id,                // No route
            'permission_id' => null,                // Get permission from sub-items. If the user has permission to see/use
                                                   // any sub-items, the admin menu will be rendered, otherwise it will
                                                    // not.
        ]);
        $menuGaleriaAlbums = Menu::create([
            'name'          => 'albums',
            'label'         => 'Albums',
            'position'      => 5,                 // Artificially high number to ensure that it is rendered last.
            'icon'          => 'fa fa-slideshare',
            'separator'     => false,
            'url'           => null,                // No url.
            'enabled'       => true,
            'parent_id'     => $menuGaleria->id,       // Parent is root.
            'route_id'      => null,                // No route
            'permission_id' => $permBasicAuthenticated,                // Get permission from sub-items. If the user has permission to see/use
                                                   // any sub-items, the admin menu will be rendered, otherwise it will
                                                    // not.
        ]);
        $menuGaleriaAlbumsNovo = Menu::create([
            'name'          => 'albumsnovo',
            'label'         => 'Adicionar Album',
            'position'      => 1,                 // Artificially high number to ensure that it is rendered last.
            'icon'          => 'fa fa-slideshare',
            'separator'     => false,
            'url'           => null,                // No url.
            'enabled'       => true,
            'parent_id'     => $menuGaleriaAlbums->id,       // Parent is root.
            'route_id'      => Route::where('name', 'like', "galerias.albums.create")->get()->first()->id,                // No route
            'permission_id' => null,                // Get permission from sub-items. If the user has permission to see/use
                                                   // any sub-items, the admin menu will be rendered, otherwise it will
                                                    // not.
        ]);
        $menuGaleriaAlbumsindex = Menu::create([
            'name'          => 'albumsindex',
            'label'         => 'Ver Albums',
            'position'      => 2,                 // Artificially high number to ensure that it is rendered last.
            'icon'          => 'fa fa-slideshare',
            'separator'     => false,
            'url'           => null,                // No url.
            'enabled'       => true,
            'parent_id'     => $menuGaleriaAlbums->id,       // Parent is root.
            'route_id'      => Route::where('name', 'like', "galerias.albums.index")->get()->first()->id,                // No route
            'permission_id' => null,                // Get permission from sub-items. If the user has permission to see/use
                                                   // any sub-items, the admin menu will be rendered, otherwise it will
                                                    // not.
        ]);
    }
}
