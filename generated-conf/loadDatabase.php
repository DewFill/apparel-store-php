<?php
$serviceContainer = \Propel\Runtime\Propel::getServiceContainer();
$serviceContainer->initDatabaseMaps(array (
  'default' => 
  array (
    0 => '\\DB\\Map\\BrandsTableMap',
    1 => '\\DB\\Map\\CartProductsTableMap',
    2 => '\\DB\\Map\\CategoriesTableMap',
    3 => '\\DB\\Map\\OrderProductsTableMap',
    4 => '\\DB\\Map\\OrdersTableMap',
    5 => '\\DB\\Map\\ProductCategoriesTableMap',
    6 => '\\DB\\Map\\ProductImagesTableMap',
    7 => '\\DB\\Map\\ProductRatingTableMap',
    8 => '\\DB\\Map\\ProductSizesTableMap',
    9 => '\\DB\\Map\\ProductsTableMap',
    10 => '\\DB\\Map\\SlidesTableMap',
    11 => '\\DB\\Map\\UserAdressesTableMap',
    12 => '\\DB\\Map\\UserFavoritesTableMap',
    13 => '\\DB\\Map\\UsersConfirmationsTableMap',
    14 => '\\DB\\Map\\UsersRememberedTableMap',
    15 => '\\DB\\Map\\UsersResetsTableMap',
    16 => '\\DB\\Map\\UsersTableMap',
    17 => '\\DB\\Map\\UsersThrottlingTableMap',
  ),
));
