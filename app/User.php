<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password', 'cpf', 'birth_date', 'street', 'number', 'district' ,'complement', 'postal_code', 'city', 'state', 'country', 'area_code', 'phone'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];
    
    public function rules()
    {
        return [
            'name'          => 'required|string|min:3|max:255',
            'email'         => 'required|string|email|max:255|unique:users',
            'password'      => 'required|string|min:6|confirmed',
            'cpf'           => 'required|unique:users',
            'birth_date'    => 'required',
            'street'        => 'required',
            'number'        => 'integer|required',
            'district'      => 'required',
            'complement'    => 'max:200',
            'postal_code'   => 'integer|required',
            'city'          => 'required',
            'state'         => 'required',
            'country'       => 'required',
            'area_code'     => 'integer|required',
            'phone'         => 'required|integer',
        ];
    }
    
    public function rulesUpdateProfile()
    {
        $rules = $this->rules();
        
        unset($rules['password']);
        unset($rules['cpf']);
        unset($rules['email']);
        
        return $rules;
    }
    
    
    public function profileUpdate(array $data)
    {
        return $this->update($data);
    }
    
    public function updatePassword($newPassword)
    {
        $newPassword = bcrypt($newPassword);
        
        return $this->update([
            'password' => $newPassword,
        ]);
    }
}
