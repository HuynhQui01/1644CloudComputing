<?php
include_once("./header.php")
?>
<main>
    <Section>
        <div class="content">
            <div class="content-title">
                <h1>ATN Shop</h1>
                <p>Lorem ipsum, dolor sit amet consectetur adipisicing elit. Voluptatum possimus placeat provident laborum commodi omnis ab, ratione porro distinctio accusantium voluptates. Nesciunt id sequi ab explicabo iusto error doloremque mollitia.
                    Lorem, ipsum dolor sit amet consectetur adipisicing elit. Odio totam cupiditate quaerat iusto unde eveniet harum possimus magnam, facere dolorem tempore debitis ipsum voluptatem necessitatibus, laudantium repellat ipsam officiis delectus!
                    Lorem ipsum dolor sit amet consectetur, adipisicing elit. Delectus nisi beatae veniam inventore blanditiis architecto doloremque praesentium! Necessitatibus harum reprehenderit, fugit optio tempore voluptatibus architecto dignissimos nobis molestias, illum ad!
                    Lorem ipsum dolor sit amet consectetur adipisicing elit. Placeat reprehenderit optio nesciunt neque officia officiis dolorem laudantium! Sunt cumque quos, omnis libero eligendi dolore voluptas, adipisci magni vitae asperiores voluptatum.
                </p>
            </div>
            <div class="img">
                <img src="../Image/banner.png" alt="">
            </div>
        </div>
        <div class="line"></div>
    </Section>
    <section>
        <h2>Product</h2>
        <div class="sale-off">
<?php 
include_once './connectDB.php';
$c = new Connect();
$dblink = $c->connectToPDO();
$sql = "SELECT * FROM `toys`";
$re = $dblink->prepare($sql);
$re->execute();
$row = $re->fetchAll(PDO::FETCH_ASSOC);
foreach ($row as $r):
?>
            <div class="product">
                <img src="../Image/<?=$r['img']?>" alt="">
                <span><a href="./detail.php?id=A01"><?= $r['pName']?></a></span>
                <span class="price"><?= $r['pPrice']?> &#8363</span>
            </div>
<?php 
endforeach;
?>
        </div>
    </section>
</main>
<?php
require_once './footer.php';
?>