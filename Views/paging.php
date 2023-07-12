<!-- 
note: to embbed this you need 2 vars

$pageCount => number of pages

$pagePath => where to go (./)

 -->


<div class="paging-container">
    <?php
    $query = '?';
    foreach (array_keys($_GET) as $key) {
        if ($key != 'p') {
            $item = $_GET[$key];
            $query .= "$key=$item&";
        }
    }
    $query = rtrim($query, '&');
    if(isset($_GET['p'])){
        $pg = ($_GET['p']==1)?$pageCount: $_GET['p']-1; 
        echo "<a href='$pagePath$query&p=$pg' class='link'>";
    }else{
        echo "<a href='$pagePath$query&p=$pageCount' class='link'>";
    }
    ?>
    
        <img src='Views/images/icons/arrow.svg' class='left-arrow'>
    </a>

    <div class="pages">
        <?php

        for ($i = 1; $i <= $pageCount; $i++) {
            $active = (isset($_GET['p']) && $_GET['p'] == $i) ? 'active' : '';
            echo "<a href='$pagePath$query&p=$i' class='$active'>$i</a>";
        }
        ?>
    </div>

    <?php
        if(isset($_GET['p'])){
            $pg = ($_GET['p']==$pageCount)?1: $_GET['p']+1; 
            echo "<a href='$pagePath$query&p=$pg' class='link'>";
        }else{
            $pg = ($pageCount<=2)?1:2;
            echo "<a href='$pagePath$query&p=$pg' class='link'>";
        }
    ?>
    <img src='Views/images/icons/arrow.svg' class='right-arrow'>
    </a>
</div>