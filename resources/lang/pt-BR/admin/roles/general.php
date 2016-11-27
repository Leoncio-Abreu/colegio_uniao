<?php

return [

    'audit-log'           => [
        'category'              => 'Funções',
        'msg-index'             => 'Acessando lista de funções.',
        'msg-show'              => 'Acessando detalhes da função: :name.',
        'msg-store'             => 'Nova função criada: :name.',
        'msg-edit'              => 'Editando função: :name.',
        'msg-update'            => 'Função atualizada: :name.',
        'msg-destroy'           => 'Função deletada: :name.',
        'msg-enable'            => 'Função ativada: :name.',
        'msg-disabled'          => 'Função desativada: :name.',
        'msg-enabled-selected'  => 'Multiplas funções ativadas.',
        'msg-disabled-selected' => 'Multiplas funções desativadas.',
    ],

    'status'              => [
        'created'                   => 'Função criada com sucesso',
        'updated'                   => 'Função atualizada com sucesso',
        'deleted'                   => 'Função deletada com sucesso',
        'global-enabled'            => 'Funções selecionadas ativadas.',
        'global-disabled'           => 'Funções selecionadas desativadas.',
        'enabled'                   => 'Função ativada.',
        'disabled'                  => 'Função desativada.',
        'no-role-selected'          => 'Nenhuma função selecionada.',
    ],

    'error'               => [
        'cant-delete-this-role' => 'Esta função não pode ser deletada',
        'cant-edit-this-role'   => 'Esta função não pode ser editada',
    ],

    'page'              => [
        'index'              => [
            'title'             => 'Admin | Função',
            'description'       => 'Lista de funções',
            'table-title'       => 'Lista de funções',
        ],
        'show'              => [
            'title'             => 'Admin | Função | Mostar',
            'description'       => 'Exibindo função: :name',
            'section-title'     => 'Detalhes da função'
        ],
        'create'            => [
            'title'            => 'Admin | Função | Criar',
            'description'      => 'Criando uma nova função',
            'section-title'    => 'Nova função'
        ],
        'edit'              => [
            'title'            => 'Admin | Função | Editar',
            'description'      => 'Editando função: :name',
            'section-title'    => 'Editar função'
        ],
    ],

    'columns'           => [
        'id'                        =>  'ID',
        'name'                      =>  'Nome',
        'display_name'              =>  'Nome a visualisar',
        'description'               =>  'Descrição',
        'permissions'               =>  'Permissões',
        'resync_on_login'           =>  'Voltar a sincronizar ao entrar',
        'options'                   =>  'Opções',
        'users'                     =>  'Usuários',
        'created'                   =>  'Criado',
        'updated'                   =>  'Atualizado',
        'actions'                   =>  'Ações',
        'enabled'                   =>  'Ativado',
    ],

    'button'               => [
        'create'    =>  'Criar nova função',
    ],

];
