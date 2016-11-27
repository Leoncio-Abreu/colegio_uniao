<?php

return [

    'audit-log'           => [
        'category'              => 'Permissões',
        'msg-index'             => 'Acessando lista de permissões.',
        'msg-show'              => 'Acessando detalhes da permissão: :name.',
        'msg-store'             => 'Nova permissão criada: :name.',
        'msg-edit'              => 'Editando permissão: :name.',
        'msg-update'            => 'Permissão atualizada: :name.',
        'msg-destroy'           => 'Permissão deletada: :name.',
        'msg-generate'          => 'Desencadeada a geração de permissões com base em rotas.',
        'msg-enable'            => 'Permissão ativada: :name.',
        'msg-disabled'          => 'Permissão desativada: :name.',
        'msg-enabled-selected'  => 'Multiplas permissões ativadas.',
        'msg-disabled-selected' => 'Multiplas permissões desativadas.',
    ],

    'status'              => [
        'created'                   => 'Permissão criada com sucesso',
        'updated'                   => 'Permissão atualizada com sucesso',
        'deleted'                   => 'Permissão deletada com sucesso',
        'generated'                 => 'Geradas com êxito :number permissões das rotas.',
        'global-enabled'            => 'Permissões selecionadas ativadas.',
        'global-disabled'           => 'Permissões selecionadas desativadas.',
        'enabled'                   => 'Permissão ativada.',
        'disabled'                  => 'Permissão desativada.',
        'no-perm-selected'          => 'Nenhuma permissão selecionada.',
    ],

    'error'               => [
        'cant-delete-this-permission' => 'Esta permissão não pode ser deletada',
        'cant-delete-perm-in-use'     => 'Esta permissão esta em uso ou esta protegida',
        'cant-edit-this-permission'   => 'Esta permissão não pode ser editada',
    ],

    'page'              => [
        'index'              => [
            'title'             => 'Admin | Permissão',
            'description'       => 'Lista de permissões',
            'table-title'       => 'Lista de permissões',
        ],
        'show'              => [
            'title'             => 'Admin | Permissão | Mostrar',
            'description'       => 'Exibindo permissão: :name',
            'section-title'     => 'Detalhes da permissão'
        ],
        'create'            => [
            'title'            => 'Admin | Permissão | Criar',
            'description'      => 'Criando permissão',
            'section-title'    => 'Nova permissão'
        ],
        'edit'              => [
            'title'            => 'Admin | Permissão | Editar',
            'description'      => 'Editando permissão: :name',
            'section-title'    => 'Editar permissão'
        ],
    ],

    'columns'           => [
        'id'                        =>  'ID',
        'name'                      =>  'Nome',
        'display_name'              =>  'Nome a visualizar',
        'description'               =>  'Descrição',
        'routes'                    =>  'Rotas',
        'roles'                     =>  'Funções',
        'created'                   =>  'Criado',
        'updated'                   =>  'Atualizado',
        'actions'                   =>  'Ações',
    ],

    'action'               => [
        'create'                => 'Criar nova permissão',
        'generate'              => 'Gerar permissões',
    ],

];
