<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Questionnaire extends Model
{
    // A FOREIGN KEY is a field (or collection of fields) in one table that refers to the PRIMARY KEY in another table.

    // The questionnaire table automatically assumed to have a 'user_id' attribute.

    // the 'user_id' is the foreign key.

    // Eloquent will look for the value of the users table's 'id' column in the 'user_id' column of the questionnaire table

    use HasFactory;
    protected $guarded = [];

    public function path()
    {
        return url('/questionnaires/'.$this->id);
    }
    // $this meaning the Questionnaire class.
    public function publicPath()
    {
        return url('/surveys/'.$this->id.'-'.Str::slug($this->title));
    }

    // a questionnaire belongs to a user
    // one to many inverse relation
    public function user()
    {
        //return $this->belongsTo('User');
        return $this->belongsTo(User::class);
    }

    public function questions()
    {
        return $this->hasMany(Question::class);
    }
        /*  class Foo
        {
            public static function bar()
            {
            return "bar";
            }
        }
        Foo::bar // access the bar method without instantiating the Foo class.

        Auth::guard($guard)->guest() : In this line you are using the guard() method of STATIC class Auth. 
        To use the function of a static class we use :: Scope Resolution Operator.
        */

        // surveys are for general people 
        // who can just go to the web page and 
        // complete the survey 
        // they don't need to log in
        // the Survey model is just used to get the user's info 
        // and on which questionnaire the user has done surveying
     public function surveys()
     {
         return $this->hasMany(Survey::class);
     }
}
