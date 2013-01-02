<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

$config['auth']['user_table'] = 'users';
$config['auth']['groups_table'] = 'groups';
// Users Table Fields.
$config['auth']['identifier_field'] = 'user_id';
$config['auth']['display_name_field'] = 'display_name';
$config['auth']['username_field'] = 'email';
$config['auth']['password_field'] = 'password';
// Groups Table Fields.
$config['auth']['group_id_field'] = 'group_id';
$config['auth']['group_name_field'] = 'group_name';
$config['auth']['group_description_field'] = 'group_description';
$config['auth']['default_group'] = '3';