<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Plano extends Model
{
    //Relacionamento 1 para muitos
    public function duracoes()
    {
        //$this->hasMany(relação, chave estrangeira da relação, primary key local);
        return $this->hasMany('App\Duracoes', 'id_evento', 'id');
    }
    //Necessário para usar SoftDelete
    use SoftDeletes;
    protected $dates = ['deleted_at'];
}
