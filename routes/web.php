<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

// Web routes
Route::get('/', [
    'uses' => 'ViewController@getIndex',
    'as' => 'index'
]);
Route::get('/about', [
    'uses' => 'ViewController@getAbout',
    'as' => 'about'
]);


// Contact us
Route::get('/contact', [
    'uses' => 'ViewController@getContact',
    'as' => 'home-contacts'
]);
Route::post('/contact/post', [
    'uses' => 'ViewController@postContact',
    'as' => 'post.contact'
]);

// Projects
Route::get('/projects', [
    'uses' => 'ViewController@getProjects',
    'as' => 'home-projects'
]);
Route::get('/project/{id}', [
    'uses' => 'ViewController@getProjectDetail',
    'as' => 'project-detail'
]);

// Events
Route::get('/events', [
    'uses' => 'ViewController@getEvents',
    'as' => 'home-events'
]);
Route::get('/event/{id}', [
    'uses' => 'ViewController@getEventDetail',
    'as' => 'event-detail'
]);

Auth::routes();
Route::get('/home', function(){
    return view('home');
})->middleware('auth');

Route::get('/admin', [
    'uses' => 'Dashboard\DashboardController@getDashboardLogin',
    'as' => 'dashboard.login'
]);
Route::get('/admin/forgot/password', [
    'uses' => 'Dashboard\DashboardController@getForgotPassword',
    'as' => 'forgot.password'
]);
Route::get('/admin/reset/password', [
    'uses' => 'Dashboard\DashboardController@getResetPassword',
    'as' => 'reset.password'
]);

Route::group(['prefix' => 'admin','middleware' => 'auth'], function () {
    Route::get('/dashboard', [
        'uses' => 'Dashboard\DashboardController@getDashboard',
        'as' => 'dashboard'
    ]);

    Route::get('/logout', [
        'uses' => 'Dashboard\DashboardController@logout',
        'as' => 'logout'
    ]);

    //footer
    // Route::get('/', 'Dashboard\SettingController@getFooter')->name('dashboard.footer.all');
    Route::get('/footer', [
        'uses' => 'Dashboard\SettingController@getFooters',
        'as' => 'footers'
    ]);
     Route::get('/footer/edit', [
        'uses' => 'Dashboard\SettingController@getEditfooter',
        'as' => 'edit-footer'
    ]);
    Route::put('/footer/edit', [
        'uses' => 'Dashboard\SettingController@updateFooter',
        'as' => 'edit.footer'
    ]);

    //abouts
    Route::get('/about', [
        'uses' => 'Dashboard\AboutController@getAbouts',
        'as' => 'abouts'
    ]);
    Route::get('/about/edit', [
        'uses' => 'Dashboard\AboutController@getEditabout',
        'as' => 'edit-about'
    ]);
    Route::put('/about/edit', [
        'uses' => 'Dashboard\AboutController@updateAbout',
        'as' => 'edit.about'
    ]);

    // Projects
    Route::get('/projects', [
        'uses' => 'Dashboard\ProjectController@getProjects',
        'as' => 'projects'
    ]);
    Route::get('/project/add', [
        'uses' => 'Dashboard\ProjectController@getAddProject',
        'as' => 'new-project'
    ]);
    Route::post('/project/add', [
        'uses' => 'Dashboard\ProjectController@postNewProject',
        'as' => 'new.project'
    ]);
    Route::get('/project/edit/{id}', [
        'uses' => 'Dashboard\ProjectController@getEditProject',
        'as' => 'edit-project'
    ]);
    Route::put('/project/edit', [
        'uses' => 'Dashboard\ProjectController@updateProject',
        'as' => 'edit.project'
    ]);
    Route::delete('/project', [
        'uses' => 'Dashboard\ProjectController@deleteProject',
        'as' => 'delete.project'
    ]);

    // category
    Route::get('/categories', [
        'uses' => 'Dashboard\CategoryController@getCategories',
        'as' => 'categories'
    ]);
    Route::get('/category/add', [
        'uses' => 'Dashboard\CategoryController@getAddCategory',
        'as' => 'new-category'
    ]);
    Route::post('/category/add', [
        'uses' => 'Dashboard\CategoryController@postNewCategory',
        'as' => 'new.category'
    ]);
    Route::get('/category/edit/{id}', [
        'uses' => 'Dashboard\CategoryController@getEditcategory',
        'as' => 'edit-category'
    ]);
    Route::put('/category/edit', [
        'uses' => 'Dashboard\CategoryController@updatecategory',
        'as' => 'edit.category'
    ]);
    Route::delete('/category', [
        'uses' => 'Dashboard\CategoryController@deletecategory',
        'as' => 'delete.category'
    ]);

    // Gallery
    Route::post('/project/upload/gallery', [
        'uses' => 'Dashboard\GalleryController@uploadProjectGallery',
        'as' => 'upload.project.gallery'
    ]);
    Route::post('/ajax-removeProjectGallery', [
        'uses' => 'Dashboard\GalleryController@ajaxDeleteProjectGallery',
        'as' => 'ajax-removeProjectGallery'
    ]);

    // Events
    Route::get('/events', [
        'uses' => 'Dashboard\EventController@getEvents',
        'as' => 'events'
    ]);
    Route::get('/event/add', [
        'uses' => 'Dashboard\EventController@getAddEvent',
        'as' => 'new-event'
    ]);
    Route::post('/event/add', [
        'uses' => 'Dashboard\EventController@postEvent',
        'as' => 'new.event'
    ]);
    Route::get('/event/edit/{id}', [
        'uses' => 'Dashboard\EventController@getEditEvent',
        'as' => 'edit-event'
    ]);
    Route::put('/event/edit/', [
        'uses' => 'Dashboard\EventController@updateEvent',
        'as' => 'edit.event'
    ]);
    Route::delete('/event', [
        'uses' => 'Dashboard\EventController@deleteEvent',
        'as' => 'delete.event'
    ]);

    // Contact Queries
    Route::get('/contact/queries', [
        'uses' => 'Dashboard\ContactController@getContactQueries',
        'as' => 'contacts'
    ]);
    Route::patch('/toggle/contact/status', [
        'uses' => 'Dashboard\ContactController@toggleContactStatus',
        'as' => 'toggle.contact.status'
    ]);
    Route::delete('/delete/contact/queries', [
        'uses' => 'Dashboard\ContactController@deleteContactQuery',
        'as' => 'delete.contact.query'
    ]);

    // User Profile
    Route::get('/user/profile', [
        'uses' => 'Dashboard\DashboardController@getUserProfile',
        'as' => 'user-profile'
    ]);
    Route::get('/user/profile/edit', [
        'uses' => 'Dashboard\DashboardController@getEditUserProfile',
        'as' => 'edit-profile'
    ]);
    Route::put('/user/profile/update', [
        'uses' => 'Dashboard\DashboardController@updateUserProfile',
        'as' => 'update.profile'
    ]);
    Route::put('/user/profile/update/password', [
        'uses' => 'Dashboard\DashboardController@updateUserPassword',
        'as' => 'update.password'
    ]);
});
