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
 * @property string $contact
 */



class RequestForm extends Model
{

    public $contact;
    public $email;
    public $name;

    public function rules()
    {
        return[
            [['email','contact','name'],'required'],
            ['email','email'],
            ['name', 'string', 'max'=>100],
            ['contact', 'string'],
        ];
    }

    public function attributeLabels()
    {
        return [
            'name' => 'Name:',
            'email' => 'Email:',
            'contact' => 'Tel:',
        ];
    }

}