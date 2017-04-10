<?php

return [

    'audit-log'           => [
        'category'          => 'Registo de erros',
        'msg-index'         => 'Visualisou o Registro de erros.',
        'msg-show'          => 'Exibindo detalhes do Registo de erro ID: :id.',
        'msg-purge'         => 'Remover entradas antigas do registo de erros.',
    ],

    'status'              => [
        'purged'              => 'Registo de erros Limpo',
    ],

    'error'               => [
        'no-data'               => 'Sem dados para mostrar.',
    ],

    'page'                => [
        'index'               => [
            'title'               => 'Administração | Registo de erros',
            'description'         => 'Registo de todos os erros gerados e registrados',
            'table-title'         => 'Registo de erros',
        ],
        'show'              => [
            'title'             => 'Administração | Registo de erros | Mostrar',
            'description'       => 'Exibindo detalhes do Registo do erro ID: :error_id',
            'section-title'     => 'Detalhes do Registo do erro'
        ],
    ],

    'columns'             => [
        'user'                =>  'Usuário',
        'message'             =>  'Mensagem',
        'class'               =>  'Classe',
        'url'                 =>  'URL',
        'date'                =>  'Data',
        'file'                =>  'Arquivo',
        'code'                =>  'Código',
        'status_code'         =>  'código de Status',
        'line'                =>  'Linha',
        'trace'               =>  'Rastro',
        'data'                =>  'Dados',
        'method'              =>  'Metodo',
    ],

    'button'              => [
        'purge'               => 'Remover entradas do Registo de erros com mais de :purge_retention dias',
    ],

];
