<?php

return [

    'audit-log'           => [
        'category'              => 'Módulos',
        'msg-index'             => 'lista acessada de módulos.',
        'msg-show'              => 'Detalhes acessados da permissão: :name.',
        'msg-store'             => 'Criar nova permissão: :name.',
        'msg-edit'              => 'Inicio da edição da permissão: :name.',
        'msg-update'            => 'Final da edição da permissão: :name.',
        'msg-destroy'           => 'Deleted permission: :name.',
        'msg-generate'          => 'Geração desencadeada de permissões com base em rotas.',
        'msg-enable'            => 'Módulo ativado: :slug.',
        'msg-disabled'          => 'Módulo desativado: :slug.',
        'msg-enabled-selected'  => 'Ativação de múltiplos Módulos.',
        'msg-disabled-selected' => 'Desativação de múltiplos Módulos.',
        'msg-optimizer'         => 'Definição de Módulos otimizada.',
        'msg-initialize'        => 'Módulo inicializado: :slug.',
        'msg-uninitialize'      => 'Módulo não inicializa: :slug.',
    ],

    'status'              => [
        'global-enabled'            => 'Módulos selecionados ativados.',
        'global-disabled'           => 'Módulos selecionados desativados.',
        'enabled'                   => 'Módulo ativo.',
        'disabled'                  => 'Módulo desativado.',
        'optimized'                 => 'Definição de Módulos optimizada.',
        'initialized'               => 'Módulo inicializado: :name.',
        'uninitialized'             => 'Módulo não inicializado: :name.',
        'no-mod-selected'           => 'Nenhum módulo selecionado.',
        'already-initialized'       => 'Módulo já inicializado: :name.',
        'not-initialized'           => 'Módulo não inicializado: :name.',
        'not-disabled'              => 'Módulo não desativado: :name.',
        'not-found'                 => 'Módulo não encontrado: :slug.',
    ],

    'error'               => [
        'cant-delete-this-permission' => 'Esta permissão não pode ser excluído',
        'cant-delete-perm-in-use'     => 'Esta permissão está em uso ou protegidos',
    ],

    'page'              => [
        'index'              => [
            'title'             => 'Administrador | Módulos',
            'description'       => 'Lista dos módulos',
            'table-title'       => 'Lista de módulos',
        ],
        'show'              => [
            'title'             => 'Administrador | Permissão | Mostrar',
            'description'       => 'Mostrando permissão: :name',
            'section-title'     => 'Detalhes da Permissão'
        ],
        'create'            => [
            'title'            => 'Administradores | Permissão | Novo',
            'description'      => 'Criando uma nova permissão',
            'section-title'    => 'Nova permissão'
        ],
        'edit'              => [
            'title'            => 'Administradores | Permissão | Editar',
            'description'      => 'Editando permissão: :name',
            'section-title'    => 'Editar permissão'
        ],
    ],

    'columns'           => [
        'order'                     =>  'Ordem',
        'name'                      =>  'Nome',
        'display_name'              =>  'Nome de exibição',
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

    'button'               => [
        'optimize'      =>  'Optimize a definição de Módulos',
        'initialize'    =>  'Iniciar',
        'uninitialize'  =>  'Parar',
    ],

    'delete-confirm'              => [
        'title'   => 'Desinstalando module',
        'body'    => 'Tem a certeza de que pretende anular a inicialização do módulo com o nome ":name"? <br/> Em muitos casos a chamada de uninitialize para um módulo terá que excluir ou limpar todos os dados do banco de dados interno, fazendo com que os dados do módulo sejam perdidos. Você tem um backup apenas no caso? Esta operação pode ser irreversível. <br/> Para obter mais informações, consulte a documentação do módulo.',
    ],

];
