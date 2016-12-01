<?php

return [

    'audit-log'           => [
        'category'          => 'Registo de auditoria',
        'msg-index'         => 'Visualisou o Registo de auditoria.',
        'msg-show'          => 'Exibindo detalhes do Registo de auditoria.',
        'msg-purge'         => 'Remova entradas antigas do Registo de auditoria.',
        'msg-replay'        => 'Gerar repetição no item ID #:ID do Registo de auditoria.',
    ],

    'status'              => [
        'purged'              => 'Registo de auditoria limpo',
    ],

    'error'               => [
        'no-replay-available'   => 'Nenhuma ação de repetição disponível.',
        'no-data-viewer'        => 'Sem visualizador de dados definido.',
        'no-data'               => 'Sem dados para mostrar.',
    ],

    'page'                => [
        'index'               => [
            'title'               => 'Administração | Registo de auditoria',
            'description'         => 'Registo de todas as ações realizadas pelos usuários',
            'table-title'         => 'Registo de auditoria',
        ],
        'show'              => [
            'title'             => 'Administração | Registo de auditoria | Mostrar',
            'description'       => 'Exibindo detalhes do Registo de auditoria',
            'section-title'     => 'Detalhes do Registo de auditoria'
        ],
    ],

    'columns'             => [
        'username'            =>  'Nome do usuário',
        'category'            =>  'Categoria',
        'message'             =>  'Mensagem',
        'date'                =>  'Data',
        'data'                =>  'Dados',
        'actions'             =>  'Ações',
    ],

    'button'              => [
        'purge'               => 'Remover entradas do Registo de auditoria com mais de :purge_retention dias.',
    ],

];
