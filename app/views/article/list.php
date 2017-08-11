<div id="left">
    <div class="toplist">
        <div class="categ">
        <?php 
        if (isset($_GET['cat'])) {
            foreach($vars['category'] as $category):
                echo $category['category_name'];
            break;
            endforeach; 
        }
        ?>
        </div>
        <div class="add">
            <i class="fa fa-plus" aria-hidden="true"></i>
            <a href="index.php?c=article&a=add"> Adauga un nou articol</a>
        </div>
    </div>
<div class="artlist">
    <?php foreach($vars['articles'] as $article): ?>
        <div class="art">
            <div class="thumb">
                <a href="index.php?c=article&amp;a=view&amp;id=<?php echo $article['id']; ?>">
                    <img src="public/images/covers/<?php if (isset($article['cover_photo'])) {echo $article['cover_photo'];} else {echo 'placeholder.png';}?>">
                </a>
            </div>
            <div class="artrest"> 
                <div class="arttitlelist">          
                    <a href="index.php?c=article&amp;a=view&amp;id=<?php echo $article['id']; ?>">
                    <?php echo $article['title']; ?>
                    </a>
                </div>
                <div class="data">
                    <i class="fa fa-clock-o" aria-hidden="true"></i> 
                    <?php echo date("F j, Y, g:i a", strtotime($article['date_insert'])); ?>
                    | <i class="fa fa-user-o" aria-hidden="true"></i>
                    admin
                </div>
                <div class="artbody">
                    <?php echo substr(strip_tags($article['body']), 0,170); ?> 
                    <a class="more" href="index.php?c=article&amp;a=view&amp;id=<?php echo $article['id']; ?>">...more</a>
                </div>           
                <div class="actions">
                    <i class="fa fa-pencil-square-o" aria-hidden="true"></i>
                    <a href="index.php?c=article&amp;a=edit&amp;id=<?php echo $article['id']; ?>">Edit</a> | 
                    <i class="fa fa-trash-o" aria-hidden="true"></i>
                    <a href="index.php?c=article&amp;a=delete&amp;id=<?php echo $article['id']; ?>" Onclick="return ConfirmDelete();">Delete</a> 
                </div>
            </div>
        </div> 
    <?php endforeach; ?>    
</div>
<br />
<br />
<?php 
\app\controllers\ArticleController::pagAction(); 
?>
</div><!-- div-ul asta nu ar trebui sa stea aici ci in index dar nu am gasit deocamdata alta solutie pt box-ul de sidebar -->

<div id="right">
    <h2>Cele mai noi articole</h2>
        <?php foreach($vars['latestarticles'] as $article2): ?>
            <div class="latest">
                <div class="thumbmic">
                    <a href="index.php?c=article&amp;a=view&amp;id=<?php echo $article2['id']; ?>">
                        <img src="public/images/covers/<?php if (isset($article2['cover_photo'])) {echo $article2['cover_photo'];} else {echo 'placeholder.png';}?>">
                    </a>
                </div>
                <div class="latesttitle">
                    <a href="index.php?c=article&amp;a=view&amp;id=<?php echo $article2['id']; ?>">
                        <?php echo substr($article2['title'], 0,70). ' ...'; ?>
                    </a>
                </div>
            </div>
        <?php endforeach; ?> 
</div>