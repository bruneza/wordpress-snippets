<?php
if (!function_exists('vancancy_card')) {
    function vancancy_card($cardInfo, $post)
    {
?>
        <div class="vacancies filter-card">
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

if (!function_exists('international_tariffs_card')) {
    function international_tariffs_card($cardInfo, $post, $condition = null)
    {
        $tableData = array();
        $headTitle = array();
        if (!isset($post['tariff_info']) || !is_array($post['tariff_info'])) return false;
        
        $tariffInfos = $post['tariff_info'];
        
        if(isset($post['package'])) {
        $packageValidity = xgetTariffValidity($post['package']);
        $packageName = get_term($post['package'])->name;
    }
    
        if(isset($condition) && isset($condition['main_term']))
        $mainTerm =get_term($condition['main_term'][0])->slug;
        
        switch($mainTerm){
            case 'international-calling-bundles':
                foreach ($tariffInfos as $tariffInfo) {
                array_push($tableData,[
                    'Price' => $tariffInfo['price'],
                    'Resources' =>$tariffInfo['ressources'],
                    'Validity' => $packageValidity,
                ]);
            }
                break;
                default:
                return false;
                break;
}

    ?>
        <div class="bundles  filter-card">
            <h4 class="title"><?= $packageName; ?></h4>
            <table class="table table-responsive calling-tarifs">
                <thead>
                    <tr>
                        <?php 
                        foreach ( array_keys($tableData[0]) as $title){
                            echo '<th">'.$title.'</th>';
                        }
                        ?>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    if ($tableData) {
                        foreach ($tableData as $dataRow) {
                
                           echo '<tr class="bundle">';
                           foreach ($dataRow as $row){
                            echo '<td>'.$row.'</td>';
                           }
                           echo '</tr>';
}
                    } ?>
                </tbody>
            </table>
        </div>
<?php
    }
}


if (!function_exists('mtn_validate_data')) {
function mtn_validate_data($data){
  if(!isset($data)) return false;
  return $data;
}
}