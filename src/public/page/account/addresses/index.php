<?php

use DB\UserAdressesQuery;
use DB\UsersQuery;
use inc\v1\auth\Auth;
use inc\v1\html_blocks\HtmlBlocks;

$user = UsersQuery::create()->findOneById(Auth::getUserOrThrow()->id());
?>

<!doctype html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Книга адресов</title>

</head>
<body>

<!--HEADER-->
<?php
require __DIR__ . "/../../site-content/header/index.php" ?>
<main>
    <?= HtmlBlocks::textHeaderOne("Книга адресов") ?>

    <div class="addresses">
        <?php
        $addresses = UserAdressesQuery::create()->findByUserId(Auth::getUserOrThrow()->id());

        foreach ($addresses as $address) { ?>
            <div class="address">
                <div class="wrap_text">
                    <div class="region">
                        <div>Регион:</div>
                        <div><?= $address->getRegion() ?></div>
                    </div>

                    <div class="city">
                        <div>Город:</div>
                        <div>
                            <?= $address->getCity() ?>
                        </div>
                    </div>

                    <div class="district">
                        <div>Район:</div>
                        <div><?= $address->getDistrict() ?></div>
                    </div>

                    <div class="street">
                        <div>Улица:</div>
                        <div><?= $address->getStreet() ?></div>
                    </div>

                    <div class="zip_code">
                        <div>Индекс:</div>
                        <div><?= $address->getZipCode() ?></div>
                    </div>

                    <div class="house">
                        <div>Дом:</div>
                        <div><?= $address->getHouse() ?></div>
                    </div>

                    <?php
                    if ($address->getApartment() !== null) { ?>
                        <div class="apartment">
                            <div>Квартира:</div>
                            <div><?= $address->getApartment() ?></div>
                        </div>
                    <?php } ?>
                </div>
                <!--                            <button>Изменить</button>-->
                <!--                        </a>-->
                <a href="№">
                    <button class="delete_address_button" data-address-id="<?= $address->getId() ?>">Удалить</button>
                </a>
            </div>
        <?php }
        ?>
    </div>

    <a href="/account/addresses/add/" class="add_address_a">
        <button class="add_address_button">Добавить адрес</button>
    </a>
</main>

<?php require __DIR__ . "/../../site-content/footer/index.php" ?>
</body>
</html>
