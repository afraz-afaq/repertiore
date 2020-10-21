<?php

namespace app\models\forms;

use yii\base\Model;

/**
 * Created by PhpStorm.
 * User: afraz
 * Date: 2/19/2020
 * Time: 11:46 PM
 * @property string $name
 * @property string $email
 * @property string $password
 * @property string $user_login
 * @property string $confirm_password
 */



class SettingsForm extends Model
{

    public $id;
    public $email;
    public $name;
    public $password;
    public $confirm_password;
    public $user_login;

    public function rules()
    {
        return[
            [['id','user_login'], 'integer'],
            [['email','name'],'required'],
            ['email','email'],
            ['name', 'string', 'max'=>100],
            ['confirm_password', 'compare', 'compareAttribute' => 'password'],
            [['confirm_password', 'password'], 'string', 'min' => 6],
        ];
    }

    public function attributeLabels()
    {
        return [
            'name' => 'Name:',
            'email' => 'Email:',
            'password' => 'Password:',
            'confirm_password' => 'Confirm Password:',
            'user_login' => 'User Login Enabled?'
        ];
    }

}