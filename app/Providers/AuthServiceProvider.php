<?php

namespace App\Providers;

use App\Http\Controllers\Admin\AuthorController;
use App\Http\Controllers\Admin\BookController;
use App\Http\Controllers\Admin\CityController;
use App\Http\Controllers\Admin\LibraryController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\CommentController;
use App\Models\Author;
use App\Models\Book;
use App\Models\City;
use App\Models\Comment;
use App\Models\Library;
use App\Models\User;
use App\Policies\CommentPolicy;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;
use Illuminate\Auth\Access\Response;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the application.
     *
     * @var array
     */
    protected $policies = [
        CommentController::class => CommentPolicy::class,
        UserController::class => CommentPolicy::class,
//        AuthorController::class =>CommentPolicy::class,
//        BookController::class => CommentPolicy::class,
//        CityController::class => CommentPolicy::class,
//        LibraryController::class => CommentPolicy::class,
//
        Comment::class => CommentPolicy::class,
        User::class => CommentPolicy::class,
//        Author::class => CommentPolicy::class,
//        Book::class => CommentPolicy::class,
//        City::class => CommentPolicy::class,
//        Library::class => CommentPolicy::class,

    'App\Models\Comment' => 'App\Policies\CommentPolicy'
    ];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerPolicies();

        //========================Поиск классов=======================================
//        Gate::guessPolicyNamesUsing(function ($className){
//            return CommentController::class;
//        });

//        ========================Поиск классов=======================================

//        Gate::define('client', function (User $user){
//            return $user->type == 'client';
//        });
//
//        Gate::define('admin', function (User $user){
//            return $user->type == 'admin';
//        });
//
//
//
//
        Gate::define('premium', function (User $user){
            foreach ($user->subscribes as $subscribe)
            {
                return  $subscribe->subscribe_type == 'Premium';
            }
            return false;
        });

        Gate::define('genres', function (User $user){
            foreach ($user->subscribes as $subscribe)
            {
                return $subscribe->subscribe_type == 'Genre';
            }
            return false;
        });

        Gate::define('authors', function (User $user){
            foreach ($user->subscribes as $subscribe)
            {
                return $subscribe->subscribe_type == 'Authors';
            }
            return false;
        });

        Gate::define('new', function (User $user){
            foreach ($user->subscribes as $subscribe)
            {
                return $subscribe->subscribe_type == 'New';
            }
            return false;
        });





        Gate::define('auth', function (User $user){
           return
               $user->type =='admin' ||
               $user->type =='super_admin';
        });
       Gate::define('admin.create', function (User $user){
            return $user->type == 'super_admin';
        });
       Gate::define('admin.delete', function (User $user){
            return $user->type == 'super_admin';
        });
//        Gate::define('banned', function (){
//            if (Auth::user()->banned){
//                return false;
//            }
//            return true;
//        });
//        Gate::define('banned', function (){
//           if(Auth::user()) {
//               return false;
//               };
//        });
    }
}
