<?php

namespace app\models\forms;

use yii\base\Model;

/**
 * Created by PhpStorm.
 * User: afraz
 * Date: 2/19/2020
 * Time: 11:46 PM
 * @property string $name
 * @property string $username
 * @property string $email
 * @property string $password
 * @property string $confirm_password
 */



class SettingsForm extends Model
{

    public $id;
    public $username;
    public $email;
    public $name;
    public $password;
    public $confirm_password;

    public function rules()
    {
        return[
            ['id', 'integer'],
            [['email','username','name'],'required'],
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
            'username' => 'Username:',
            'email' => 'Email:',
            'password' => 'Password:',
            'confirm_password' => 'Confirm Password:'
        ];
    }

}