<!DOCTYPE html PUBLIC "-//W3C//DD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd>

<html lang="en">
  <head>
    <title>My Wine Site</title>
    <link href="css/public.css" media="all" rel="stylesheet" type="text/css" />
  </head>
  <body>
    <div id="login-header">
	  <form action="register.php">
		<input type="submit" id="button2" />
	  </form>
      <form action="login.php" method="post">
        <label>Username:</label>
        <input type="text" name="username" value=""/>
        <label>Password:</label>
        <input type="password" name="password" value="" />
        <input type="submit" name="login" value="Login" id="button"/>
      </form>
    </div>
    <div id="header">
      <h1>Insert Site Name Here</h1>
    </div>
    <div id="nav-bar">
      <ul class="menu-hor">
        <li>Item 1</li>
        <li>Item 2</li>
        <li>Item 3</li>
      </ul>
     </div>
  </body>
 </html>