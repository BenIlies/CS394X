<!DOCTYPE html>
<html>
<head>
    <link rel="stylesheet" href="css.css">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src='https://cdnjs.cloudflare.com/ajax/libs/animejs/2.2.0/anime.min.js'></script>
        <meta charset="UTF-8" />
        <title>SQLogin</title>
</head>
<body>
    <?php
	session_start();
	if($_SERVER["REQUEST_METHOD"] == "POST") {
            $db = new SQLite3("./__db__/db.sql");
            $id = $_POST['id'];
            $pw = $_POST['pw'];
            $txt = 'Please Login!';

	    
	    print("<script>console.log(" . $id . ");</script>");
	    if(preg_match('/[^a-zA-Z0-9-_-]+/',$id) || preg_match('/[^a-zA-Z0-9-_-]+/',$pw)){
		exit("<script>alert('Input with special characters not allowed!'); location.href='/index.php';</script>");
	    }

	    $_SESSION["login_success"] = false;
            if(strlen($id)<10) { 
              $pw = md5($pw);
              $query = "SELECT id FROM user WHERE id = '{$id}' AND pw = '{$pw}'";
                                                        $result = $db->query($query);
                                                        if($result == false) {
                                                                $txt = "Login Error";
                                                        }
                                                        else {
                $data = $result->fetchArray();
                if(isset($data['id']) && !empty($data['id'])) {
			$_SESSION['login_success'] = true;
			exit("<script>alert('Login Success!'); location.href='/control.php';</script>");
		}
		else{
			$_SESSION['login_success'] = false;
			exit("<script>alert('Login Failed!'); location.href='/index.php';</script>");
			}
                                                        }
	    } else {
	      $_SESSION['login_success'] = false;
              $txt = "Username is too long.<br/>[!] Password uses md5 hash.";
            }
        }
    ?>
    <div class="star"></div>
    <div class="twinkling"></div>
    <div class="clouds"></div>
    <div class="page">
        <div class="container">
          <div class="left">
            <div class="login">Access Control Login</div>
          </div>
          <div class="right">
            <svg viewBox="0 0 320 300">
              <defs>
                <linearGradient
                                inkscape:collect="always"
                                id="linearGradient"
                                x1="13"
                                y1="193.49992"
                                x2="307"
                                y2="193.49992"
                                gradientUnits="userSpaceOnUse">
                  <stop
                        style="stop-color:#51ffcc;"
                        offset="0"
                        id="stop876" />
                  <stop
                        style="stop-color:#fbf990;"
                        offset="1"
                        id="stop878" />
                </linearGradient>
              </defs>
              <path d="m 40,120.00016 239.99984,-3.2e-4 c 0,0 24.99263,0.79932 25.00016,35.00016 0.008,34.20084 -25.00016,35 -25.00016,35 h -239.99984 c 0,-0.0205 -25,4.01348 -25,38.5 0,34.48652 25,38.5 25,38.5 h 215 c 0,0 20,-0.99604 20,-25 0,-24.00396 -20,-25 -20,-25 h -190 c 0,0 -20,1.71033 -20,25 0,24.00396 20,25 20,25 h 168.57143" />
            </svg>
            <div class="form">
               <form method="POST" action="/">
                    <label for="username">Username</label>
                    <input type="text" id="username" name="id" autocomplete="off">
                    <label for="password">Password</label>
                    <input type="password" id="password" name="pw" autocomplete="off">
                    <input type="submit" id="submit" value="Submit">
                </form>
            </div>
          </div>
        </div>
      </div>      
      <script id="rendered-js" >
        var current = null;
        document.querySelector('#username').addEventListener('focus', function (e) {
          if (current) current.pause();
          current = anime({
            targets: 'path',
            strokeDashoffset: {
              value: 0,
              duration: 700,
              easing: 'easeOutQuart' },
        
            strokeDasharray: {
              value: '240 1386',
              duration: 700,
              easing: 'easeOutQuart' } });
        
        
        });
        document.querySelector('#password').addEventListener('focus', function (e) {
          if (current) current.pause();
          current = anime({
            targets: 'path',
            strokeDashoffset: {
              value: -336,
              duration: 700,
              easing: 'easeOutQuart' },
        
            strokeDasharray: {
              value: '240 1386',
              duration: 700,
              easing: 'easeOutQuart' } });
        
        
        });
        document.querySelector('#submit').addEventListener('focus', function (e) {
          if (current) current.pause();
          current = anime({
            targets: 'path',
            strokeDashoffset: {
              value: -730,
              duration: 700,
              easing: 'easeOutQuart' },
        
            strokeDasharray: {
              value: '530 1386',
              duration: 700,
              easing: 'easeOutQuart' } });
        
        
        });
        //# sourceURL=pen.js
    </script>
</body>
</html>
