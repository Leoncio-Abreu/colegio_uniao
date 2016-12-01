<?php

return [

    'audit-log'           => [
        'category'              => 'Configurações',
        'msg-index'             => 'Lista de configurações acessada.',
        'msg-show'              => 'Acesssando detalhes da configuração: :key.',
        'msg-store'             => 'Nova configuração criada: :key.',
        'msg-edit'              => 'Editando configuração: :key.',
        'msg-update'            => 'Configuração atualizada: :key.',
        'msg-destroy'           => 'Configuração deletada: :key.',
        'msg-load'              => 'Desencadeado o carregamento das configurações a partir do arquivo \'.env\'.',
    ],

    'status'              => [
        'created'                   => 'Configuração criada com êxito',
        'updated'                   => 'Configuração atualizada com êxito',
        'deleted'                   => 'Definição eliminada com êxito',
        'settings-loaded'           => 'Carregado com êxito :number configurações do arquivo :env.',
        'no-settings-loaded'        => 'Nada carregado do arquivo de configurações :env.',
        'settings-file-not-found'   => 'Nada carregado do arquivo de configurações. Não foi possível encontrar o arquivo de configurações. :env.',
        'no-setting-selected'       => 'Nenhuma configuração selecionada.',
    ],

    'error'               => [
        'cant-edit-this-setting'   => 'Esta configuração não pode ser editada',
    ],

    'page'              => [
        'index'              => [
            'title'             => 'Admin | Configurações',
            'description'       => 'Lista das configurações',
            'table-title'       => 'Lista das configurações',
        ],
        'show'              => [
            'title'             => 'Admin | Configurações | Mostrar',
            'description'       => 'Exibindo configuração: :key',
            'section-title'     => 'Detalhes da configuração'
        ],
        'create'            => [
            'title'            => 'Admin | Configurações | Criar',
            'description'      => 'Criando uma nova configuração',
            'section-title'    => 'Nova configuração'
        ],
        'edit'              => [
            'title'            => 'Admin | Configurações | Edit',
            'description'      => 'Editando configuração: :key',
            'section-title'    => 'Editar configuração'
        ],
    ],

    'columns'           => [
        'name'                      =>  'Nome',
        'value'                     =>  'Valor',
        'actions'                   =>  'Ação',
        'encrypted'                 =>  'criptografado',
    ],

    'action'               => [
        'create'                => 'Criar nova configuração',
        'load'                  => 'Carregar configurações',
    ],

];
