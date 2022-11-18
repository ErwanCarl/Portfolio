<?php

/* To have a strict use of variable types */
declare(strict_types=1);

use App\router\Router;
use Pecee\Http\Request;
 
Router::setDefaultNamespace('App\controllers');

//------ HOME -----//

Router::get('/', 'HomepageController@homepage');
Router::post('/sendcontactmail', 'MailController@contactMail');

//----- Mentions Legales -----//
Router::get('/legalnotice', 'LegalNoticeController@legalNotice');

// ---- Passions ------ //
Router::get('/passions', 'PassionController@passionList');

// ------ Contact ------ //
Router::get('/contact', 'ContactController@contact');

// ------ Account creation ------ //
Router::get('/accountcreation', 'AccountCreationController@accountCreation');
Router::get('/accountcreationending', 'AccountCreationController@accountClosingSession');

// ------ Account submit ------ //
Router::post('/accountsubmit', 'AccountSubmitController@accountSubmit');

// ------ connection ------ //
Router::post('/connection', 'ConnectionController@accountConnection');

// ------ Password Mail ------ //
Router::post('/sendpasswordmail', 'ConnectionController@lostPassword');

// ------ Password landing page ------ //
Router::get('/passwordlandingpage', 'ConnectionController@passwordLandingPage');

// ------ Lost Password  ------ //
Router::get('/lostpassword/{token}', 'ConnectionController@passwordModifyCheck')->where([ 'token' => '[a-z0-9]+' ]);

// ------ Password  Modify ------ //
Router::post('/passwordmodify', 'ConnectionController@passwordModify');

// ------ Close session ------ //
Router::get('/closesession', 'ConnectionController@closeSession');

// ------ Blogposts ------ //
Router::get('/blogposts', 'PostController@posts');

// ------ Administration page ------ //
Router::get('/admin', 'AdminController@administration');

// ------ Admin user search ------ //
Router::post('/usersearch', 'AdminController@usernameSearch');

// ------ Post Creation ------ //
Router::get('/postcreation', 'PostController@postCreation');

// ------ Inscription validation ------ //
Router::get('/inscriptionvalidation/{token}', 'AccountSubmitController@inscriptionValidation')->where([ 'token' => '[a-z0-9]+' ]);

// ------ Post modification ------ //
Router::get('/postmodify/{id}', 'PostController@postEdition')->where([ 'id' => '[0-9]+' ]);

// ------ Post suppression ------ //
Router::post('/postdelete/{id}', 'PostController@postDelete')->where([ 'id' => '[0-9]+' ]);

// ------ Change user role ------ //
Router::post('/changerole', 'AdminController@changeUserRole');

// ------ Post Modify submit ------ //
Router::post('/modifysubmit/{id}', 'PostController@modifySubmit')->where([ 'id' => '[0-9]+' ]);

// ------ New Post submit ------ //
Router::post('/newpostsubmit', 'PostController@newPostSubmit');

// ------ Validate comment ------ //
Router::post('/validatecomment/{id}', 'AdminController@commentValidate')->where([ 'id' => '[0-9]+' ]);

// ------ Restaurated comment ------ //
Router::post('/restauredcomment/{id}', 'AdminController@commentRestaurate')->where([ 'id' => '[0-9]+' ]);

// ------ Refused comment ------ //
Router::post('/refusedcomment/{id}', 'AdminController@commentDelete')->where([ 'id' => '[0-9]+' ]);

// ------ Add comment ------ //
Router::post('/addComment/{id}', 'AddCommentController@addComment')->where([ 'id' => '[0-9]+' ]);

// ----------- Single Post ------- //
Router::get('/post/{id}/{page}', 'PostController@post')->where([ 'id' => '[0-9]+', 'page' => '[0-9]+']);

// --------- Moderated comments ------------- //
Router::get('/moderatedcomment/{page}', 'AdminController@moderatedComment')->where([ 'page' => '[0-9]+' ]);;



//------ ERRORS ------//

Router::get('/not-found', 'ErrorController@notFound');
Router::get('/forbidden', 'ErrorController@forbidden');

Router::error(function(Request $request,\Exception $exception) {
    $codeException = $exception->getCode();
    if($codeException === 404 ) {
        response()->redirect('/not-found#not_found_page');
    }
    elseif($codeException === 403){
        response()->redirect('/forbidden#forbidden_page');
    }
    else{
        $request->setRewriteCallback('ErrorController@notFound');
    }
    });
