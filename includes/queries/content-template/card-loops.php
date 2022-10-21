<?php
//ANCHOR - Card for Vacancy career
if (!function_exists('vancancy_card')) {
    function vancancy_card($post, $cardInfo = null)
    {
?>
        <div class="<?= $cardInfo['name']; ?> filter-card">
            <div class="d-flex">
                <div class="col-md-10">
                    <h4 class="title"><?= $post['title'] ?></h4>
                    <p class="department"><?= $cardInfo['department'] ?></p>
                    <p class="date-meta"><?= $post['closing_data'] ?></p>
                </div>
                <div class="col-md-2">
                    <a href="<?= $post['post-link'] ?>" class="deal-items-icon">
                        <i class="fa fa-angle-right"></i>
                    </a>
                </div>
            </div>
        </div>
    <?php
    }
}
//ANCHOR : Card for Devices Ni dilu
if (!function_exists('devices_card')) {
    function devices_card($post, $cardInfo = null)
    {
        if (isset($post['selected-tax']) && is_array($post['selected-tax']['product-brands']['terms-obj']))
            $deviceBrand = ($post['selected-tax']['product-brands']['terms-obj'][0])->name;
        else
            $deviceBrand = null;
        // echo '<br>-----$post-----<br>';
        // print_r($post);
        // echo '<br>----------<br>';
    ?>
        <div class="<?= $cardInfo['name']; ?> filter-card">
            <div class="filter-card-thumbnail">
                <img src="<?= $post['thumbnail']; ?>" class="img-fluid" alt="">
            </div>
            <div class="device-details-contents">
                <h4 class="title"><?= $post['title']; ?></h4>
                <p class="meta-info"><?= $post['_storage']; ?></p>
                <p class="price-info"><?= $post['_regular_price']; ?></p>
                <p class="meta-info">w/ Extended Warranty: <?= $post['_ext_warranty_fee']; ?></p>
            </div>
        </div>
    <?php
    }
}
//ANCHOR : Card for International tariffs
if (!function_exists('international_tariffs_card')) {
    function international_tariffs_card($post, $cardInfo, $condition = null)
    {

        $tableData = array();
        $headTitle = array();

        if (!isset($post['tariff_info']) || !is_array($post['tariff_info'])) return false;

        $tariffInfos = $post['tariff_info'];

        $packageValidity = xgetValidity($post)['validity'];
        $packageName = xgetValidity($post)['name'];

        if (isset($condition) && isset($condition['main_term']))
            $mainTerm = get_term($condition['main_term'][0])->slug;

        switch ($mainTerm) {
            case 'international-calling-bundles':
                $tableTitle = ['Price', 'Resources', 'Validity'];
                break;
            default:
                return false;
                break;
        }
    ?>
        <div class="<?= $cardInfo['name']; ?>  filter-card">
            <h4 class="title"><?= $packageName; ?></h4>
            <table class="table table-responsive calling-tarifs">
                <thead>
                    <tr>
                        <?php
                        foreach ($tableTitle as $title) {
                            echo '<th class="sub-title">' . $title . '</th>';
                        }
                        ?>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    foreach ($tariffInfos as $tariffInfo) {
                        echo '<tr class="bundle">';
                        echo '<td class="meta-info">' . $tariffInfo['price'] . '</td>';
                        echo '<td class="meta-info">' . $tariffInfo['ressources'] . '</td>';
                        echo '<td class="meta-info">' .  $packageValidity . '</td>';
                        echo '</tr>';
                    }
                    ?>
                </tbody>
            </table>
        </div>
    <?php
    }
}

//ANCHOR - Card for ONA ROAMING
if (!function_exists('ona_card')) {
    function ona_card($post, $cardInfo = null)
    {
        if (!isset($post['tariff_info']) || !is_array($post['tariff_info'])) return false;
        $tariffInfos = $post['tariff_info']; ?>
        <div class=" filter-tab-item">
            <div class="<?= $cardInfo['class']; ?> filter-card">
                <table class="table table-responsive">
                    <thead>
                        <tr>
                            <th class="sub-title"></th>
                            <th class="sub-title">Prepaid Plan (Rwf)</th>
                            <th class="sub-title">Postpaid Plan (Rwf)</th>
                        </tr>
                    </thead>
                    <tbody>

                        <?php
                        foreach ($tariffInfos as $tariffInfo) {
                            echo '<tr class="bundle">';
                            echo '<td class="meta-info">' . $tariffInfo['ressources'] . '</td>';
                            echo '<td class="meta-info">' . $tariffInfo['price'] . '</td>';
                            echo '<td class="meta-info">' . $tariffInfo['postpaid_price'] . '</td>';
                            echo '</tr>';
                        }
                        ?>

                    </tbody>
                </table>
            </div>
        </div>
    <?php
    }
}

//ANCHOR - Card for Vacancy career
if (!function_exists('local_card')) {
    function local_card($post, $cardInfo = null)
    {

    ?>
        <?php
        $tariffInfos = $post['tariff_info'];
        foreach ($tariffInfos as $tariffInfo) {
            // print_r($tariffInfo);
        ?>
            <div class=" filter-tab-item">
                <div class="<?= $cardInfo['class']; ?> filter-card">
                    <div class="tariff-price">
                        <h5>Price</h5>
                        <p><?= $tariffInfo['price']; ?> Rwf</p>
                    </div>
                    <hr>
                    <div class="tariff-ressources">
                        <h5>Ressources</h5>
                    </div>
                    <p><?= $tariffInfo['ressources']; ?></p>
                    <hr>
                    <div class="tariff-validity">
                        <h5>Validity</h5>
                    </div>
                    <p><?= xgetTariffValidity($post['package']); ?></p>
                </div>
            </div>
        <?php } ?>
<?php
    }
}

//ANCHOR - Validate Data
if (!function_exists('mtn_validate_data')) {
    function mtn_validate_data($data)
    {
        if (!isset($data)) return false;
        return $data;
    }
}
