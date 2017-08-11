<div class="back">
    <i class="fa fa-chevron-left" aria-hidden="true"></i>
    <a href="javascript:history.go(-1)">Back</a>
</div>    
<form name="updateArticle" action="<?php echo $_SERVER['REQUEST_URI']; ?>" method="post">
    <div class="titlefull">
        <label for="Article['title']"></label>
        <input type="text" name="Article[title]" id="Article[title]" value="<?php echo isset($_POST['Article']['title'])? $_POST['Article']['title']:$vars['article']['title']; ?>" />
    </div>
    <div class="data">
        &nbsp;&nbsp; <i class="fa fa-clock-o" aria-hidden="true"></i> 
        <?php echo date("F j, Y, g:i a", strtotime($vars['article']['date_insert'])); ?>
    </div>
    <div class="bodyfull">
        <label for="Article['body']"></label>
        <script type="text/javascript" src="third_party/ckeditor/ckeditor.js"></script>
        <textarea name="Article[body]" id="Articel[body]" class="ckeditor"><?php echo isset($_POST['Article']['body'])? $_POST['Article']['body']:$vars['article']['body']; ?>
        </textarea>
    </div>
    <div>
        <?php echo isset($_POST['Article']['cover_photo'])? $_POST['Article']['cover_photo']:$vars['article']['cover_photo']; ?>
        <br />
        <input type="file" name="fileToUpload" id="fileToUpload">
    </div>
    <div>
        <input class="button" type="submit" name="Article[saveArticle]" value="Update" />
    </div>   
</form>
