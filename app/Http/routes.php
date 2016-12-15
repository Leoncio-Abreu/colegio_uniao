<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/

// Authentication routes...
Route::get( 'auth/login',               ['as' => 'login',                   'uses' => 'Auth\AuthController@getLogin']);
Route::post('auth/login',               ['as' => 'loginPost',               'uses' => 'Auth\AuthController@postLogin']);
Route::get( 'auth/logout',              ['as' => 'logout',                  'uses' => 'Auth\AuthController@getLogout']);
// Registration routes...
Route::get( 'auth/register',            ['as' => 'register',                'uses' => 'Auth\AuthController@getRegister']);
Route::post('auth/register',            ['as' => 'registerPost',            'uses' => 'Auth\AuthController@postRegister']);
// Verify email...
Route::get( 'auth/verify/{token}',      ['as' => 'confirm_email',           'uses' => 'Auth\AuthController@verify']);
Route::get( 'auth/verify',              ['as' => 'confirm_emailGet',        'uses' => 'Auth\AuthController@getVerify']);
Route::post('auth/verify',              ['as' => 'confirm_emailPost',       'uses' => 'Auth\AuthController@postVerify']);
// Password reset link request routes...
Route::get( 'password/email',           ['as' => 'recover_password',        'uses' => 'Auth\PasswordController@getEmail']);
Route::post('password/email',           ['as' => 'recover_passwordPost',    'uses' => 'Auth\PasswordController@postEmail']);
// Password reset routes...
Route::get( 'password/reset/{token}',   ['as' => 'reset_password',          'uses' => 'Auth\PasswordController@getReset']);
Route::post('password/reset',           ['as' => 'reset_passwordPost',      'uses' => 'Auth\PasswordController@postReset']);
// Registration terms
Route::get( 'faust',                    ['as' => 'faust',                   'uses' => 'FaustController@index']);
Route::post('sendemail', ['as' => 'sendemail', 'uses' => 'EmailController@sendemail']);

// Application routes...
Route::get( '/',       ['as' => 'backslash',   'uses' => 'HomeController@index']);
Route::get( 'home',    ['as' => 'home',        'uses' => 'HomeController@index']);
Route::get( 'painel',    ['as' => 'painel',        'uses' => 'HomeController@painel']);
Route::get( 'welcome', ['as' => 'welcome',     'uses' => 'HomeController@welcome']);
Route::get( 'unidades', ['as' => 'unidades',     'uses' => 'HomeController@unidades']);
Route::get( 'historia', ['as' => 'historia',     'uses' => 'HomeController@historia']);
Route::get( 'contato', ['as' => 'contato',     'uses' => 'HomeController@contato']);
Route::get( 'view/atividade/{id}', ['as' => 'view.atividade',     'uses' => 'HomeController@viewatividade']);
Route::get( 'view/noticia/{id}', ['as' => 'view.noticia',     'uses' => 'HomeController@viewnoticia']);
Route::any( 'imageupload', ['as' => 'imageupload',     'uses' => 'HomeController@imageupload']);

//Route::get('galeria/', array('as' => 'galeria.index','uses' => 'GaleriasController@getList'));
//Route::get('galeria/{id}', array('as' => 'galeria.show_galeria','uses' => 'GaleriasController@getGaleria'));
//Route::get('galeria/Album', array('as' => 'galeria.album_index','uses' => 'AlbumsController@getList'));
//Route::get('galeria/album/{id}', array('as' => 'galeria.show_album','uses' => 'AlbumsController@getAlbum'));

// Routes in this group must be authorized.
Route::group(['middleware' => 'authorize'], function () {
    // Application routes...
    Route::get(   'dashboard',      ['as' => 'dashboard',          'uses' => 'DashboardController@index']);
    Route::get(   'user/profile',   ['as' => 'user.profile',       'uses' => 'UsersController@profile']);
    Route::patch( 'user/profile',   ['as' => 'user.profile.patch', 'uses' => 'UsersController@profileUpdate']);

    Route::any( 'noticias/create',   ['as' => 'noticias.create', 'uses' => 'NoticiasController@create']);
    Route::any( 'noticias/index',   ['as' => 'noticias.index', 'uses' => 'NoticiasController@index']);
    Route::any( 'noticias/store',   ['as' => 'noticias.store', 'uses' => 'NoticiasController@store']);
    Route::any( 'noticias/edit/{one?}/{two?}/{three?}/{four?}/{five?}',    ['as' => 'noticias.edit',    'uses' => 'NoticiasController@edit']);
    Route::get( 'view/atividade/{id}', ['as' => 'view.atividade',     'uses' => 'HomeController@viewatividade']);

    Route::any( 'atividades/create',   ['as' => 'atividades.create', 'uses' => 'AtividadesController@create']);
    Route::any( 'atividades/index',   ['as' => 'atividades.index', 'uses' => 'AtividadesController@index']);
    Route::any( 'atividades/store',   ['as' => 'atividades.store', 'uses' => 'AtividadesController@store']);
    Route::any( 'atividades/edit/{one?}/{two?}/{three?}/{four?}/{five?}',    ['as' => 'atividades.edit',    'uses' => 'AtividadesController@edit']);
    
    Route::any( 'slides/create',   ['as' => 'slides.create', 'uses' => 'SlidesController@create']);
    Route::any( 'slides/index',   ['as' => 'slides.index', 'uses' => 'SlidesController@index']);
    Route::any( 'slides/store',   ['as' => 'slides.store', 'uses' => 'SlidesController@store']);
    Route::any( 'slides/edit/{one?}/{two?}/{three?}/{four?}/{five?}',    ['as' => 'slides.edit',    'uses' => 'SlidesController@edit']);

    Route::any( 'links/create', ['as' => 'links.create', 'uses' => 'LinksController@create']);
    Route::any( 'links/index',	['as' => 'links.index',  'uses' => 'LinksController@index']);
    Route::any( 'links/store',	['as' => 'links.store',  'uses' => 'LinksController@store']);
    Route::any( 'links/edit/{one?}/{two?}/{three?}/{four?}/{five?}',    ['as' => 'links.edit',   'uses' => 'LinksController@edit']);

    Route::get( 'posicao/{table}/{move}/{id}', ['as' => 'posicao',     'uses' => 'HomeController@posicao']);

    Route::any( 'atividades/create',   ['as' => 'atividades.create', 'uses' => 'AtividadesController@create']);
    Route::any( 'atividades/index',   ['as' => 'atividades.index', 'uses' => 'AtividadesController@index']);
    Route::any( 'atividades/store',   ['as' => 'atividades.store', 'uses' => 'AtividadesController@store']);
    Route::any( 'atividades/edit/{one?}/{two?}/{three?}/{four?}/{five?}',    ['as' => 'atividades.edit',    'uses' => 'AtividadesController@edit']);

    Route::any( 'galerias/anos/create',   ['as' => 'galerias.anos.create', 'uses' => 'AnosController@create']);
    Route::any( 'galerias/anos/index',   ['as' => 'galerias.anos.index', 'uses' => 'AnosController@index']);
    Route::any( 'galerias/anos/store',   ['as' => 'galerias.anos.store', 'uses' => 'AnosController@store']);
    Route::any( 'galerias/anos/edit/{one?}/{two?}/{three?}/{four?}/{five?}',    ['as' => 'galerias.anos.edit',    'uses' => 'AnosController@edit']);

    Route::any( 'galerias/unidades/create',   ['as' => 'galerias.unidades.create', 'uses' => 'UnidadesController@create']);
    Route::any( 'galerias/unidades/index',   ['as' => 'galerias.unidades.index', 'uses' => 'UnidadesController@index']);
    Route::any( 'galerias/unidades/store',   ['as' => 'galerias.unidades.store', 'uses' => 'UnidadesController@store']);
    Route::any( 'galerias/unidades/edit/{one?}/{two?}/{three?}/{four?}/{five?}',    ['as' => 'galerias.unidades.edit',    'uses' => 'UnidadesController@edit']);

    Route::any( 'galerias/turmas/create',   ['as' => 'galerias.turmas.create', 'uses' => 'TurmasController@create']);
    Route::any( 'galerias/turmas/index',   ['as' => 'galerias.turmas.index', 'uses' => 'TurmasController@index']);
    Route::any( 'galerias/turmas/store',   ['as' => 'galerias.turmas.store', 'uses' => 'TurmasController@store']);
    Route::any( 'galerias/turmas/edit/{one?}/{two?}/{three?}/{four?}/{five?}',    ['as' => 'galerias.turmas.edit',    'uses' => 'TurmasController@edit']);

    Route::any( 'galerias/galerias/create',   ['as' => 'galerias.galerias.create', 'uses' => 'GaleriasController@create']);
    Route::any( 'galerias/galerias/index',   ['as' => 'galerias.galerias.index', 'uses' => 'GaleriasController@index']);
    Route::any( 'galerias/galerias/store',   ['as' => 'galerias.galerias.store', 'uses' => 'GaleriasController@store']);
    Route::any( 'galerias/galerias/edit/{one?}/{two?}/{three?}/{four?}/{five?}',    ['as' => 'galerias.galerias.edit',    'uses' => 'GaleriasController@edit']);

    Route::any( 'galerias/albums/create',   ['as' => 'galerias.albums.create', 'uses' => 'AlbumsController@create']);
    Route::any( 'galerias/albums/index',   ['as' => 'galerias.albums.index', 'uses' => 'AlbumsController@index']);
    Route::any( 'galerias/albums/store',   ['as' => 'galerias.albums.store', 'uses' => 'AlbumsController@store']);
    Route::any( 'galerias/albums/edit/{one?}/{two?}/{three?}/{four?}/{five?}',    ['as' => 'galerias.albums.edit',    'uses' => 'AlbumsController@edit']);

    Route::any( 'galerias/images/create',   ['as' => 'galerias.images.create', 'uses' => 'ImagesController@create']);
    Route::any( 'galerias/images/index',   ['as' => 'galerias.images.index', 'uses' => 'ImagesController@index']);
    Route::any( 'galerias/images/store',   ['as' => 'galerias.images.store', 'uses' => 'ImagesController@store']);
    Route::any( 'galerias/images/edit/{one?}/{two?}/{three?}/{four?}/{five?}',    ['as' => 'galerias.images.edit',    'uses' => 'ImagesController@edit']);
    
/*    
    Route::get('galeria/createalbum', array('as' => 'galeria.create_album_form','uses' => 'AlbumsController@getForm'));
    Route::post('galeria/createalbum', array('as' => 'galeria.create_album','uses' => 'AlbumsController@postCreate'));
    Route::get('galeria/editalbum/{id}', array('as' => 'galeria.edit_album_form','uses' => 'AlbumsController@editForm'));
    Route::post('galeria/editalbum', array('as' => 'galeria.edit_album','uses' => 'AlbumsController@postEdit'));
    Route::get('galeria/deletealbum/{id}', array('as' => 'galeria.delete_album','uses' => 'AlbumsController@getDelete'));

    Route::get('galeria/addimage/{id}', array('as' => 'galeria.add_image','uses' => 'ImagesController@getForm'));
    Route::post('galeria/addimage', array('as' => 'galeria.add_image_to_album','uses' => 'ImagesController@postAdd'));
    Route::get('galeria/editimage/{id}', array('as' => 'galeria.edit_image','uses' => 'ImagesController@editForm'));
    Route::post('galeria/editimage', array('as' => 'galeria.edit_image_to_album','uses' => 'ImagesController@postEdit'));
    Route::get('galeria/deleteimage/{id}', array('as' => 'galeria.delete_image','uses' => 'ImagesController@getDelete'));
    Route::post('galeria/moveimage', array('as' => 'galeria.move_image', 'uses' => 'ImagesController@postMove'));

    Route::get('galeria/creategaleria', array('as' => 'galeria.create_galeria_form','uses' => 'GaleriasController@getForm'));
    Route::post('galeria/creategaleria', array('as' => 'galeria.create_galeria','uses' => 'GaleriasController@postCreate'));
    Route::get('galeria/editgaleria/{id}', array('as' => 'galeria.edit_galeria_form','uses' => 'GaleriasController@editForm'));
    Route::post('galeria/editgaleria', array('as' => 'galeria.edit_galeria','uses' => 'GaleriasController@postEdit'));
    Route::get('galeria/deletegaleria/{id}', array('as' => 'galeria.delete_galeria','uses' => 'GaleriasController@getDelete'));
 */    

        // Site administration section
	Route::group(['prefix' => 'admin'], function () {
        // User routes
        Route::post(  'users/enableSelected',          ['as' => 'admin.users.enable-selected',  'uses' => 'UsersController@enableSelected']);
        Route::post(  'users/disableSelected',         ['as' => 'admin.users.disable-selected', 'uses' => 'UsersController@disableSelected']);
        Route::get(   'users/search',                  ['as' => 'admin.users.search',           'uses' => 'UsersController@searchByName']);
        Route::get(   'users/list',                    ['as' => 'admin.users.list',             'uses' => 'UsersController@listByPage']);
        Route::post(  'users/getInfo',                 ['as' => 'admin.users.get-info',         'uses' => 'UsersController@getInfo']);
        Route::post(  'users',                         ['as' => 'admin.users.store',            'uses' => 'UsersController@store']);
        Route::get(   'users',                         ['as' => 'admin.users.index',            'uses' => 'UsersController@index']);
        Route::get(   'users/create',                  ['as' => 'admin.users.create',           'uses' => 'UsersController@create']);
        Route::get(   'users/{userId}',                ['as' => 'admin.users.show',             'uses' => 'UsersController@show']);
        Route::patch( 'users/{userId}',                ['as' => 'admin.users.patch',            'uses' => 'UsersController@update']);
        Route::put(   'users/{userId}',                ['as' => 'admin.users.update',           'uses' => 'UsersController@update']);
        Route::delete('users/{userId}',                ['as' => 'admin.users.destroy',          'uses' => 'UsersController@destroy']);
        Route::get(   'users/{userId}/edit',           ['as' => 'admin.users.edit',             'uses' => 'UsersController@edit']);
        Route::get(   'users/{userId}/confirm-delete', ['as' => 'admin.users.confirm-delete',   'uses' => 'UsersController@getModalDelete']);
        Route::get(   'users/{userId}/delete',         ['as' => 'admin.users.delete',           'uses' => 'UsersController@destroy']);
        Route::get(   'users/{userId}/enable',         ['as' => 'admin.users.enable',           'uses' => 'UsersController@enable']);
        Route::get(   'users/{userId}/disable',        ['as' => 'admin.users.disable',          'uses' => 'UsersController@disable']);
        Route::get(   'users/{userId}/replayEdit',      ['as' => 'admin.users.replay-edit',      'uses' => 'UsersController@replayEdit']);
        // Role routes
        Route::post(  'roles/enableSelected',          ['as' => 'admin.roles.enable-selected',  'uses' => 'RolesController@enableSelected']);
        Route::post(  'roles/disableSelected',         ['as' => 'admin.roles.disable-selected', 'uses' => 'RolesController@disableSelected']);
        Route::get(   'roles/search',                  ['as' => 'admin.roles.search',           'uses' => 'RolesController@searchByName']);
        Route::post(  'roles/getInfo',                 ['as' => 'admin.roles.get-info',         'uses' => 'RolesController@getInfo']);
        Route::post(  'roles',                         ['as' => 'admin.roles.store',            'uses' => 'RolesController@store']);
        Route::get(   'roles',                         ['as' => 'admin.roles.index',            'uses' => 'RolesController@index']);
        Route::get(   'roles/create',                  ['as' => 'admin.roles.create',           'uses' => 'RolesController@create']);
        Route::get(   'roles/{roleId}',                ['as' => 'admin.roles.show',             'uses' => 'RolesController@show']);
        Route::patch( 'roles/{roleId}',                ['as' => 'admin.roles.patch',            'uses' => 'RolesController@update']);
        Route::put(   'roles/{roleId}',                ['as' => 'admin.roles.update',           'uses' => 'RolesController@update']);
        Route::delete('roles/{roleId}',                ['as' => 'admin.roles.destroy',          'uses' => 'RolesController@destroy']);
        Route::get(   'roles/{roleId}/edit',           ['as' => 'admin.roles.edit',             'uses' => 'RolesController@edit']);
        Route::get(   'roles/{roleId}/confirm-delete', ['as' => 'admin.roles.confirm-delete',   'uses' => 'RolesController@getModalDelete']);
        Route::get(   'roles/{roleId}/delete',         ['as' => 'admin.roles.delete',           'uses' => 'RolesController@destroy']);
        Route::get(   'roles/{roleId}/enable',         ['as' => 'admin.roles.enable',           'uses' => 'RolesController@enable']);
        Route::get(   'roles/{roleId}/disable',        ['as' => 'admin.roles.disable',          'uses' => 'RolesController@disable']);
        // Menu routes
        Route::post(  'menus',                         ['as' => 'admin.menus.save',             'uses' => 'MenusController@save']);
        Route::get(   'menus',                         ['as' => 'admin.menus.index',            'uses' => 'MenusController@index']);
        Route::get(   'menus/getData/{menuId}',        ['as' => 'admin.menus.get-data',         'uses' => 'MenusController@getData']);
        Route::get(   'menus/{menuId}/confirm-delete', ['as' => 'admin.menus.confirm-delete',   'uses' => 'MenusController@getModalDelete']);
        Route::get(   'menus/{menuId}/delete',         ['as' => 'admin.menus.delete',           'uses' => 'MenusController@destroy']);
        // Modules routes
        Route::get(   'modules',                               ['as' => 'admin.modules.index',                'uses' => 'ModulesController@index']);
        Route::get(   'modules/{slug}/initialize',             ['as' => 'admin.modules.initialize',           'uses' => 'ModulesController@initialize']);
        Route::get(   'modules/{slug}/confirm-uninitialize',   ['as' => 'admin.modules.confirm-uninitialize', 'uses' => 'ModulesController@getModalUninitialize']);
        Route::get(   'modules/{slug}/uninitialize',           ['as' => 'admin.modules.uninitialize',         'uses' => 'ModulesController@uninitialize']);
        Route::get(   'modules/{slug}/enable',                 ['as' => 'admin.modules.enable',               'uses' => 'ModulesController@enable']);
        Route::get(   'modules/{slug}/disable',                ['as' => 'admin.modules.disable',              'uses' => 'ModulesController@disable']);
        Route::post(  'modules/enableSelected',                ['as' => 'admin.modules.enable-selected',      'uses' => 'ModulesController@enableSelected']);
        Route::post(  'modules/disableSelected',               ['as' => 'admin.modules.disable-selected',     'uses' => 'ModulesController@disableSelected']);
        Route::get(   'modules/optimize',                      ['as' => 'admin.modules.optimize',             'uses' => 'ModulesController@optimize']);
        // Permission routes
        Route::get(   'permissions/generate',                      ['as' => 'admin.permissions.generate',         'uses' => 'PermissionsController@generate']);
        Route::post(  'permissions/enableSelected',                ['as' => 'admin.permissions.enable-selected',  'uses' => 'PermissionsController@enableSelected']);
        Route::post(  'permissions/disableSelected',               ['as' => 'admin.permissions.disable-selected', 'uses' => 'PermissionsController@disableSelected']);
        Route::post(  'permissions',                               ['as' => 'admin.permissions.store',            'uses' => 'PermissionsController@store']);
        Route::get(   'permissions',                               ['as' => 'admin.permissions.index',            'uses' => 'PermissionsController@index']);
        Route::get(   'permissions/create',                        ['as' => 'admin.permissions.create',           'uses' => 'PermissionsController@create']);
        Route::get(   'permissions/{permissionId}',                ['as' => 'admin.permissions.show',             'uses' => 'PermissionsController@show']);
        Route::patch( 'permissions/{permissionId}',                ['as' => 'admin.permissions.patch',            'uses' => 'PermissionsController@update']);
        Route::put(   'permissions/{permissionId}',                ['as' => 'admin.permissions.update',           'uses' => 'PermissionsController@update']);
        Route::delete('permissions/{permissionId}',                ['as' => 'admin.permissions.destroy',          'uses' => 'PermissionsController@destroy']);
        Route::get(   'permissions/{permissionId}/edit',           ['as' => 'admin.permissions.edit',             'uses' => 'PermissionsController@edit']);
        Route::get(   'permissions/{permissionId}/confirm-delete', ['as' => 'admin.permissions.confirm-delete',   'uses' => 'PermissionsController@getModalDelete']);
        Route::get(   'permissions/{permissionId}/delete',         ['as' => 'admin.permissions.delete',           'uses' => 'PermissionsController@destroy']);
        Route::get(   'permissions/{permissionId}/enable',         ['as' => 'admin.permissions.enable',           'uses' => 'PermissionsController@enable']);
        Route::get(   'permissions/{permissionId}/disable',        ['as' => 'admin.permissions.disable',          'uses' => 'PermissionsController@disable']);
        // Route routes
        Route::get(   'routes/load',                     ['as' => 'admin.routes.load',             'uses' => 'RoutesController@load']);
        Route::post(  'routes/enableSelected',           ['as' => 'admin.routes.enable-selected',  'uses' => 'RoutesController@enableSelected']);
        Route::post(  'routes/disableSelected',          ['as' => 'admin.routes.disable-selected', 'uses' => 'RoutesController@disableSelected']);
        Route::post(  'routes/savePerms',                ['as' => 'admin.routes.save-perms',       'uses' => 'RoutesController@savePerms']);
        Route::get(   'routes/search',                   ['as' => 'admin.routes.search',           'uses' => 'RoutesController@searchByName']);
        Route::post(  'routes/getInfo',                  ['as' => 'admin.routes.get-info',         'uses' => 'RoutesController@getInfo']);
        Route::post(  'routes',                          ['as' => 'admin.routes.store',            'uses' => 'RoutesController@store']);
        Route::get(   'routes',                          ['as' => 'admin.routes.index',            'uses' => 'RoutesController@index']);
        Route::get(   'routes/create',                   ['as' => 'admin.routes.create',           'uses' => 'RoutesController@create']);
        Route::get(   'routes/{routeId}',                ['as' => 'admin.routes.show',             'uses' => 'RoutesController@show']);
        Route::patch( 'routes/{routeId}',                ['as' => 'admin.routes.patch',            'uses' => 'RoutesController@update']);
        Route::put(   'routes/{routeId}',                ['as' => 'admin.routes.update',           'uses' => 'RoutesController@update']);
        Route::delete('routes/{routeId}',                ['as' => 'admin.routes.destroy',          'uses' => 'RoutesController@destroy']);
        Route::get(   'routes/{routeId}/edit',           ['as' => 'admin.routes.edit',             'uses' => 'RoutesController@edit']);
        Route::get(   'routes/{routeId}/confirm-delete', ['as' => 'admin.routes.confirm-delete',   'uses' => 'RoutesController@getModalDelete']);
        Route::get(   'routes/{routeId}/delete',         ['as' => 'admin.routes.delete',           'uses' => 'RoutesController@destroy']);
        Route::get(   'routes/{routeId}/enable',         ['as' => 'admin.routes.enable',           'uses' => 'RoutesController@enable']);
        Route::get(   'routes/{routeId}/disable',        ['as' => 'admin.routes.disable',          'uses' => 'RoutesController@disable']);
        // Audit routes
        Route::get( 'audit',                           ['as' => 'admin.audit.index',             'uses' => 'AuditsController@index']);
        Route::get( 'audit/purge',                     ['as' => 'admin.audit.purge',             'uses' => 'AuditsController@purge']);
        Route::get( 'audit/{auditId}/replay',          ['as' => 'admin.audit.replay',            'uses' => 'AuditsController@replay']);
        Route::get( 'audit/{auditId}/show',            ['as' => 'admin.audit.show',              'uses' => 'AuditsController@show']);
        // Error routes
        Route::get( 'errors',                          ['as' => 'admin.errors.index',             'uses' => 'ErrorsController@index']);
        Route::get( 'errors/purge',                    ['as' => 'admin.errors.purge',             'uses' => 'ErrorsController@purge']);
        Route::get( 'errors/{errorId}/show',           ['as' => 'admin.errors.show',              'uses' => 'ErrorsController@show']);
        // Settings routes
        Route::post(  'settings',                             ['as' => 'admin.settings.store',            'uses' => 'SettingsController@store']);
        Route::get(   'settings',                             ['as' => 'admin.settings.index',            'uses' => 'SettingsController@index']);
        Route::get(   'settings/load',                        ['as' => 'admin.settings.load',             'uses' => 'SettingsController@load']);
        Route::get(   'settings/create',                      ['as' => 'admin.settings.create',           'uses' => 'SettingsController@create']);
        Route::get(   'settings/{settingKey}',                ['as' => 'admin.settings.show',             'uses' => 'SettingsController@show']);
        Route::patch( 'settings/{settingKey}',                ['as' => 'admin.settings.patch',            'uses' => 'SettingsController@update']);
        Route::put(   'settings/{settingKey}',                ['as' => 'admin.settings.update',           'uses' => 'SettingsController@update']);
        Route::delete('settings/{settingKey}',                ['as' => 'admin.settings.destroy',          'uses' => 'SettingsController@destroy']);
        Route::get(   'settings/{settingKey}/edit',           ['as' => 'admin.settings.edit',             'uses' => 'SettingsController@edit']);
        Route::get(   'settings/{settingKey}/confirm-delete', ['as' => 'admin.settings.confirm-delete',   'uses' => 'SettingsController@getModalDelete']);
        Route::get(   'settings/{settingKey}/delete',         ['as' => 'admin.settings.delete',           'uses' => 'SettingsController@destroy']);



    }); // End of ADMIN group

    // Uncomment to enable Rapyd datagrid.
    require __DIR__.'/rapyd.php';

}); // end of AUTHORIZE middleware group

