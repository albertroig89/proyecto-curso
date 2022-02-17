<?php

namespace App\Http\Requests;

use App\Profession;
use App\Role;
use App\User;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\Rule;

class CreateUserRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'name' => 'required',
            'email' => 'required|email|unique:users,email',
//            'email' => ['required', 'email', 'unique':users,email], FA EL MATEIX QUE LA LINEA ANTERIOR
            'password' => 'required|min:6',
            'role' => ['nullable', Rule::in(Role::getList())],
            'bio' => 'required',
            'twitter' => ['nullable', 'present', 'url'],
            'profession_id' => [
                'nullable', 'present',
                Rule::exists('professions', 'id')->where('selectable', true)
                ],
//                Rule::exists('professions', 'id')->whereNull('deleted_at')  //Per a la proba only_not_deleted_professions_can_be_selected()
//            ->where('selectable', true),
            'skills' => [
                'array',
                Rule::exists('skills', 'id'),
            ],
        ];
    }

    public function  messages()
    {
        return [
            'name.required' => 'El campo nombre es obligatorio',
            'email.required' => 'Introduce un correo electronico',
            'email.email' => 'Introduce un correo electronico correcto',
            'email.unique' => 'El correo introducido ya existe',
            'password.required' => 'Especifica una contraseña',
            'password.min' => 'La contraseña debe contener almenos 6 caracteres',
//            'profession_id.required_without' => 'Selecciona una professión o introduce una manualmente',
//            'other_profession.required_without' => 'Sino has encontrado la tuya puedes escribir-la aqui',
        ];
    }

    public function createUser()
    {

        DB::transaction(function () {

            $data = $this->validated();


            //Si no arriba la variable profession_id es perque arriba other_profession, llavors, creem la nova professio per a poder insertar-la
//            if(is_null($data['profession_id'])){
//                $profession_id = Profession::create([
//                    'title'=> $data['other_profession'],
//                ])->id;
//            }else{
                $profession_id = $data['profession_id'];
//            }



            $user = new User([
                'name' => $data['name'],
                'email' => $data['email'],
                'password' => bcrypt($data['password']),
                ]);

            $user->role = $data['role'] ?? 'user';

            $user->save();

            $user->profile()->create([
                'bio' => $data['bio'],
                'twitter' => $data['twitter'],
                'profession_id' => $profession_id,
//                'twitter' => array_get($data,'twitter'),  FA EL MATEIX QUE LINIA ANTERIOR PERO EN HELPER DE LARAVEL
//                'twitter' => $this->twitter,  FA EL MATEIX QUE LES DOS ANTERIORS
            ]);

            if (! empty ($data['skills'])) {
                $user->skills()->attach($data['skills']);
            }
//            $user->skills()->attach($data['skills'] ?? []); FA EL MATEIX QUE LES LINIES ANTERIORS
        });
    }
}
