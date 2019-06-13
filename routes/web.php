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

/**
 * Home
 */
Route::get('/home', 'HomeController@index')->name('home');

/**
 * Users
 */
Route::delete('/users/{id}/delete-permanent', 'UserManagement\UserController@deletePermanent')->name('users.delete-permanent');
Route::get('/users/{id}/restore', 'UserManagement\UserController@restore')->name('users.restore');
Route::get('/users/trash', 'UserManagement\UserController@trash')->name('users.trash');
Route::resource('users', 'UserManagement\UserController');

/**
 * Profile
 */
Route::put('profile/updatepassword', 'UserManagement\ProfileController@updatePassword')->name('updatePassword');
Route::get('profile', 'UserManagement\ProfileController@index')->name('profile.index');
Route::get('/profile/edit/{id}', 'UserManagement\ProfileController@edit')->name('profile.edit');
Route::put('/profile/update/{id}', 'UserManagement\ProfileController@update')->name('profile.update');


/**
 * Projects
 */
Route::delete('/projects/{id}/delete-permanent', 'Projects\ProjectController@deletePermanent')->name('projects.delete-permanent');
Route::get('/projects/{id}/restore', 'Projects\ProjectController@restore')->name('projects.restore');
Route::get('/ajaxSearchUser', 'Projects\ProjectController@ajaxSearchUser')->name('ajaxSearchUser');
Route::get('/projects/trash', 'Projects\ProjectController@trash')->name('projects.trash');
Route::resource('projects', 'Projects\ProjectController');


/**
 * Stories
 */
Route::delete('/stories/{id}/delete-permanent', 'Requirements\StoryController@deletePermanent')->name('stories.delete-permanent');
Route::delete('/stories/{id}/destroy', 'Requirements\StoryController@destroy')->name('stories.destroy');
Route::get('/stories/{id}/restore', 'Requirements\StoryController@restore')->name('stories.restore');
Route::get('/stories/trash', 'Requirements\StoryController@trash')->name('stories.trash');
Route::get('/ajaxSearchProjects', 'Requirements\StoryController@ajaxSearchProjects')->name('ajaxSearchProjects');
Route::post('/stories/store/{id}', 'Requirements\StoryController@store')->name('stories.store');
Route::get('/stories/create/{id}', 'Requirements\StoryController@create')->name('stories.create');
Route::get('/stories/{id}', 'Requirements\StoryController@index')->name('stories.index');
Route::get('/stories/show/{id}', 'Requirements\StoryController@show')->name('stories.show');
Route::get('/stories/edit/{id}', 'Requirements\StoryController@edit')->name('stories.edit');
Route::put('/stories/update/{id}', 'Requirements\StoryController@update')->name('stories.update');

/**
 * Condition
 */
Route::delete('/conditions/{id}/destroy', 'Requirements\ConditionController@destroy')->name('conditions.destroy');
Route::get('/conditions/show/{id}', 'Requirements\ConditionController@show')->name('conditions.show');
Route::get('/conditions/edit/{id}', 'Requirements\ConditionController@edit')->name('conditions.edit');
Route::post('/conditions/store/{id}', 'Requirements\ConditionController@store')->name('conditions.store');
Route::put('/conditions/update/{id}', 'Requirements\ConditionController@update')->name('conditions.update');
Route::get('/conditions/create/{id}', 'Requirements\ConditionController@createByStory')->name('conditions.create');

/**
 * Features
 */
Route::get('/ajaxSearchFeature/{id}', 'Requirements\FeatureController@ajaxSearchFeature')->name('ajaxSearchFeature');
Route::get('/features/{id}/restore', 'Requirements\FeatureController@restore')->name('features.restore');
Route::delete('/features/{id}/delete-permanent', 'Requirements\FeatureController@deletePermanent')->name('features.delete-permanent');
Route::get('/features/trash', 'Requirements\FeatureController@trash')->name('features.trash');
Route::delete('/features/{id}/destroy', 'Requirements\FeatureController@destroy')->name('features.destroy');
Route::put('/features/update/{id}', 'Requirements\FeatureController@update')->name('features.update');
Route::get('/features/edit/{id}', 'Requirements\FeatureController@edit')->name('features.edit');
Route::get('/features/show/{id}', 'Requirements\FeatureController@show')->name('features.show');
Route::post('/features/store/{id}', 'Requirements\FeatureController@store')->name('features.store');
Route::get('/features/create/{id}', 'Requirements\FeatureController@create')->name('features.create');

/**
 * Menus
 */
Route::get('/menus/index/{id}', 'Menus\MenuController@index')->name('menus.index');

/**
 * Scenarios
 */
Route::get('/ajaxSearchScenario/{id}', 'Specifications\ScenarioController@ajaxSearchScenario')->name('ajaxSearchScenario');
Route::delete('/scenarios/{id}/delete-permanent', 'Specifications\ScenarioController@deletePermanent')->name('scenarios.delete-permanent');
Route::get('/scenarios/{id}/restore', 'Specifications\ScenarioController@restore')->name('scenarios.restore');
Route::get('/scenarios/trash', 'Specifications\ScenarioController@trash')->name('scenarios.trash');
Route::delete('/scenarios/{id}/destroy', 'Specifications\ScenarioController@destroy')->name('scenarios.destroy');
Route::put('/scenarios/update/{scenario_id}/{project_id}', 'Specifications\ScenarioController@update')->name('scenarios.update');
Route::get('/scenarios/edit/{scenario_id}/{project_id}', 'Specifications\ScenarioController@edit')->name('scenarios.edit');
Route::get('/scenarios/show/{scenario_id}/{project_id}', 'Specifications\ScenarioController@show')->name('scenarios.show');
Route::post('/scenarios/store/{id}', 'Specifications\ScenarioController@store')->name('scenarios.store');
Route::get('/scenarios/create/{id}', 'Specifications\ScenarioController@create')->name('scenarios.create');
Route::get('/scenarios/{id}', 'Specifications\ScenarioController@index')->name('scenarios.index');

/**
 * Testcases
 */
Route::delete('/testcases/{id}/delete-permanent', 'Specifications\TestcaseController@deletePermanent')->name('testcases.delete-permanent');
Route::get('/testcases/{id}/restore', 'Specifications\TestcaseController@restore')->name('testcases.restore');
Route::get('/testcases/trash', 'Specifications\TestcaseController@trash')->name('testcases.trash');
Route::delete('/testcases/{id}/destroy', 'Specifications\TestcaseController@destroy')->name('testcases.destroy');
Route::put('/testcases/update/{testcase_id}/{project_id}', 'Specifications\TestcaseController@update')->name('testcases.update');
Route::get('/testcases/edit/{project_id}/{testcase_id}', 'Specifications\TestcaseController@edit')->name('testcases.edit');
Route::get('/testcases/show/{project_id}/{testcase_id}', 'Specifications\TestcaseController@show')->name('testcases.show');
Route::post('/testcases/store/{id}', 'Specifications\TestcaseController@store')->name('testcases.store');
Route::get('/testcases/create/{id}', 'Specifications\TestcaseController@create')->name('testcases.create');
Route::get('/testcases/{id}', 'Specifications\TestcaseController@index')->name('testcases.index');

/**
 * Issues
 */
Route::get('/ajaxAssignedTo/{id}', 'Executions\IssueController@ajaxAssignedTo')->name('ajaxAssignedTo');
Route::get('/issues/{id}/restore', 'Executions\IssueController@restore')->name('issues.restore');
Route::get('/issues/trash', 'Executions\IssueController@trash')->name('issues.trash');
Route::delete('/issues/{id}/delete-permanent', 'Executions\IssueController@deletePermanent')->name('issues.delete-permanent');
Route::delete('/issues/{id}/destroy', 'Executions\IssueController@destroy')->name('issues.destroy');
Route::put('/issues/update/{issue_id}/{project_id}', 'Executions\IssueController@update')->name('issues.update');
Route::get('/issues/edit/{issue_id}/{project_id}', 'Executions\IssueController@edit')->name('issues.edit');
Route::get('/issues/show/{id}', 'Executions\IssueController@show')->name('issues.show');
Route::post('/issues/store/{id}', 'Executions\IssueController@store')->name('issues.store');
Route::get('/issues/create/{id}', 'Executions\IssueController@create')->name('issues.create');
Route::get('/issues/{id}/done', 'Executions\IssueController@setDone')->name('issues.done');
Route::get('/issues/detail/{id}', 'Executions\IssueController@detail')->name('issues.detail');
Route::get('/issues', 'Executions\IssueController@index')->name('issues.index');

/**
 * Comment
 */
Route::post('/comment/store/{id}', 'Executions\CommentController@store')->name('comment.store');
