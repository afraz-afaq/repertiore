<?php

namespace app\models\forms;

use Yii;
use yii\base\Model;

/**
 * UserLoginForm is the model behind the login form.
 *
 * @property User|null $user This property is read-only.
 *
 */
class UserLoginForm extends Model
{
    public $email;
    public $password;
    public $rememberMe = true;

    private $_user = false;


    /**
     * @return array the validation rules.
     */
    public function rules()
    {
        return [
            // username and password are both required
            [['email', 'password'], 'required', 'message' => "{attribute} não pode ficar em branco"],
            ['email','email']
        ];
    }

        /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'email' => 'E-mail',
            'password' => 'Senha',
            'time_spent' => 'Time Spent',
        ];
    }

}
