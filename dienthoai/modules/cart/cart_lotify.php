<a class="mt-4 mr-2" href="index.php?page_layout=cart">giỏ hàng</a><span class="mt-3">
    <?php
    if(isset($_SESSION['cart'])){
        $totals=0;
        // if (isset($_POST['sbm'])) {
        //     foreach ($_POST['qtt'] as $prd_id => $qtt) {
        //         $_SESSION['cart'][$prd_id] = $qtt;
        //     }
        // }
        if (isset($_POST['qtt'])) {
            $cart=$_POST['qtt'];
        }
        else{
            $cart=$_SESSION['cart'];
        }
        foreach($cart as $prd_id=>$qtt){
            $totals+=$qtt;
        }
        echo $totals;
    }
    else{
        echo 0;
    }
    ?>
</span>
