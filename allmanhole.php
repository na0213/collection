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
    <head>
    <!-- jQuery (BootstrapのJavaScriptプラグインに依存) -->
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"></script>
    <!-- Bootstrap JS -->
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
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
                <?php for ($i = 0; $i < count($images); $i++): ?>
                    <li class="media mt-5">
                        <div class="media">
                            <div class="media-img">
                                <!-- ここでdata属性を使って情報を埋め込む -->
                                <a class="man_img" href="#" data-toggle="modal" data-target="#myModal"
                                   data-prefecture="<?= htmlspecialchars($images[$i]['prefecture'], ENT_QUOTES); ?>"
                                   data-comment="<?= htmlspecialchars($images[$i]['comment'], ENT_QUOTES); ?>">
                                    <img src="../mypage/image.php?id=<?= $images[$i]['image_id']; ?>" width="100" height="auto" class="mr-3">
                                </a>
                            </div>
                        </div>
                    </li>
                <?php endfor; ?>
            </ul>
        </div>
    </div>
</div>

<!-- モーダルウィンドウ -->
<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">画像の詳細</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <!-- コンテンツはここに動的に挿入されます -->
            </div>
        </div>
    </div>
</div>

<?php else : ?>
    <p>登録はありません。</p>
<?php endif; ?>
</div>
</body>
<script>
$(document).ready(function(){
    $('.man_img').click(function(){
        var prefecture = $(this).data('prefecture');
        var comment = $(this).data('comment');
        var content = '<p>' + prefecture + '</p><p>' + comment + '</p>';
        $('#myModal .modal-body').html(content);
    });
});
</script>
</html>