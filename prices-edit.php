<?php require_once "_admin/header.php" ?>
<?php
$link = mysqli_connect($host, $user, $pass)
or die('Не удалось соединиться: ' . mysql_error());
echo 'Соединение успешно установлено';
mysqli_select_db($link, $database) or die('Не удалось выбрать базу данных');

?>

<!doctype html>
<html lang="en">
<head>
    <?php include_once "parts/head.php" ?>
    <title>Хімчистка-пральня AKSI</title>
    <link rel="stylesheet" href="css/admin.css">
</head>
<body>
<?php include_once "parts/menu.php" ?>
<?php
function renderCategory($category, $link)
{
    $query = "SELECT * FROM service WHERE category LIKE '" . $category . "';";
    $result = mysqli_query($link, $query);
    if ($result) {
        while ($row = mysqli_fetch_assoc($result)) {
            ?>
            <div class="prices-item">
                <div class="prices-item-descr">
                    <span class="prices-item-title"><?php echo $row['sname'] ?></span>
                </div>
                <form action="_admin/updateService.php" method="post">
                    <input type="hidden" name="id" value="<?php echo $row['id']?>">
                    <input type="text" name="price" class="prices-item-price" value="<?php echo $row['price'] ?>">
                    <input type="submit" value="Змінити">
                </form>
            </div>
            <?php
        }
    }
}

?>

<div id="section-price-edit">
    <div class="container p-0">
        <div class="row justify-content-center no-gutters">
            <div class="col-xl-11 text-center">
                <h2 class="section-header">Ціни</h2>
                <div class="tab-container">
                    <ul class="nav nav-tabs nav-justified" id="pricesTab" role="tablist">
                        <li class="nav-item">
                            <a class="nav-link active" id="leather-tab" data-toggle="tab" href="#tab-leather" role="tab"
                               aria-controls="home" aria-selected="true">
                                <span>Хімчистка і фарбування шкіряних виробів</span>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" id="pills-tab" data-toggle="tab" href="#tab-pills" role="tab"
                               aria-controls="profile" aria-selected="false">
                                <span>Чистка <br>пухо-пір'яних виробів</span>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" id="textile-tab" data-toggle="tab" href="#tab-textile" role="tab"
                               aria-controls="contact" aria-selected="false">
                                <span>Хімчистка <br>текстилю</span>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" id="clothes-tab" data-toggle="tab" href="#tab-clothes" role="tab"
                               aria-controls="contact" aria-selected="false">
                                <span>Хімчистка <br>одягу</span>
                            </a>
                        </li>
                    </ul>

                    <div class="tab-content" id="pricesTabContent">
                        <div class="tab-pane fade show active" id="tab-leather" role="tabpanel"
                             aria-labelledby="leather-tab">
                            <?php
                            renderCategory("leather", $link);
                            ?></div>

                        <div class="tab-pane fade" id="tab-pills" role="tabpanel"
                             aria-labelledby="pills-tab">
                            <?php
                            renderCategory("pillows", $link);
                            ?></div>
                        <div class="tab-pane fade" id="tab-textile" role="tabpanel" aria-labelledby="textile-tab">
                            <?php
                            renderCategory("textile", $link);
                            ?>
                        </div>
                        <div class="tab-pane fade" id="tab-clothes" role="tabpanel" aria-labelledby="clothes-tab">
                            <?php
                            renderCategory("clothes", $link);
                            ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<?php include_once "parts/footer.php" ?>
</body>
</html>