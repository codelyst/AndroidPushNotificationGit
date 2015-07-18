<!DOCTYPE HTML>
<html>
<head>
<style>
.error {color: #FF0000;}
</style>
</head>
<body>



<h2>Push Notification Example</h2>
<p><span class="error">* required field.</span></p>
<form method="post" >
   Enter Server Key: <input type="text" name="name" value="<?php echo $name;?>">
   <span class="error">* <?php echo $nameErr;?></span>
   <br><br>
   Cloud Notification Token: <input type="text" name="token" value="<?php echo $token;?>">
   <span class="error">* <?php echo $tokenErr;?></span>

<br><br>
   <input type="submit" name="submit" value="Submit">

   <br/><br/> OUTPUT <br/><br/>
   <?php echo $result; ?>
</form>



</body>
</html>