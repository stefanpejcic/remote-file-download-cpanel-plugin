
<?php
require '/usr/local/cpanel/php/cpanel.php';

class Account
{
    public static function name($cpanel)
    {
        return $cpanel->cpanelprint('$user');
    }
}


$cpanel = new CPANEL();
print $cpanel->header( "Remote file download" );
$accountName = Account::name($cpanel);
$path = '/home/' . $accountName;

#if disabled file is present, display disabled on cPanel
if(file_exists("/usr/local/cpanel/base/frontend/paper_lantern/remote-file-download/disabled")){
   echo "<h3>This plugin is currently disabled, please try again later.</h3>";
   exit;
}

    $BASE_URL = strtok($_SERVER['REQUEST_URI'],'?');
?>
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.2.0/css/font-awesome.min.css" crossorigin="anonymous">

<div class="container" style="width: auto">
        <div v-model=""></div>
        <div class="content">
            <nav class="navbar navbar-default">
                <div class="container-fluid">
                    <ul class="nav navbar-nav">
<li><a href="#" style="cursor:default;text-decoratio:none;">
   Upload files from URL into you cPanel home directory <?php echo "{$path}"; ?>
   </b></a></li>                        
 </ul>
                </div>
            </nav>

<?php
    if (isset($_POST['url'])){
        $url = $_POST['url'];
        echo "Transferring file: {$url} to {$path}<br>";
        exec("cd $path && wget {$url}");
    }
?>



<style>
div.body-content {
    min-height: 50vh;
    height: 80vh;
    }
input[type="submit"] {
    display: none;
    }
.custom-submit {
    border: 1px solid #ccc;
    display: inline-block;
    padding: 6px 12px;
    cursor: pointer;
    }
</style>
    <form name='upload' method='post' action="<?php echo $BASE_URL; ?>">
        <input type='text' id='url' name='url' size='128' />
<label for="file-upload" class="custom-submit">
    <i class="fa fa-cloud-download"></i> Download</label> 
        
 <input id="file-upload" type="submit" value="Upload">     

    </form>

<p style="position: absolute; bottom: 10vh;">NOTE: If the file already exists, the copy fill be saved as filename.1</p>

<?php
echo $cpanel->footer();
$cpanel->end();
