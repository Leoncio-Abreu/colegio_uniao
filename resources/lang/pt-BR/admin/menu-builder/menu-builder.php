<?php
/**
 * This file is part of the Laravel package: Menu-Builder,
 * a menu and breadcrumb trails management solution for Laravel.
 *
 * @license GPLv3
 * @author Sebastien Routier (sroutier@gmail.com)
 * @package Sroutier\MenuBuilder
 */

return array(
    'save'    => 'Salvar',
    'delete'  => 'Deletar',
    'clear'   => 'Limpar',
    'cancel'  => 'Cancelar',
    'ok'      => 'OK',

    'modal-delete-title'   => 'Menu apagar',
    'modal-delete-message' => 'Tem certeza que deseja deletar o menu ID :id com o rótulo :label? Esta operação é irreversível',

    'modal-delete-title-cant-be-deleted'   => 'Erro a Deletar',
    'modal-delete-message-cant-be-deleted' => 'Você não pode excluir o menu ID :id com o rótulo :label!',

    'enabled'   => 'Ativo',
    'url'       => 'URL',
    'separator' => 'Separador',
    'icon'      => 'Icone',
    'position'  => 'Posição',
    'parent'    => 'Principal',
    'label'     => 'Rótolo',
    'name'      => 'Nome',
    'details'   => 'Detalhes',
    'hierarchy' => 'Hierarquia',

    'menu-builder-admin-title'         => 'Construção de Menus Admin',
    'menu-builder-admin-description'   => 'Aqui você pode construir seu menu. Clique em um item de menu existente para
                                           editá-lo e clique no botão <i>Salvar</ i> para salvar as alterações.<br/>
                                           Clique no <i>Limpar</ i> para criar uma nova entrada.',

    'update-success'  =>  'Menu atualizado com sucesso',
    'create-success'  =>  'Menu criado com sucesso',
    'delete-success'  =>  'Menu excluído com sucesso',

    'delete-failed-cant-be-deleted'  =>  'Você não pode excluir o menu ID :id com o rótulo :label!',
    'update-failed-cant-be-edited'   =>  'Você não pode editar o menu ID :id com o rótulo :label!',

    'audit-log'           => [
        'category'              => 'Menus',
        'msg-index'             => 'Visializou o Registo de menus.',
        'msg-show'              => 'Exibindo detalhes do Registo do menu: :name.',
        'msg-store'             => 'Criação de um novo menu: :name.',
        'msg-edit'              => 'Edição iniciado no menu: :name.',
        'msg-update'            => 'Atualização iniciada no menu: :name.',
        'msg-destroy'           => 'Menu excluído: :name.',
        'msg-enable'            => 'Menu ativado: :name.',
        'msg-disabled'          => 'Menu desativado: :name.',
        'msg-enabled-selected'  => 'Ativação de múltiplos menus.',
        'msg-disabled-selected' => 'Desativação de múltiplos Disabled multiple menus.',
    ],

    'page'              => [
        'index'              => [
            'title'             => 'Administradores | Menus',
            'description'       => 'Lista dos Menus',
            'table-title'       => 'lista de Menus',
            'hierarchy'         => 'Hierarquia',
            'details'           => 'Detalhes',
        ],
        'show'              => [
            'title'             => 'Administradores | Menu | Mostrar',
            'description'       => 'Mostrando menu: :name',
            'section-title'     => 'Detalhes do menu'
        ],
        'create'            => [
            'title'            => 'Administradores | Menu | Novo',
            'description'      => 'Criando um novo menu',
            'section-title'    => 'Novo menu'
        ],
        'edit'              => [
            'title'            => 'Administradores | Menu | Editar',
            'description'      => 'Editando menu: :name',
            'section-title'    => 'Editar menu'
        ],
    ],

    'columns'           => [
        'id'                        =>  'ID',
        'name'                      =>  'Nome',
        'label'                     =>  'Rótulo',
        'position'                  =>  'Posição',
        'icon'                      =>  'Icon',
        'separator'                 =>  'Separador',
        'url'                       =>  'URL',
        'parent'                    =>  'Principal',
        'route'                     =>  'Rota',
        'permission'                =>  'Permição',
        'created'                   =>  'Criado',
        'updated'                   =>  'Atualizado',
        'actions'                   =>  'Ações',
        'enabled'                   =>  'Ativado',
    ],

    'button'               => [
        'create'    =>  'Criar novo menu',
    ],


);
