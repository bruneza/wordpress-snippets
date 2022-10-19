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
if (!function_exists('devices_card')) {
    function devices_card($post, $cardInfo = null)
    {
        if(isset($post['selected-tax']) && is_array($post['selected-tax']['product-brands']['terms-obj']))
        $deviceBrand = ($post['selected-tax']['product-brands']['terms-obj'][0])->name;
        else
        $deviceBrand = null;
        		// echo '<br>-----$post-----<br>';
				// 		print_r($post);
				// 		echo '<br>----------<br>';
    ?>
        <div class="<?= $cardInfo['name']; ?> filter-card">
            <div class="col">
                <div class="device-picture">
                    <div class="col-md-4">
                        <img src="<?=$post['thumbnail'];?>" class="img-fluid" alt="">
                    </div>
                </div>
                <div class="device-details-contents">
                    <small><?=$deviceBrand;?></small>
                    <h4><?=$post['title'];?></h4>
                    <h1><?=$post['mtn_reg_price'];?></h1>
                    <hr>
                    <div class="device-botm-sec col-md-12 d-flex">
                        <span class="col-md-9">Comes with <?=$post['mtn_reg_price'];?> of Storage</span>
                        <a href="<?=$post['mtn_reg_price'];?>" class="col-md-3 link-icon-sec">
                            <i class="fa fa-chevron-right"></i>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    <?php
    }
}

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
                            echo '<th>' . $title . '</th>';
                        }
                        ?>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    foreach ($tariffInfos as $tariffInfo) {
                        echo '<tr class="bundle">';
                        echo '<td>' . $tariffInfo['price'] . '</td>';
                        echo '<td>' . $tariffInfo['ressources'] . '</td>';
                        echo '<td>' .  $packageValidity . '</td>';
                        echo '</tr>';
                    }
                    ?>
                </tbody>
            </table>
        </div>
<?php
    }
}


if (!function_exists('mtn_validate_data')) {
    function mtn_validate_data($data)
    {
        if (!isset($data)) return false;
        return $data;
    }
}
