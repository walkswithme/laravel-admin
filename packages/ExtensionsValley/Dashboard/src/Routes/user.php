<?php

Route::group(['prefix' => 'admin', 'middleware' => ['admin', 'auth:admin']], function () {
    Route::get('/adduser', [
        'middleware' => 'acl:add',
        'name' => 'Add User',
        'as' => 'extensionsvalley.admin.adduser',
        'uses' => 'ExtensionsValley\Dashboard\Controllers\UserController@addUser',
    ]);
    Route::get('/edituser/{id}', [
        'middleware' => 'acl:edit',
        'name' => 'Edit User',
        'as' => 'extensionsvalley.admin.edituser',
        'uses' => 'ExtensionsValley\Dashboard\Controllers\UserController@editUser',
    ]);
    Route::post('/saveuser', [
        'middleware' => 'acl:add',
        'name' => 'Save User',
        'as' => 'extensionsvalley.admin.saveuser',
        'uses' => 'ExtensionsValley\Dashboard\Controllers\UserController@saveUser',
    ]);
    Route::post('/updateuser', [
        'middleware' => 'acl:edit',
        'name' => 'Save User',
        'as' => 'extensionsvalley.admin.updateuser',
        'uses' => 'ExtensionsValley\Dashboard\Controllers\UserController@updateUser',
    ]);
    Route::get('/viewuser/{id}', [
        'middleware' => 'acl:view',
        'name' => 'View User',
        'as' => 'extensionsvalley.admin.viewuser',
        'uses' => 'ExtensionsValley\Dashboard\Controllers\UserController@viewUser',
    ]);
    Route::get('/logout', [
        'name' => 'Log out user',
        'as' => 'extensionsvalley.admin.logout',
        'uses' => 'ExtensionsValley\Dashboard\Controllers\LoginController@logOut',
    ]);

    Route::get('/profile', [
        'name' => 'Edit Usersprofile',
        'as' => 'extensionsvalley.admin.editusersprofile',
        'uses' => 'ExtensionsValley\Dashboard\Controllers\UsersprofileController@editUsersprofile',
    ]);

    Route::post('/updateusersprofile', [
        'name' => 'updateUsersprofile',
        'as' => 'extensionsvalley.admin.updateusersprofile',
        'uses' => 'ExtensionsValley\Dashboard\Controllers\UsersprofileController@updateUsersprofile',
    ]);
    Route::post('/updateuserpassword', [
        'name' => 'Update User Password',
        'as' => 'extensionsvalley.admin.updateuserpassword',
        'uses' => 'ExtensionsValley\Dashboard\Controllers\UsersprofileController@updateUserpassword',
    ]);
    Route::post('/activatesubscriptions', [
        'name' => 'Activate Subscriptions',
        'as' => 'extensionsvalley.admin.activatesubscriptions',
        'uses' => 'ExtensionsValley\Dashboard\Controllers\UserController@activateSubscriptions',
    ]);


});

/* Login Autendication routes */
Route::group(['prefix' => 'admin', 'before' => ['admin', 'csrf']], function () {

    Route::group(['middleware' => ['admin']], function () {
        Route::post('/authendicate', [
            'before' => 'throttle:3,60',
            'name' => 'Authendication',
            'as' => 'extensionsvalley.admin.auth',
            'uses' => 'ExtensionsValley\Dashboard\Controllers\LoginController@getAutendicate',
        ]);
    });


});
Route::group(['middleware' => ['admin']], function () {
    Route::get('/login', [
        'name' => 'Login',
        'as' => 'extensionsvalley.admin.login',
        'uses' => 'ExtensionsValley\Dashboard\Controllers\LoginController@getIndex',
    ]);
});
Route::group(['prefix' => 'admin', 'middleware' => ['admin']], function () {
    Route::get('/', [
        'name' => 'Login',
        'as' => 'extensionsvalley.admin.login',
        'uses' => 'ExtensionsValley\Dashboard\Controllers\LoginController@getIndex',
    ]);
});
Route::get('password/reset/{token}', [
    'middleware' => 'admin',
    'name' => 'Password Reset',
    'as' => 'extensionsvalley.admin.passwordconfirm',
    'uses' => 'ExtensionsValley\Dashboard\Controllers\PasswordController@getResetConfirm',
]);

/* User Reset Pasword routes */
Route::group(['prefix' => 'admin', 'middleware' => ['admin']], function () {
    Route::get('/password/reset', [
        'name' => 'Password Reset',
        'as' => 'extensionsvalley.admin.reset',
        'uses' => 'ExtensionsValley\Dashboard\Controllers\PasswordController@getResetView',
    ]);
    Route::post('/password/email', [
        'name' => 'Password Reset',
        'as' => 'extensionsvalley.admin.passwordreset',
        'uses' => 'ExtensionsValley\Dashboard\Controllers\PasswordController@postResetData',
    ]);
    Route::get('password/reset/{token}', [
        'name' => 'Password Reset',
        'as' => 'extensionsvalley.admin.passwordconfirm',
        'uses' => 'ExtensionsValley\Dashboard\Controllers\PasswordController@getResetConfirm',
    ]);
    Route::post('password/change/', [
        'name' => 'Password Reset',
        'as' => 'extensionsvalley.admin.changepassword',
        'uses' => 'ExtensionsValley\Dashboard\Controllers\PasswordController@postReset',
    ]);

});
