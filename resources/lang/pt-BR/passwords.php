<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Password Reminder Language Lines
    |--------------------------------------------------------------------------
    |
    | The following language lines are the default lines which match reasons
    | that are given by the password broker for a password update attempt
    | has failed, such as for an invalid token or invalid new password.
    |
    */

    'password' => 'A senha deverá conter pelo menos seis carateres e ser igual à confirmação.',
    'user'     => 'Não conseguimos encontrar nenhum usuário com o endereço de e-mail especificado.',
    'token'     => 'Esse token de redefinição de senha é inválida.',
    'sent'      => 'Enviamos um email com o seu link de redefinição de senha!',
    'reset'    => 'Sua senha foi redefinida!',
    'auth_type' => 'Só o usuário do tipo interno pode redefinir sua senha! Redefinir sua senha com o administrador de autenticação',

    'audit-log'           => [
        'category'              => 'Resetar a senha',
        'msg-request-reset'     => 'Pedido de redefinação da senha pelo usuário: :email.',
        'msg-reset-password'    => 'A senha foi redefinida: :email.'
    ],


];
