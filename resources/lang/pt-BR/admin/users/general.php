<?php
return [

    'audit-log'           => [
        'category'              => 'Usuários',
        'msg-index'             => 'Acessado lista de usuários.',
        'msg-show'              => 'Detalhes do usuário: :username.',
        'msg-store'             => 'Novo usuário criado: :username.',
        'msg-edit'              => 'Editar propriedades do usuário: :username.',
        'msg-replay-edit'       => 'Editar novamente propriedades do usuário: :username.',
        'msg-update'            => 'Propriedades do usuário foram atualizadas: :username.',
        'msg-destroy'           => 'Deletar usuário: :username.',
        'msg-enable'            => 'Usuário ativado: :username.',
        'msg-disabled'          => 'Usuário desativado: :username.',
        'msg-enabled-selected'  => 'Ativar multiplos usuários.',
        'msg-disabled-selected' => 'Desativar multiplos usuários.',
    ],

    'status'              => [
        'created'                   => 'Usuário criado com sucesso',
        'updated'                   => 'Usuário atualizado com sucesso',
        'deleted'                   => 'Usuário deletado com sucesso',
        'global-enabled'            => 'Usuários selecionados ativados.',
        'global-disabled'           => 'Usuários selecionados  desativados.',
        'enabled'                   => 'Usuário ativado.',
        'disabled'                  => 'Usuário desativado.',
        'no-user-selected'          => 'Nenhum usuário selecionado.',
    ],

    'error'               => [
        'cant-be-edited'                => 'Usuário não pode ser editado',
        'cant-be-deleted'               => 'Usuário não pode ser deletado',
        'cant-be-disabled'              => 'Usuário não pode ser desativado',
        'login-failed-user-disabled'    => 'Essa conta foi desativada.',
        'perm_not_found'                => 'Não foi possível encontrar a permissão #:id.',
        'user_not_found'                => 'Não foi possível encontrar a permissão #:id.',
    ],

    'page'              => [
        'index'              => [
            'title'             => 'Admin | Usuários',
            'description'       => 'Exibindo usuários',
            'table-title'       => 'Lista de usuários',
        ],
        'show'              => [
            'title'             => 'Admin | Usuários | Mostrar',
            'description'       => 'Exibindo usuário: :full_name',
            'section-title'     => 'Detalhes do usuário',
        ],
        'create'            => [
            'title'            => 'Admin | User | Criar',
            'description'      => 'Criando um novo usuário',
            'section-title'    => 'Novo usuário',
        ],
        'edit'              => [
            'title'            => 'Admin | User | Editar',
            'description'      => 'Editando usuário: :full_name',
            'section-title'    => 'Editar usuário',
        ],
    ],

    'columns'           => [
        'id'                        =>  'ID',
        'gravatar'                  =>  'Gravatar',
        'username'                  =>  'Nome do usuário',
        'first_name'                =>  'Primeiro nome',
        'last_name'                 =>  'Ultimo name',
        'name'                      =>  'Nome',
        'assigned'                  =>  'Assigned',
        'roles'                     =>  'Função',
        'roles-not-found'           =>  'Função não encontrada',
        'email'                     =>  'Email',
        'type'                      =>  'Tipo',
        'permissions'               =>  'Permissões',
        'permissions-not-found'     =>  'Permissões não encontradas',
        'password'                  =>  'Senha',
        'password_confirmation'     =>  'Confirmação de senha',
        'created'                   =>  'Criada',
        'updated'                   =>  'Atualizada',
        'actions'                   =>  'Ações',
        'effective'                 =>  'Eficaz',
        'enabled'                   =>  'Ativado',
    ],

    'button'               => [
        'create'    =>  'Criar novo usuário',
    ],



];

