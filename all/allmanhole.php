<?php
session_start();
require('../connect.php');
?>
<!DOCTYPE html>
<html lang="ja">
<head>
   <meta charset="utf-8">
   <meta name="robots" content="noindex,nofollow">
   <title>HTMLベーステンプレート</title>

   <meta name="viewport" content="width=device-width, initial-scale=1.0">

   <link rel="stylesheet" href="../css/reset.css">
   <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <link rel="stylesheet" href="../css/manhole.css">


</head>
<body>
  <header>
      <h1 class="top-title">
         <a href="../top.html">COLLECTERS</a>
      </h1>
      <nav class="pc-nav">
         <ul>
            <li class="about"><a href="#">ABOUT</a></li>
            <li class="collect"><a href="../collect.html">COLLECT</a></li>
            <li class="register"><a href="../register.php">REGISTER</a></li>
            <li class="login"><a href="../login.php">LOGIN</a></li>
         </ul>
      </nav>
      <nav class="sp-nav">
         <ul>
            <li><a href="#">ABOUT</a></li>
            <li><a href="../collect.html">COLLECT</a></li>
            <li><a href="../register.php">REGISTER</a></li>
            <li><a href="../login.php">LOGIN</a></li>
            <li class="close"><span>閉じる</span></li>
         </ul>
      </nav>
      <div id="hamburger">
         <span></span>
      </div>
  </header>


<div class="main-visual-sea">
    <div class="title-flex">
        <p class="sea-regi"><span class="mm">M</span>anhole</p>
    </div>
    <?php
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $sql = "SELECT * FROM manhole_image";
        $stmt = $pdo->prepare($sql);
        $stmt->execute();
        $images = $stmt->fetchAll();
        if ($images): // データが存在する場合
        ?>
<div class="container mt-5">
    <div class="row">
        <div class="col-md-8 border-right">
            <ul class="list-unstyled">
                <?php for($i = 0; $i < count($images); $i++): ?>
                    <li class="media mt-5">
                        <div class="media">
                            <div class="media-img">
                                <a class="man_img" href="#lightbox" data-toggle="modal" data-slide-to="<?= $i; ?>">
                                <img src="../mypage/image.php?id=<?= $images[$i]['image_id']; ?>" width="100" height="auto" class="mr-3">
                                </a>
                            </div>
                            <div class="add">
                                <p>
                                  <?php echo htmlspecialchars($images[$i]['prefecture'], ENT_QUOTES); ?>
                                </p>
                                <p>
                                  <?php echo htmlspecialchars($images[$i]['comment'], ENT_QUOTES); ?>
                                </p>
                            </div>
                        </div>
                    </li>

                <?php endfor; ?>
            </ul>
        </div>
    </div>
</div>

<div class="modal carousel slide" id="lightbox" tabindex="-1" role="dialog" data-ride="carousel">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
        <div class="modal-body">
            <ol class="carousel-indicators">
                <?php for ($i = 0; $i < count($images); $i++): ?>
                    <li data-target="#lightbox" data-slide-to="<?= $i; ?>" <?php if ($i == 0) echo 'class="active"'; ?>></li>
                <?php endfor; ?>
            </ol>

            <div class="carousel-inner">
                <?php for ($i = 0; $i < count($images); $i++): ?>
                    <div class="carousel-item <?php if ($i == 0) echo 'active'; ?>">
                    <img src="../mypage/image.php?id=<?= $images[$i]['image_id']; ?>" class="d-block w-100">
                    </div>
                <?php endfor; ?>
            </div>

            <a class="carousel-control-prev" href="#lightbox" role="button" data-slide="prev">
                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                <span class="sr-only">Previous</span>
            </a>
            <a class="carousel-control-next" href="#lightbox" role="button" data-slide="next">
                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                <span class="sr-only">Next</span>
            </a>
        </div>
        </div>
    </div>
</div>
<?php else : ?>
            <p>登録はありません。</p>
            <?php endif; ?>
</div>
</body>

</html>