# gg-url-shortner
Url shortener API - Laravel + Angular JS 



#API Shortener description:

#1.Technologies used: 

1.1.Laravel PHP Framework  - used last version 5.3
The choice was made because the last versions of Laravel have very good default user login/regisrter module which is easy to be set up and modified. 
The framework very good default api functionalities, routes and requests processing which will be used as well.

1.2.MySql will be used as a database. The Schema can be found in project folder db_schema.sql. Laravel Framework supports migrations. The database schema is described and can be set up from the project running the command:

 php artisian migrate

The migration files can be found in “database/migrations/”  folder 

1.3.Angular JS, Jquery, Twitter Bootstrap, Laravel’s blade templates and direct loading of templates for angular module will be used  for the frontend setup.


#2.Routes:

	Main routes:
	GET|HEAD | / - App\Http\Controllers\IndexController@home
	GET|HEAD | home- App\Http\Controllers\HomeController@index   
	GET|HEAD  | /{id} - App\Http\Controllers\IndexController@resources 
		- here the id is the actual shortened link. 
		- If no present in the database 404 error page will be displayed

Login/Register routes:
                
	GET|HEAD | login | App\Http\Controllers\Auth\LoginController@showLoginForm                
	POST     | login |  App\Http\Controllers\Auth\LoginController@login
	POST     | logout | App\Http\Controllers\Auth\LoginController@logout                       
	POST     | password/email | App\Http\Controllers\Auth\ForgotPasswordController@sendResetLinkEmail  
	GET|HEAD | password/reset | App\Http\Controllers\Auth\ForgotPasswordController@showLinkRequestForm  
	POST     | password/reset | App\Http\Controllers\Auth\ResetPasswordController@reset   
	GET|HEAD | password/reset/{token} | App\Http\Controllers\Auth\ResetPasswordController@showResetForm         
	GET|HEAD | register  | App\Http\Controllers\Auth\RegisterController@showRegistrationForm 
	POST     | register | App\Http\Controllers\Auth\RegisterController@register        

API routes:

	Returned http codes: 
		- 200 - ok
		- 401 - unauthenticated
		- 422 – the request is understood but can not be handeled
		- 404 - error

	GET|HEAD | api/items | items.index | App\Http\Controllers\ItemController@index

	returned json sample response:

	{"app_url":"http:\/\/localhost\/","resource":{"total":5,"per_page":5,"current_page":1,"last_page":1,"next_page_url":null,"prev_page_url":null,"from":1,"to":5,"data":[{"id":29,"user_id":1,"long_url":"http:\/\/www.radiotunes.com\/oldschoolfunknsoul","short_code":"Fr7B3V","created_at":"2016-10-12 06:38:22","updated_at":"2016-10-12 06:38:22"}]}}


	POST | api/items | items.store | App\Http\Controllers\ItemController@store

	returned json sample response:

	{"user_id":1,"long_url":"http:\/\/www.di.fm\/","short_code":"wKsCVd","updated_at":"2016-10-12 07:41:25","created_at":"2016-10-12 07:41:25","id":33}

	PUT|PATCH | api/items/{item} | items.update | App\Http\Controllers\ItemController@update

	returned json sample response:

	{"id":33,"user_id":1,"long_url":"http:\/\/www.di.fm\/","short_code":"wKsCVd","created_at":"2016-10-12 07:41:25","updated_at":"2016-10-12 07:41:25"}

	GET|HEAD | api/items/{item}/edit | items.edit | App\Http\Controllers\ItemController@edit

	returned json sample response:

	{"id":33,"user_id":1,"long_url":"http:\/\/www.di.fm\/","short_code":"wKsCVd","cr
	eated_at":"2016-10-12 07:41:25","updated_at":"2016-10-12 07:41:25"}

	DELETE | api/items/{item} | items.destroy | App\Http\Controllers\ItemController@destroy

	returned json sample response:

	{"success":true}



#3.Authentication flow. 
3.1.Users php session authentication.
Uses email and password. Used for the login and register functionalities. Uses php session id stored in browser session in order to authenticate the user session in the framework’s system. 

3.2.Api token authentication. 
Uses api_token related to user - generated and stored in the main users table. 
The API itself is stateless and the authentication is made on every request on basis of the passed token. The token can be passed in 2 ways:
- as GET parameter – api_token with according value
- as Header parameter: “Authorization”:”Bearer {api_token}”

The token for registered users is not shown in the interface but can be taken from the interface requests. 

#4.The short url code is generated on random from set of characters with given length for the end code
After random code generation it is checked with the database, if there is a match new is generated. 

The characters used: 
digits 1-9 along with various upper/lowercase letters with removed vowels to prevent having links created which are unintended bad words, and removed any characters that could be confused with each other. These are 50 characters which are set as variable in the App/Repositories/ItemRepository class.


With these 50 characters available for each digit if we use 6 (which is chosen) length code we will have over 15 billion combinations. The length also is set as parameter in App/Repositories/ItemRepository class and can be changed easily. 

#5.The redirect used for the external link redirect is sent with status code 301


