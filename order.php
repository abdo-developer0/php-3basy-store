<?php
    ob_start();// stop output
    include 'temp/header.inc';// hdader of website
    include 'db_connect.php';// database connection

//do on request
if($_SERVER['REQUEST_METHOD']=='POST'){
    $pro_id     = $_POST['PRO_ID'];
    $game_id    = $_POST['GAME_ID'];
    $email_name = $_POST['EMAIL_NAME'];
    $post_img   = $_FILES['POST_IMG'];
    new_order($pro_id,$game_id,$email_name,upload_imgv($post_img));
    header('location:index.php');
    exit();
//do on order id is exist
}elseif(isset($_GET['id'])){
    $order = select('products','product_name','where product_id='.$_GET['id'])->fetch()[0];
?>
<!-- start of order-page -->
    <div class="order-page abasy-bg">

            <h1 class="label-message"> 
            :طريقه التحوي
            </h1>

            <h2 class="how-sent">
                    بص يا حب بتروح لي اي حد بتاع موبايلات او سوبرماركت يكون عنده تحويل فودافون كاش بتقوله عايزا حول 100 جنيه فودافون كاش علي الرقم دا 01095695335 ولو طلب انو يكلمني عشان اكد معاه خليه يتصل بيا وتقوله عايز وصل بالتحويل منغير الوصل مش هقدر اشحنلك وتاخد الوصل تحطو في المكان دا وتكتب الايدي والاسم تحت مكان الوصل ودوس علي ارسال وفي مسافه خمس دقايق تكون ال يوسي وصل لحضرتك 
            </h2>

            <div class="sent-form">
                <form  method="POST" enctype="multipart/form-data" action="order.php">
                    <input type="hidden" name="PRO_ID" value="<?PHP echo $_GET['id'] ?>" />
                    <input
                        type="text" 
                        placeholder="الايدي الخاص بك "
                        class="custom-input"
                        name="GAME_ID"
                        required
                    />
                    
                    <input 
                        type="text" 
                        placeholder="اسم الايمال الخاص بك" 
                        class="custom-input"
                        name="EMAIL_NAME"
                        required
                        
                    />

                    <div class="chose-img">  
                        <input 
                            type="file" 
                            accept="image/*" 
                            style="display:none;"
                            id="ipt_img" 
                            onchange="imgChoserAndShow(this,show_img)" 
                            name="POST_IMG"
                            required
                        />  
                        <img src="" class="show" id="show_img" />
                        <button class="chose" type="button" onclick="ipt_img.click()" >
                            اضغط و ضيف صورة الوصل
                        </button>                  
                    </div>

                    <input type="submit" value="اشحنلي <?php echo $order ?>" class="sent" name="endt"/>
                </form>
            </div>
    </div>
<!-- end of order-page -->
<?php
    }//end elseif
    else{
            //user not can browse directly
            header('location:index.php');
            exit();
        }//end else
    include 'temp/footer.inc';// footer of website
    ob_end_flush();// start output
?>
