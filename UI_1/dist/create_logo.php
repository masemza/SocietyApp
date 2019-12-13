<?php
require 'core/init.php';
$general->logged_out_protect();
$username = htmlentities($user['username']);

$logoDetails = $users->check_if_logo_has_values($user_id);
foreach($logoDetails as $logorow){}

$file_name=isset($_POST['files']);
if(isset($_POST['save'])) 
{
    $users->create_logo($user_id, $file_name);

    header('Location:index.php');    
}

if(isset($_POST['cancel'])) 
{
    header('Location:index.php');    
}

?>

<!doctype html>
<html lang="en" dir="ltr">
<?php include 'incl/head.php' ;?>
<?php include 'incl/header.php' ;?>

  <body class="">
    <div class="page">
      <div class="page-main">

        <div class="header collapse d-lg-flex p-0" id="headerMenuCollapse">
          <div class="container">
            <div class="row align-items-center">
              
              <div class="col-lg order-lg-first">
                <ul class="nav nav-tabs border-0 flex-column flex-lg-row">
                
                  <li class="nav-item">
                    <a href="./index.php" class="nav-link"><i class="fe fe-home"></i> Home</a>
                  </li>

                </ul>
              </div>
            </div>
          </div>
        </div>

        <div class="my-3 my-md-5">
          <div class="container">
            <div class="page-header">
              <h1 class="page-title">
                <a href="./index.php" style="text-decoration: none;"> <i class="fe fe-arrow-left"></i>Home</a> | Add Logo
              </h1>
            </div>

            <form class="" id="" action="" role="form" method="post" enctype="multipart/form-data">
                <label></label>
                
                <br><br>
                <input type ="hidden" name="MAX_FILE_SIZE" value="5000000">
                <input id="logo_image" type="file" name="files[]" multiple="multiple">
                <br><br>
                
                <div id="dvPreview" style="padding: 0 20px 20px 20px;"></div>                           
                <br>
                
                <button type="submit" name="save">Save</button>      
                <button type="submit" name="cancel">Cancel</button>      
            </form>
        </div>
      </div>
    </div>
      

      <?php include 'incl/footer.php' ;?>
    </div>

    <br>

<script src="jquery-1.11.1.min.js"></script>
<!-- Show service areas -->
  <script type="text/javascript">
    $('.local1').click(function(){
      $('.showlocal1').show();
    })

    $('.local1close').click(function(){
      $('.showlocal1').hide();
    })
  </script>
<!-- End service areas -->
<!-- Show service areas -->
  <script type="text/javascript">
    $('.local2').click(function(){
      $('.showlocal2').show();
    })

    $('.local2close').click(function(){
      $('.showlocal2').hide();
    })
  </script>
<!-- End service areas -->
 <script type="text/javascript">
        window.onload = function () {
            var image = document.getElementById("logo_image");
            image.onchange = function () {
                if (typeof (FileReader) != "undefined") {
                    var dvPreview = document.getElementById("dvPreview");
                    dvPreview.innerHTML = "";
                    var regex = /^([a-zA-Z0-9\s_\\.\-:])+(.jpg|.jpeg|.gif|.png|.bmp)$/;
                    for (var i = 0; i < image.files.length; i++) {
                        var file = image.files[i];
                        if (regex.test(file.name.toLowerCase())) {
                            var reader = new FileReader();
                            reader.onload = function (e) {
                                var img = document.createElement("IMG");
                                img.height = "100";
                                img.width = "100";
                                img.src = e.target.result;
                                dvPreview.appendChild(img);
                            }
                            reader.readAsDataURL(file);
                        } else {
                            alert(file.name + " is not a valid image file.");
                            dvPreview.innerHTML = "";
                            return false;
                        }
                    }
                } else {
                    alert("This browser does not support HTML5 FileReader.");
                }
            }
        };
</script>

  </body>
</html>