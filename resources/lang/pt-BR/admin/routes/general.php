<?php

return [

    'audit-log'           => [
        'category'              => 'Rotas',
        'msg-index'             => 'Acessado lista de rotas.',
        'msg-show'              => 'Acesssando detalhes da rota: :name.',
        'msg-store'             => 'Nova rota criada: :name.',
        'msg-edit'              => 'Editando rota: :name.',
        'msg-update'            => 'Rota atualizada: :name.',
        'msg-destroy'           => 'Rota deletada: :name.',
        'msg-enable'            => 'Rota ativada: :name.',
        'msg-disabled'          => 'Rota desativada: :name.',
        'msg-load'              => 'Desencadeado o carregamento das rotas da aplicação a partir das rotas do Laravel.',
        'msg-save-perms'        => 'Atribuir permissão para várias rotas.',
        'msg-enabled-selected'  => 'Multiplas rotas ativadas.',
        'msg-disabled-selected' => 'Multiplas rotas desativar.',
    ],

    'status'              => [
        'created'                           => 'Rota criado com sucesso',
        'updated'                           => 'Rota atualizada com sucesso',
        'deleted'                           => 'Rota deletada com sucesso',
        'loaded'                            => 'Carregado com êxito :number rotas da aplicação.',
        'indiv-perms-assigned'              => 'As rotas individuais de atribuição de permissão foram salvas.',
        'global-perms-assigned'             => 'As rotas selecionadas de atribuição de permissão foram salvos.',
        'no-permission-changed-detected'    => 'Nenhuma alteração de permissão detectada.',
        'global-enabled'                    => 'Rotas selecionadas habilitadas.',
        'global-disabled'                   => 'Rotas selecionadas desativadas.',
        'enabled'                           => 'Rota ativada.',
        'disabled'                          => 'Rota desativada.',
        'no-route-selected'                 => 'Nenhuma rota selecionada.',
    ],

    'error'               => [
        'cant-delete-this-role' => 'Esta rota não pode ser deletada',
        'cant-edit-this-role'   => 'Esta rota não pode ser editada',
    ],

    'page'              => [
        'index'              => [
            'title'             => 'Admin | Rota',
            'description'       => 'Lista de rotas',
            'table-title'       => 'Lista de rotas',
        ],
        'show'              => [
            'title'             => 'Admin | Rota | Mostrar',
            'description'       => 'Exibindo rota',
            'section-title'     => 'Detalhes da rota'
        ],
        'create'            => [
            'title'            => 'Admin | Rota | Criar',
            'description'      => 'Criando uma nova rota',
            'section-title'    => 'Nova rota'
        ],
        'edit'              => [
            'title'            => 'Admin | Rota | Editar',
            'description'      => 'Editando rota',
            'section-title'    => 'Editar rota'
        ],
    ],

    'columns'           => [
        'id'                        =>  'ID',
        'name'                      =>  'Nome',
        'action_name'               =>  'Nome da ação',
        'method'                    =>  'Metodo',
        'path'                      =>  'Caminho',
        'permission'                =>  'Permissão',
        'slug'                      =>  'Slug',
        'created'                   =>  'Criado',
        'updated'                   =>  'Utualizado',
        'actions'                   =>  'Ações',
        'enabled'                   =>  'Ativado',
    ],

    'action'               => [
        'load-routes'           => 'Carregando as rotas a partir da tabela de rotas do Laravel',
        'create'                => 'Criar nova rota',
        'enable-selected'       => 'Ativar rota selecionada',
        'diable-selected'       => 'Desativar rota selecionada',
        'save-perms-assignment' => 'Salvar atribuições de permissão',
    ],

    'placeholder'   => [
        'select-permission' => 'Selecionar permissão',
    ],

];
