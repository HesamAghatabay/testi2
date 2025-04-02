<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;

use GuzzleHttp\Client;
use GuzzleHttp\Psr7\Request;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Passport\HasApiTokens;


class User extends Authenticatable
{
    /** @use HasFactory<\Database\Factories\UserFactory> */
    use HasFactory, Notifiable, SoftDeletes, HasApiTokens;

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    public function findForPassport($identifier)
    {
        return $this->orwhere('email', $identifier)
            ->orWhere('mobile', $identifier)->first();
    }
    protected $fillable = [
        'name',
        'email',
        'mobile',
        'password',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var list<string>
     */
    protected $hidden = [
        'password',
        'created_at',
        'updated_at',
        'remember_token',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }
    public function profile()
    {
        return $this->hasOne(Profile::class);
    }
    protected $with = ['profile'];

    public function sendVerifyCode($code, $mobile)
    {


        $client = new \GuzzleHttp\Client([
            'verify' => false
        ]);

        // $client = new Client();
        $headers = [
            'apikey' => 'OWU4NjNkYzItNGI4NS00YWFkLWFlODMtZWFhN2FjZTMxNmRjNDdiNDE3MDI4ZWViNDYyOTRhMGI2YWJkODcwZmFjMGE=',
            'accept' => '*/*',
            'Content-Type' => 'application/json',

        ];
        $body = '{
  "code": "23gu0ju6r9ce99a",
  "sender": "+983000505",
  "recipient": "' . $mobile . '",
  "variable": {
    "code": "' . $code . '"
  }
}';
        $request = new Request('POST', 'https://api2.ippanel.com/api/v1/sms/pattern/normal/send', $headers, $body);
        $res = $client->sendAsync($request)->wait();
        echo $res->getBody();

        // $client = new \GuzzleHttp\Client([
        //     'verify' => false // Disable SSL certificate verification
        // ]);

        // $headers = [
        //     'apikey' => 'OWU4NjNkYzItNGI4NS00YWFkLWFlODMtZWFhN2FjZTMxNmRjNDdiNDE3MDI4ZWViNDYyOTRhMGI2YWJkODcwZmFjMGE=',
        //     'accept' => '*/*',
        //     'Content-Type' => 'application/json',
        // ];

        // $body = '{
        //     "code": "3rngaecq55dohh9",
        //     "sender": "+983000505",
        //     "recipient": "+989398175140",
        //     "variable": {
        //         "code": "1234",
        //     }
        // }';

        // $request = new \GuzzleHttp\Psr7\Request('POST', 'https://api2.ippanel.com/api/v1/sms/pattern/normal/send', $headers, $body);
        // $response = $client->sendAsync($request)->wait();

        // echo $response->getBody();

    }

    public function posts()
    {
        return $this->hasMany(Post::class);
    }


}
