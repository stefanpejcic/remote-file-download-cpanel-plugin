
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

    if (isset($_POST['url'])){
        $url = $_POST['url'];
        echo "Transferring file: {$url} to {$path}<br>";
        exec("cd $path && wget {$url}");
    }
?>

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


    <form name='upload' method='post' action="<?php echo $BASE_URL; ?>">
        <input type='text' id='url' name='url' size='128' />
        <input type="submit" value="Upload">
    </form>

<p> If the file already exists, the copy fill be saved as filename.1</p>

<?php
echo $cpanel->footer();
$cpanel->end();
