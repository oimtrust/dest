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

Route::get('/', function () {
    return view('auth.login');
});

Auth::routes();
Route::match(['get', 'post'], '/register', function () {
    return redirect('/login');
})->name('register');

Route::middleware(['authenticated'])->group(function () {

    /**
     * Home
     */
    Route::get('/home', 'HomeController@index')->name('home');

    /**
     * Profile
     */
    Route::put('profile/updatepassword', 'UserManagement\ProfileController@updatePassword')->name('updatePassword');
    Route::get('profile', 'UserManagement\ProfileController@index')->name('profile.index');
    Route::get('/profile/edit/{id}', 'UserManagement\ProfileController@edit')->name('profile.edit');
    Route::put('/profile/update/{id}', 'UserManagement\ProfileController@update')->name('profile.update');

     /**
     * Comment
     */
    Route::post('/comment/store/{id}', 'Executions\CommentController@store')->name('comment.store');

    /**
     * Notifications
     */
    Route::get('/notifications/{id}/read', 'Notifications\NotificationController@read')->name('notifications.read');
    Route::get('/notifications', 'Notifications\NotificationController@index')->name('notifications.index');

    /**
     * Projects
     */
    Route::prefix('projects')->middleware(['authenticated', 'authorize:admin'])->group(function () {
        Route::delete('/{id}/delete-permanent', 'Projects\ProjectController@deletePermanent')->name('projects.delete-permanent');
        Route::get('/{id}/restore', 'Projects\ProjectController@restore')->name('projects.restore');
    });
    Route::get('/trash/projects', 'Projects\ProjectController@trash')->name('trash.projects')->middleware(['authenticated', 'authorize:admin']);

    Route::resource('projects', 'Projects\ProjectController')->middleware(['authenticated', 'authorize:project-manager,quality-assurance,admin']);

    Route::get('/ajaxSearchUser', 'Projects\ProjectController@ajaxSearchUser')->name('ajaxSearchUser');

    /**
     * Stories
     */
    Route::prefix('stories')->middleware(['authenticated', 'authorize:admin,quality-assurance'])->group(function () {
        Route::delete('/{id}/delete-permanent', 'Requirements\StoryController@deletePermanent')->name('stories.delete-permanent');
        Route::delete('/{id}/destroy', 'Requirements\StoryController@destroy')->name('stories.destroy');
        Route::get('/{id}/restore', 'Requirements\StoryController@restore')->name('stories.restore');
        Route::post('/store/{id}', 'Requirements\StoryController@store')->name('stories.store');
        Route::get('/create/{id}', 'Requirements\StoryController@create')->name('stories.create');
        Route::get('/{id}', 'Requirements\StoryController@index')->name('stories.index');
        Route::get('/show/{id}', 'Requirements\StoryController@show')->name('stories.show');
        Route::get('/edit/{id}', 'Requirements\StoryController@edit')->name('stories.edit');
        Route::put('/update/{id}', 'Requirements\StoryController@update')->name('stories.update');
    });
    Route::get('/trash/stories', 'Requirements\StoryController@trash')->name('trash.stories')->middleware(['authenticated', 'authorize:admin']);
    Route::get('/ajaxSearchProjects', 'Requirements\StoryController@ajaxSearchProjects')->name('ajaxSearchProjects');


    /**
     * Condition
     */
    Route::prefix('conditions')->middleware(['authenticated', 'authorize:admin,quality-assurance'])->group(function () {
        Route::delete('/{id}/destroy', 'Requirements\ConditionController@destroy')->name('conditions.destroy');
        Route::get('/show/{id}', 'Requirements\ConditionController@show')->name('conditions.show');
        Route::get('/edit/{id}', 'Requirements\ConditionController@edit')->name('conditions.edit');
        Route::post('/store/{id}', 'Requirements\ConditionController@store')->name('conditions.store');
        Route::put('/update/{id}', 'Requirements\ConditionController@update')->name('conditions.update');
        Route::get('/create/{id}', 'Requirements\ConditionController@createByStory')->name('conditions.create');
    });

    /**
     * Features
     */
    Route::get('/ajaxSearchFeature/{id}', 'Requirements\FeatureController@ajaxSearchFeature')->name('ajaxSearchFeature');
    Route::prefix('features')->middleware(['authenticated', 'authorize:admin,quality-assurance'])->group(function () {
        Route::get('/{id}/restore', 'Requirements\FeatureController@restore')->name('features.restore');
        Route::delete('/{id}/delete-permanent', 'Requirements\FeatureController@deletePermanent')->name('features.delete-permanent');
        Route::delete('/{id}/destroy', 'Requirements\FeatureController@destroy')->name('features.destroy');
        Route::put('/update/{id}', 'Requirements\FeatureController@update')->name('features.update');
        Route::get('/edit/{id}', 'Requirements\FeatureController@edit')->name('features.edit');
        Route::get('/show/{id}', 'Requirements\FeatureController@show')->name('features.show');
        Route::post('/store/{id}', 'Requirements\FeatureController@store')->name('features.store');
        Route::get('/create/{id}', 'Requirements\FeatureController@create')->name('features.create');
    });
    Route::get('/trash/features', 'Requirements\FeatureController@trash')->name('trash.features')->middleware(['authenticated', 'authorize:admin']);

    /**
     * Menus
     */
    Route::get('/menus/index/{id}', 'Menus\MenuController@index')->name('menus.index')->middleware(['authenticated', 'authorize:admin,quality-assurance']);

    /**
     * Scenarios
     */
    Route::get('/ajaxSearchScenario/{id}', 'Specifications\ScenarioController@ajaxSearchScenario')->name('ajaxSearchScenario');
    Route::prefix('scenarios')->middleware(['authenticated', 'authorize:admin,quality-assurance'])->group(function () {
        Route::delete('/{id}/delete-permanent', 'Specifications\ScenarioController@deletePermanent')->name('scenarios.delete-permanent');
        Route::get('/{id}/restore', 'Specifications\ScenarioController@restore')->name('scenarios.restore');
        Route::delete('/{id}/destroy', 'Specifications\ScenarioController@destroy')->name('scenarios.destroy');
        Route::put('/update/{scenario_id}/{project_id}', 'Specifications\ScenarioController@update')->name('scenarios.update');
        Route::get('/edit/{scenario_id}/{project_id}', 'Specifications\ScenarioController@edit')->name('scenarios.edit');
        Route::get('/show/{scenario_id}/{project_id}', 'Specifications\ScenarioController@show')->name('scenarios.show');
        Route::post('/store/{id}', 'Specifications\ScenarioController@store')->name('scenarios.store');
        Route::get('/create/{id}', 'Specifications\ScenarioController@create')->name('scenarios.create');
        Route::get('/{id}', 'Specifications\ScenarioController@index')->name('scenarios.index');
    });
    Route::get('/trash/scenarios', 'Specifications\ScenarioController@trash')->name('trash.scenarios')->middleware(['authenticated', 'authorize:admin']);

    /**
     * Testcases
     */
    Route::prefix('testcases')->middleware(['authenticated', 'authorize:admin,quality-assurance'])->group(function () {
        Route::delete('/{id}/delete-permanent', 'Specifications\TestcaseController@deletePermanent')->name('testcases.delete-permanent');
        Route::get('/{id}/restore', 'Specifications\TestcaseController@restore')->name('testcases.restore');
        Route::delete('/{project_id}/{testcase_id}/destroy', 'Specifications\TestcaseController@destroy')->name('testcases.destroy');
        Route::put('/update/{testcase_id}/{project_id}', 'Specifications\TestcaseController@update')->name('testcases.update');
        Route::get('/edit/{project_id}/{testcase_id}', 'Specifications\TestcaseController@edit')->name('testcases.edit');
        Route::get('/show/{project_id}/{testcase_id}', 'Specifications\TestcaseController@show')->name('testcases.show');
        Route::post('/store/{id}', 'Specifications\TestcaseController@store')->name('testcases.store');
        Route::get('/create/{id}', 'Specifications\TestcaseController@create')->name('testcases.create');
        Route::get('/{id}', 'Specifications\TestcaseController@index')->name('testcases.index');
    });
    Route::get('/trash/testcases', 'Specifications\TestcaseController@trash')->name('trash.testcases')->middleware(['authenticated', 'authorize:admin']);

    /**
     * Issues
     */
    Route::get('/ajaxAssignedTo/{id}', 'Executions\IssueController@ajaxAssignedTo')->name('ajaxAssignedTo');
    Route::prefix('issues')->middleware(['authenticated', 'authorize:admin,quality-assurance,developer'])->group(function() {
        Route::get('/{id}/restore', 'Executions\IssueController@restore')->name('issues.restore');
        Route::delete('/{id}/delete-permanent', 'Executions\IssueController@deletePermanent')->name('issues.delete-permanent');
        Route::delete('/{id}/destroy', 'Executions\IssueController@destroy')->name('issues.destroy');
        Route::put('/update/{issue_id}/{project_id}', 'Executions\IssueController@update')->name('issues.update');
        Route::get('/edit/{issue_id}/{project_id}', 'Executions\IssueController@edit')->name('issues.edit');
        Route::get('/show/{id}', 'Executions\IssueController@show')->name('issues.show');
        Route::post('/store/{id}', 'Executions\IssueController@store')->name('issues.store');
        Route::get('/create/{id}', 'Executions\IssueController@create')->name('issues.create');
        Route::get('/{id}/done', 'Executions\IssueController@setDone')->name('issues.done');
        Route::get('/detail/{id}', 'Executions\IssueController@detail')->name('issues.detail');
        Route::get('/', 'Executions\IssueController@index')->name('issues.index');
    });
    Route::get('/trash/issues', 'Executions\IssueController@trash')->name('trash.issues')->middleware(['authenticated', 'authorize:admin']);


    /**
     * Users
     */
    Route::prefix('users')->middleware(['authenticated', 'authorize:admin'])->group(function () {
        Route::delete('/{id}/delete-permanent', 'UserManagement\UserController@deletePermanent')->name('users.delete-permanent');
        Route::get('/{id}/restore', 'UserManagement\UserController@restore')->name('users.restore');
        Route::get('/role/{id}', 'UserManagement\UserRoleController@findRoleByUser')->name('users.role');
    });
    Route::get('/trash/users', 'UserManagement\UserController@trash')->name('trash.users')->middleware(['authenticated', 'authorize:admin']);
    Route::resource('users', 'UserManagement\UserController')->middleware(['authenticated', 'authorize:admin']);


    /**
     * Roles
     */
    Route::prefix('userrole')->middleware(['authenticated', 'authorize:admin'])->group(function () {
        Route::put('/attachRole/{id}', 'UserManagement\UserRoleController@attachRole')->name('userrole.attachRole');
        Route::get('/', 'UserManagement\UserRoleController@index')->name('userrole.index');
    });
    Route::get('/ajaxSearchRole', 'UserManagement\UserRoleController@ajaxSearchRole')->name('ajaxSearchRole');
    Route::resource('roles', 'UserManagement\RoleController')->middleware(['authenticated', 'authorize:admin']);
});

