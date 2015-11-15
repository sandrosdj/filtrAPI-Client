filtrLogin
===========

https://filtr.sandros.hu

##Introduction
This is the official GIT repository for the filtrLogin system.

Filtr. or filtrLogin is an indentity provider, an analytics system and a nice page to look at.
It can be very useful if you're building something and you want to know what options or elements are the most "popular". You track whatever and whoever you want, but respect the users rights!

We have introduced a nice way to store extra user data safely at us. We won't use and analyze extra data set by you or your users.
You can encrypt the data to make sure we won't get anything useful from it, but you can trust us.

If you want to know more about these, keep reading.

##Let's start with the basics
###How to set up and use the class?

Basically you need to use PHP 5.4 or newer. It should work with lower versions, but we can't guarantee that newer updates won't contain new stuff from this version.

+ Clone this repository to a local folder to get everything or get the *filtrLogin.class.php* manually by clicking the RAW button.
`git clone https://git.sandros.hu/git/sandros/filtrLogin.git .`

+ Copy the *filtrLogin.class.php* to the folder where your project is. Or maybe place it in your *includes* directory if you have one.

+ These are the elements of a basic authentication method
 - `session_start();`
   Start a session.

 - `$filtr =  new filtrLogin();`
   This "opens up" the class.

 - `$filtr->setAppid(11);
    $filtr->setApptoken('this_is_a_long_code');`
   **11** is the ID of your app. You can see your apps ID when you log into Filtr.

 - `$filtr->setToken($_SESSION['filtr_user_token']);`
   *$_SESSION* is an array and it's unique for every user / visit. We will store the temporary access token in this array. You can also use a cookie for this.

 - `$filtr->Login();`
   This will send the application id, application token and authentication token to Filtr. If the given datas are correct and the user has your app on his whitelist, Filtr will send back some data about the owner of the authentication token.

 - `if ($filtr->status()) echo "yay!";`
   *status()* can be **true** or **false**. Obvious.

 - `$filtr->getData()`
   This will return an array or an object, depends on it's first parameter. If you give it TRUE, you'll get an object.
   `{
	"id":		1,
	"updated":	0,
	"name":		"Chuck Norris",
	"link":		"norris",
	"email":	"chuck@norr.is",
	"sex":		0,
	"activated":	10000000000,
	"status":	"ok",
	"time":		1434031066
}`
   *updated*, *activated* and *time* are unix timestamps. Updated is 0 if the user never updated its profile. Activated can be 0 or the actual time of the Filtr. activation. Time is the current time at us. :D

####The advanced stuff
- `$filtr->cache = '/tmp/';`
  You HAVE TO place this before any DataStorage() or Login()!
  You can point this to a custom directory, but the server has to have write and read permissions and it has to end with "/".

- `$filtr->DataStorage(parameter1, parameter2, parameter3);`
  + Reading
    parameter1: 'read'
    This will let us know that you want to download the users appdata.

  + Writing
    parameter1: 'write'
    parameter2: 'favourite_foods'
    parameter3: 'pizza,swagetti,yolognese'
    You can write one variable at a time. You can store JSON if you want.
	**Maximum length:**
  + + parameter2: 25
  + + parameter3: 10240

  + Remove a variable
    parameter1: 'write'
	parameter2: 'favourite_foods'
	parameter3: -1
	-1 will remove the variable and it's value.

  + Erase storage
    parameter1: 'erase'
    This will erase the users appdata. Not only one variable, but the whole storage. I mean for that one user with the token.

- `$filtr->lessy();`
  This will help you and us save bandwidth. If you place this before *Login()* you'll get only the ID, status, time and optional, but data.

- `$this->apps();`
  This will let us know that you want to know the current users whitelist items. You'll get application identifiers.

####Now you're basically ready to use Filtr. as an authentication system. Hurray!
I recommend you to try every option out. I'm sure you'll find a lot of useful usecases.
You can find a working example in the *examples* directory. Just sayin'! :)

###Filtr. Analytics
Yeah, we have analytics. You can use this anywhere you want. Sort of.
You can log every online action you can think of. Page load, traffic source, flow, button/link clicks, events, everything. You'll be able to see specific users actions, so if someone reported a problem and you want to know what he done, you can check it anytime without asking the user. Because if you ask "difficult" questions to normal users, they will be mad and eat your lunch. Yeah, it can be way more dangerouos than you think.

####Okay, so basic code to log traffic and flow
+ `var filtrApp = 1;var script = document.createElement("script");script.src = "//filtr.sandros.hu/statistics/"+filtApp+(document.referrer ? "?cf="+encodeURIComponent(document.referrer):"");document.getElementsByTagName("head")[0].appendChild(script);`
  Before you insert this code to your awesome sites head part, make sure that you replaced the number with your apps ID in the **filtrApp = *1*;** part.
  We have a more advanced code to log not only the path, but the GET parameters too. We shouldn't use that since it can hurt performance.

+ `function filtrAction(action){return ($.ajax({url: '//filtr.sandros.hu/statistics/'+filtrApp+'?action='+action+'&uid='+filtrUser, async: false}) ? true : true);}`
  The *filtrApp* and *filtrUser* come from the previous code, so if you want to use this code you have to use both. We'll remove filtrUser in the next version.
  - `<a href="#top" onclick="filtrAction('top_link')"></a>`
    This will log that somebody clicked on this link.

+ Application statistics
  You can use our activity log service to log actions in your apps.
  Add the following to the standard JS query url:
  `&ait=[application stat token]`
  AIT = STATT on Filtr.

###More to come, stay tuned!
